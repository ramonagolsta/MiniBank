<?php

namespace App\Http\Controllers;

use App\Models\Crypto;
use App\Models\Investment;
use App\Models\InvestmentAccount;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function view()
    {
        $investmentAccount = InvestmentAccount::where('user_id', auth()->id())->first();

        return view('investments.index', compact('investmentAccount'));

    }
    public function create()
    {
        return view('investments.test');
    }


    public function store(Request $request)
    {
        $request->validate([
            'balance' => 'required|numeric',
            'currency' => 'required',
        ]);


        $investmentAccount = new InvestmentAccount([
            'balance' => $request->input('balance'),
            'currency' => $request->input('currency'),
        ]);
        auth()->user()->investmentAccounts()->save($investmentAccount);

        session()->flash('success', 'Investment account created successfully!');

        return redirect()->route('account')->with('success', 'Investment account created successfully');
    }
}
