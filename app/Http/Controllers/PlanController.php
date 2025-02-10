<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanCategory;
use App\Models\Provider;
use Yajra\DataTables\Facades\DataTables;

class PlanController extends Controller
{
    //plan category page
    public function CategoryView(){
        $operators= Provider::where('service_name', '=', 'MOBILE')->get();
        return view('Admin.plan.category' , compact('operators'));
    }

    public function AllPlanCategories(Request $request)
    {
        $packages = PlanCategory::with('operator')->get();

        return DataTables::of($packages)
        ->addColumn('operator_name', function ($package) {
            // Fetch related operator name
            return $package->operator->provider_name ?? 'N/A';
        })
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
            ->rawColumns(['action'])
            ->make(true);
    }
}
