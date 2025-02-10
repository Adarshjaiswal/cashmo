<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Packages;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Provider;
use App\Models\RechargeBillCommission;

use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    //
    public function index(){
        return view('Admin.package.index');
    }

    public function AllPackages(Request $request)
    {
        $packages = Packages::select(['id', 'package_name', 'status']);

        return DataTables::of($packages)
            ->editColumn('status', function ($package) {
                return $package->status == 1 ? 'Enable' : 'Disable';
            })
            ->addColumn('action', function ($package) {
                $toggleButton = $package->status == 1
                    ? '<button class="btn btn-danger btn-sm" onclick="toggleStatus(' . $package->id . ', 0)">Disable</button>'
                    : '<button class="btn btn-success btn-sm" onclick="toggleStatus(' . $package->id . ', 1)">Enable</button>';

                $editButton = '<button class="btn btn-primary btn-sm" onclick="openEditModal(' . $package->id . ')">Edit</button>';

                return $toggleButton . ' ' . $editButton;
            })
            ->addColumn('recharge_and_bills', function ($package) {
                return '<a href="/admin/package/' . $package->id . '/recharge-and-bills" class="btn btn-warning btn-sm">Recharge and Bills</a>';
            })
            ->rawColumns(['action', 'recharge_and_bills'])
            ->make(true);
    }


    public function toggleStatus(Request $request)
{
    $package = Packages::find($request->id);
    if ($package) {
        $package->status = $request->status;
        $package->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

    return response()->json(['success' => false, 'message' => 'Package not found']);
}
public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'package_name' => 'required|string|max:255',
        'status' => 'required|boolean',

    ]);

    try {
        // Start database transaction
        $result = DB::transaction(function () use ($request) {
            // Create package
            $package = Packages::create([
                'package_name' => $request->package_name,
                'status' => $request->status,
            ]);

            // Get all active providers
            $providers = Provider::where('status', true)->get();

            // Create commission entries for each provider
            foreach ($providers as $provider) {
                RechargeBillCommission::create([
                    'package_id' => $package->id,
                    'provider_id' => $provider->id,
                ]);
            }

            return $package;
        });

        return response()->json([
            'success' => true,
            'message' => 'Package and commission details added successfully',
            'data' => $result
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to create package and commission details',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function edit($id)
{
    $package = Packages::find($id);

    if ($package) {
        return response()->json(['success' => true, 'data' => $package]);
    }

    return response()->json(['success' => false, 'message' => 'Package not found']);
}
public function update(Request $request)
{
    $request->validate([
        'id' => 'required|exists:packages,id',
        'package_name' => 'required|string|max:255',
        'status' => 'required|boolean',
    ]);

    $package = Packages::find($request->id);
    $package->package_name = $request->package_name;
    $package->status = $request->status;
    $package->save();

    return response()->json(['success' => true, 'message' => 'Package updated successfully']);
}

public function showRechargeAndBills($id)
{
    $package = Packages::find($id);

    if (!$package) {
        abort(404, 'Package not found');
    }

    return view('Admin.package.recharge_and_bills', compact('package'));
}

public function getRechargeBillsData(Packages $package)
{
    $commissions = RechargeBillCommission::with('provider')
        ->where('package_id', $package->id)
        ->select('recharge_bills_commission.*');

    return DataTables::of($commissions)
        ->addIndexColumn()
        ->addColumn('provider', function ($row) {
            return $row->provider->provider_name ?? 'N/A';
        })
        ->addColumn('commission_type_select', function ($row) {
            $select = '<select class="form-select commission-type" data-id="'.$row->id.'" onchange="updateCommission('.$row->id.')">';
            $select .= '<option value="percent" '.($row->commission_type == 'percent' ? 'selected' : '').'>Percent</option>';
            $select .= '<option value="flat" '.($row->commission_type == 'flat' ? 'selected' : '').'>Flat</option>';
            $select .= '</select>';
            return $select;
        })
        ->addColumn('commission_rate_input', function ($row) {
            return '<input type="number" class="form-control commission-rate" data-id="'.$row->id.'"
                    value="'.$row->commission_rate.'" step="0.01" min="0"
                    onchange="updateCommission('.$row->id.')">';
        })
        ->addColumn('action', function ($row) {
            return '<button class="btn btn-sm btn-primary" onclick="updateCommission('.$row->id.')">
                Update
            </button>';
        })
        ->rawColumns(['commission_type_select', 'commission_rate_input', 'action'])
        ->make(true);
}

public function updateCommission(Request $request)
{
    $request->validate([
        'commission_id' => 'required|exists:recharge_bills_commission,id',
        'commission_type' => 'required|in:percent,flat',
        'commission_rate' => 'required|numeric|min:0',
    ]);

    try {
        $commission = RechargeBillCommission::findOrFail($request->commission_id);
        $commission->update([
            'commission_type' => $request->commission_type,
            'commission_rate' => $request->commission_rate,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Commission updated successfully'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to update commission'
        ], 500);
    }
}


}
