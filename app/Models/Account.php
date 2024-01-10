<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'bank_account_number';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'currency',
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
        $uniqueIdentifier = now()->timestamp;

        return 'LV16HABA20' . $uniqueIdentifier;
    }
}
