<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Investment;
use App\Models\InvestmentAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{

    public function view()
    {
        $accounts = Account::where('user_id', auth()->id())->get();
        $investmentAccounts = InvestmentAccount::where('user_id', auth()->id())->get();

        return view('account.index', compact('accounts', 'investmentAccounts'));
    }

    public function create()
    {
        return view('account.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'currency' => 'required',
            'balance' => 'required|numeric',
        ]);

        $data['user_id'] = auth()->id();
        $data['balance'] = (int)($data['balance'] * 100);

        Account::create($data);

        return redirect()->route('account')->with('success', 'New account created!');
    }

    public function destroy(Request $request)
    {
        $account = Account::where(
            'bank_account_number',
            $request->bank_account_number)->first()
            ?? InvestmentAccount::where(
                'bank_account_number',
                $request->bank_account_number)->first();

        if (!$account) {
            return back()->withErrors(['msg' => 'Account not found.']);
        }


        if ($account->balance > 0) {
            return back()->withErrors(['msg' => 'Before deleting the account, 
            transfer funds to another account.']);
        }


        $account->delete();

        return redirect()->route('account')->with('success', 'Account deleted successfully.');
    }
}
