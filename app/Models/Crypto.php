<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $fillable = [
        'crypto_symbol',
        'bought_from_bank_account_number',
        'currency',
        'purchase_price',
        'real_time_price',
        'price_change_percentage'
    ];
    public function account()
    {
        return $this->belongsTo(Account::class,
            'bought_from_bank_account_number',
            'bank_account_number');
    }
    public function user()
    {
        return $this->belongsTo(User::class,
            'bought_from_bank_account_number',
            'bank_account_number');
    }

    public function calculatePriceChangePercentage()
    {
        if ($this->purchase_price !== null && $this->real_time_price !== null && $this->purchase_price != 0) {
            $priceChangePercentage = (($this->real_time_price - $this->purchase_price) / $this->purchase_price) * 100;

            $priceChangePercentage = round($priceChangePercentage, 2);

            return $priceChangePercentage;
        }
        return null;
    }
}
