<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WalletDeposite;
use App\Models\Wallet;
use App\Models\Commission;
use Yajra\DataTables\Facades\DataTables;
class WalletController extends Controller
{

    public function addFund(Request $request)
    {
        // Validate the request data
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'reforutr' => 'nullable|string',
        ]);

        // Store the deposit data
        $walletDeposit = WalletDeposite::create([
            'user_id' =>auth()->user()->id,
            'amount' => $request->amount,
            'reforutr' => $request->reforutr,
            'status' => 'pending',
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Funds added successfully',
        ]);
    }


//get deposite
public function getDeposits()
{
    $deposits = WalletDeposite::select(['id', 'reforutr', 'amount', 'status'])->where('user_id', auth()->user()->id);

    return DataTables::of($deposits)

        ->make(true);
}

//Admin wallet gets
public function AllWalletRequests()
{
    $deposits = WalletDeposite::with('user:id,first_name,last_name,username')
        ->select(['wallet_deposits.id', 'wallet_deposits.reforutr', 'wallet_deposits.amount', 'wallet_deposits.status', 'wallet_deposits.user_id']);

    return DataTables::of($deposits)
        ->addColumn('user_name', function ($deposit) {
            return $deposit->user->full_name ?? 'N/A';
        })
        ->addColumn('username', function ($deposit) {
            return $deposit->user->username ?? 'N/A';
        })
        ->make(true);
}

public function AllWalletRequestsView()
{
    return view('Admin.wallet.wallet');
}

public function confirmDeposit(Request $request)
{
    $deposit = WalletDeposite::find($request->deposit_id);

    if ($deposit && $deposit->status === 'pending') {
        $deposit->status = 'confirmed';
        $deposit->save();

        // Update the user's wallet
        $wallet = Wallet::where('user_id', $deposit->user_id)->first();
        if ($wallet) {
            $wallet->wallet_amount += $request->amount;
            $wallet->save();
        } else {
            // Create a new wallet entry if it doesn't exist
            Wallet::create([
                'user_id' => $deposit->user_id,
                'wallet_amount' => $request->amount,
            ]);
        }

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'Invalid deposit or already confirmed']);
}

public function rejectDeposit(Request $request)
{
    $deposit = WalletDeposite::find($request->deposit_id);

    if ($deposit && $deposit->status === 'pending') {
        $deposit->status = 'rejected';
        $deposit->save();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'Invalid deposit or already processed']);
}

public function commission()
{
    $commission = Commission::first();
    return view('Admin.wallet.commission',compact('commission'));
}

public function updateCommission(Request $request)
{
    //dd($request->all());
    $request->validate([
        'recharge_commission' => 'required|numeric|min:0|max:100',

    ]);

    $commission = Commission::find($request->id);
    $commission->recharge_commission = $request->recharge_commission;
    $commission->save();
    return redirect()->back()->with('success','Commission updated successfully');
}
public function allUserTransactionView()
{
    return view('wallet.all-transaction');
}

public function allUserTransactionData()
{
    $deposits = WalletDeposite::select(['id', 'reforutr', 'amount', 'status','type','created_at','recharge_id'])->where('user_id', auth()->user()->id);
   // dd($deposits);
    return DataTables::of($deposits)
        ->make(true);
}


}
