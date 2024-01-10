<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentAccount extends Model
{
    use HasFactory;

    protected $table = 'investment_accounts';
    protected $primaryKey = 'bank_account_number';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable =
        [
            'user_id',
            'balance'
        ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($account) {
            $account->bank_account_number = self::generateAccountNumber();
        });
    }

    private static function generateAccountNumber()
    {
        $lastAccount = self::latest('bank_account_number')->first();
        $lastNumber = $lastAccount ? intval(substr($lastAccount->bank_account_number, -5)) : 0;
        $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        return 'LV20INVEST' . $newNumber;
    }
}
