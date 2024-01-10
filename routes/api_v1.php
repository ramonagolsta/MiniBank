<?php

use App\Models\Account;
use App\Models\Crypto;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    $client = new Client(['verify' => 'C:/Users/ramon/OneDrive/Dators/php7.4/cacert.pem']);

    try {
        $response = $client->get('https://api.coinbase.com/v2/currencies/crypto');

        if ($response->getStatusCode() == 200) {
            $apiResponse = $response->getBody();
            $data = json_decode($apiResponse, true);

            if ($data !== null && isset($data['data'])) {
                $codes = array_map(function ($item) {
                    return $item['code'];
                }, $data['data']);

                return $codes;
            } else {
                return response()->json(['error' => 'Failed to decode JSON response.'], 500);
            }
        } else {
            return response()->json(['error' => 'Failed to fetch data from Coinbase API'], $response->getStatusCode());
        }
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to fetch data from Coinbase API', 'message' => $e->getMessage()], 500);
    }
});
