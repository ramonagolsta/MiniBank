<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToInvestmentAccountsTable extends Migration
{
    public function up()
    {
        Schema::table('investment_accounts', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained(); // Assuming a foreign key relationship with users table
        });
    }

    public function down()
    {
        Schema::table('investment_accounts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
