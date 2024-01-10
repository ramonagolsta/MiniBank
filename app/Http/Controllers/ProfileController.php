<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile-index');
    }
    public function showTransactionForm()
    {
        $users = User::all();
        return view('transaction-form', compact('users'));
    }

    public function storeTransaction(Request $request)
    {
        $request->validate([
            'from_user_id' => 'required|exists:users,id',
            'to_user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string',
            'description' => 'required|string',
        ]);

        Transaction::create([
            'from_user_id' => $request->from_user_id,
            'to_user_id' => $request->to_user_id,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'description' => $request->description,
        ]);

        return redirect()->route('transaction.store')->with('success', 'Transaction successful!');
    }
}