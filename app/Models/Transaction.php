<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'from_account',
        'to_account',
        'sent_amount',
        'converted_sent_amount',
        'converted_received_amount',
        'received_amount',
        'sent_currency',
        'received_currency',
        'description'
    ];
}
