<?php

namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\Currency;
use App\Models\InvestmentAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();

        return view('transactions.index', compact('transactions'));
    }
    public function view()
    {
        $accounts = Account::where('user_id', auth()->id())->get();
        $investmentAccounts = InvestmentAccount::where('user_id', auth()->id())->first();

        return view('transactions.index', compact('accounts', 'investmentAccounts'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'from_account' => 'required',
            'to_account' => 'required',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'required',
        ]);

        $fromAccount = $this->findAccount($request->from_account);
        $toAccount = $this->findAccount($request->to_account);
        $transferAmount = $request->amount * 100;


        if (!$fromAccount || !$toAccount) {
            return back()->withErrors(['msg' => 'One or both account numbers are invalid.']);
        }

        if ($fromAccount->balance < $transferAmount) {
            return back()->withErrors(['msg' => 'Insufficient funds']);
        }

        DB::transaction(function () use ($fromAccount, $toAccount, $transferAmount, $request) {
            $this->processTransfer($fromAccount, $toAccount, $transferAmount, $request);

            $this->recordTransaction($fromAccount, $toAccount, $transferAmount, $request);
        });

        return redirect()->route('transactions')->with('success', 'Transaction completed successfully!!');
    }

    private function findAccount($bankAccountNumber)
    {
        $cleanedNumber = trim($bankAccountNumber);

        return Account::where('bank_account_number', $cleanedNumber)->first();
    }
    private function getExchangeRate($currency)
    {
        $rate = Currency::where('symbol', $currency)->value('rate');

        Log::info("Exchange rate for $currency: $rate");

        if (!$rate) {
            return back()->withErrors(['msg' => 'Currency exchange rate not available']);
        }

        return $rate;
    }

    private function processTransfer($fromAccount, $toAccount, $transferAmount, $request)
    {
        Log::info("Processing transfer: From {$fromAccount->currency} to {$toAccount->currency}");

        $fromAccount->balance -= $transferAmount;
        $fromAccount->save();

        $senderCurrency = $fromAccount->currency;
        $receiverCurrency = $toAccount->currency;


        $senderRate = $this->getExchangeRate($senderCurrency);
        $receiverRate = $this->getExchangeRate($receiverCurrency);

        Log::info("Sender Rate: $senderRate, Recipient Rate: $receiverRate, Transfer Amount: $transferAmount");


        $transferAmountInUSD = $transferAmount / $senderRate;

        $transferAmountInRecipientCurrency = $transferAmountInUSD * $receiverRate;

        Log::info("Transfer Amount in USD: $transferAmountInUSD, Transfer Amount in Recipient Currency: $transferAmountInRecipientCurrency");

        $toAccount->balance += $transferAmountInRecipientCurrency;
        $toAccount->save();

        Log::info("Transfer completed");
    }

    private function recordTransaction($fromAccount, $toAccount, $transferAmount, $request)
    {
        $initialTransferAmount = $request->amount * 100;

        $senderRate = $this->getExchangeRate($fromAccount->currency);
        $recipientRate = $this->getExchangeRate($toAccount->currency);

        $convertedTransferAmount = $initialTransferAmount / $senderRate * $recipientRate;

        Transaction::create([
            'from_account' => $fromAccount->bank_account_number,
            'to_account' => $toAccount->bank_account_number,
            'sent_amount' => $initialTransferAmount,
            'received_amount' => $convertedTransferAmount,
            'sent_currency' => $fromAccount->currency,
            'received_currency' => $toAccount->currency,
            'converted_sent_amount' => $initialTransferAmount,
            'converted_received_amount' => $convertedTransferAmount,
            'description' => $request->input('description'),
        ]);

        return redirect()->route('transactions')->with('success', 'Transfer completed successfully');
    }
    public function history(Request $request)
    {
        $bankAccountNumber = $request->query('account');
        $transactions = Transaction::where('from_account', $bankAccountNumber)
            ->orWhere('to_account', $bankAccountNumber)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $totalSent = Transaction::where('from_account', $bankAccountNumber)
            ->sum('sent_amount');

        $totalReceived = Transaction::where('to_account', $bankAccountNumber)
            ->sum('received_amount');

        return view('transactions.history',
            compact('transactions', 'totalSent', 'totalReceived', 'bankAccountNumber'));
    }
}


