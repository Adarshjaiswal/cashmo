<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MobileRecharge;
use Illuminate\Support\Str;
use App\Models\Commission;
use App\Models\Wallet;
use App\Models\Provider;
use App\Models\WalletDeposite;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class MobileRechargeController extends Controller
{
    public function recharge(Request $request)
    {
        $request->validate([
            'provider' => 'required',
            'phone_number' => 'required',
            'amount' => 'required|numeric',
            'type' => 'required|in:prepaid,postpaid',
        ]);

        $user = auth()->user()->id;
        $wallet = Wallet::where('user_id', $user)->first();

        // Check if wallet exists and has sufficient balance
        if (!$wallet || $wallet->wallet_amount < $request->amount) {
            return response()->json([
                'status' => 'error',
                'message' => 'Insufficient balance. Please add money to your wallet.',
            ], 400);
        }

        $client_id = 'client_' . time() . '_' . rand(1000, 9999);
        $api_token = 'fSBNkN8BkCL5TdwuCpuuywiJvl65GlKrAmDDM2wB6aHNdkkU0Uiz4qN3VAbE';

        // Make the API call to recharge
        $response = Http::get('https://mrspay.in/api/telecom/v1/payment', [
            'api_token' => $api_token,
            'number' => $request->phone_number,
            'amount' => $request->amount,
            'provider_id' => $request->provider,
            'client_id' => $client_id,
        ]);

        $recharge = MobileRecharge::create([
            'trans_id' => $client_id,
            'ref_id' => $response['status'] === 'success' ? $this->extractRefId($response['message']) : null,
            'provider' => $request->provider,
            'customer_info' => $request->phone_number,
            'amount' => $request->amount,
            'type' => $request->type,
            'response' => $response['message'],
            'status' => $response['status'],
            'user_id' => $user,
        ]);

        if (in_array($response['status'], ['pending', 'success'])) {
            $wallet->decrement('wallet_amount', $request->amount);
            $commission = Commission::first();
            $commissionPercent = $commission ? $commission->recharge_commission : 0;
            $commissionAmount = ($request->amount * $commissionPercent) / 100;
            WalletDeposite::create([
                'user_id' => $user,
                'amount' => $commissionAmount,
                'recharge_id' => $recharge->id,
                'status' => 'confirmed',
                'type' => 'recharge',
            ]);
            $wallet->increment('wallet_amount', $commissionAmount);
        }
        return response()->json([
            'status' => $response['status'],
            'message' => $response['message'],
            'recharge' => $recharge,
        ]);
    }

    private function extractRefId($message)
    {
        preg_match('/Number:\s*(\S+)/', $message, $matches);
        return $matches[1] ?? null;
    }


    public function getMobileRecharges(Request $request)
    {
        // Fetch recharges for the logged-in user and order by latest first (created_at descending)
        $recharges = MobileRecharge::where('user_id', auth()->user()->id)
                        ->orderBy('created_at', 'desc'); // Order by latest first

        // Define provider mapping
        $providerMap = [
            1 => 'Airtel',
            6 => 'BSNL',
            9 => 'Jio',
            82 => 'MTNL Delhi',
            233 => 'MTNL Mumbai',
            2 => 'VI'
        ];

        return DataTables::of($recharges)
            // Add the time column
            ->addColumn('time', function ($recharge) {
                return $recharge->created_at->format('Y-m-d');
            })
            // Add the provider name based on the stored number
            ->addColumn('provider', function ($recharge) use ($providerMap) {
                return $providerMap[$recharge->provider] ?? 'Unknown Provider';
            })
            ->make(true);
    }


    public function GetRechargeProviders(){
        $providers = Provider::where('service_id','=', 1)->where('status','=',1)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'message request successful!',
            'providers' => $providers,
        ]);

    }

    public function GetDthProviders(){
        $providers = Provider::where('service_id','=', 2)->where('status','=',1)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'message request successful!',
            'providers' => $providers,
        ]);

    }



}
