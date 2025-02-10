<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Provider; // Make sure to import your Provider model
use Illuminate\Support\Facades\Log;

class ProviderController extends Controller
{
    public function getProviderList(Request $request)
    {
        try {
            // Get API token from request or configuration
            $apiToken = $request->api_token ?? config('services.mrspay.token');

            // Make HTTP POST request to the provider API
            $response = Http::post('https://mrspay.in/api/application/v1/get-provider', [
                'api_token' => $apiToken
            ]);

            if ($response->successful()) {
                $responseData = $response->json();

                if ($responseData['status'] === 'success' && !empty($responseData['providers'])) {
                    foreach ($responseData['providers'] as $providerData) {
                        // Update or create the provider
                        Provider::updateOrCreate(
                            [
                                'provider_id' => $providerData['provider_id'],
                                'service_id' => $providerData['service_id']
                            ],
                            [
                                'provider_name' => $providerData['provider_name'],
                                'service_name' => $providerData['service_name'],
                                'status' => 1,
                                'source' => 'mrspay'

                            ]
                        );
                    }
                    return response()->json([
                        'success' => true,
                        'message' => 'Providers updated successfully',
                        'data' => $responseData['providers']
                    ]);
                }
                return response()->json([
                    'success' => false,
                    'message' => 'No providers found in response'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch provider list',
                'error' => $response->json()
            ], $response->status());

        } catch (\Exception $e) {
            Log::error('Provider sync error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching provider list',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
