<?php

namespace App\Http\Controllers;

use App\Models\InvestmentAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InvestmentAccountController extends Controller
{
    public function create(): RedirectResponse
    {

        $data['user_id'] = auth()->id();
        $data['balance'] = 0;

        InvestmentAccount::create($data);

        return redirect()->route('investments')->with('success', 'New investment account created!');
    }
}
