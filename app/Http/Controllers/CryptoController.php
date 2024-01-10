<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Crypto;
use App\Models\Investment;
use App\Models\InvestmentAccount;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CryptoController extends Controller
{
    public function buyCrypto()
    {
        return view('crypto.buycrypto');
    }
    public function purchases()
    {
        $purchases = auth()->user()->cryptos;

        foreach ($purchases as $crypto) {
            $cryptoSymbol = $crypto->crypto_symbol;
            $selectedCurrency = $crypto->currency;

            $client = new Client(['verify' => 'C:/Users/ramon/OneDrive/Dators/php7.4/cacert.pem']);

            $response = $client->get("https://api.coinbase.com/v2/prices/{$cryptoSymbol}-{$selectedCurrency}/spot");
            $data = json_decode($response->getBody(), true)['data'];

            $crypto->real_time_price = $data['amount'];
        }
        return view('crypto.purchases', ['purchases' => $purchases]);
    }

    public function processBuyCrypto(Request $request)
    {
        $result = $this->fetchDataFromAPI($request);

        $user = User::find(auth()->id());

        $purchases = $user->cryptos;

        if ($result instanceof RedirectResponse)
        {
            return $result;
        } else {
            return view('crypto.purchases', ['purchases' => $purchases]);
        }
    }
    public function fetchDataFromAPI(Request $request)
    {

        try {
            if (!auth()->check()) {
                return redirect()->route('login')->with('error', 'You must be logged in to perform this action.');
            }

            $validator = Validator::make($request->all(), [
                'bank_account_number' => 'required',
                'currency' => 'required',
                'crypto_symbol' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->route('crypto.buy')->withErrors($validator)->withInput();
            }

            $bankAccountNumber = $request->input('bank_account_number');
            $selectedCurrency = $request->input('currency');

            $account = Account::where('bank_account_number', $bankAccountNumber)->first();

            if (!$account) {
                return redirect()->route('crypto.buy')->with('error', 'Bank account not found.');
            }

            $bankCurrency = $account->currency;

            $client = new Client(['verify' => 'C:/Users/ramon/OneDrive/Dators/php7.4/cacert.pem']);
            $cryptoSymbol = $request->input('crypto_symbol');
            $response = $client->get("https://api.coinbase.com/v2/prices/{$cryptoSymbol}-{$selectedCurrency}/buy");


            $data = json_decode($response->getBody(), true)['data'];

            if (empty($data['base']) || empty($data['currency']) || empty($data['amount'])) {
                return response()->json(['error' => 'Invalid response format from Coinbase API'], 500);
            }

            $crypto = new Crypto([
                'crypto_symbol' => $data['base'],
                'bought_from_bank_account_number' => $bankAccountNumber,
                'currency' => $data['currency'],
                'purchase_price' => $data['amount'],
                'real_time_price' => $data['amount'],
                'price_change_percentage' => 0,
            ]);

            $amountPaid = $data['amount'];

            if ($account->balance < $amountPaid)
            {
                session()->flash('error', 'Insufficient funds in the bank account.');
                return back()->withInput();
            }

            DB::transaction(function () use ($crypto, $account, $amountPaid) {

                $crypto->save();

                $account->balance -= $amountPaid * 100;
                $account->save();
            });

            session()->flash('success', 'Crypto purchase was successful!');

            return redirect()->route('crypto.purchases');
        } catch (RequestException $e) {

            return response()->json(['error' => 'Failed to fetch data from Coinbase API',
                'message' => $e->getMessage()], 500);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Failed to fetch data from Coinbase API',
                'message' => $e->getMessage()], 500);
        }
    }
}
