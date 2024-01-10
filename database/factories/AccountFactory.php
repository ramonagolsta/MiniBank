<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'bank_account_number' => $this->faker->unique()->bankAccountNumber,
            'balance' => $this->faker->randomFloat(2, 100, 10000),
        ];
    }
}
