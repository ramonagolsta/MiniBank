<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            //$table->renameColumn('from_account', 'from_user_id');
            //$table->renameColumn('to_account', 'to_user_id');
            $table->string('from_account');
            $table->string('to_account');
            $table->foreign('from_account')->references('bank_account_number')->on('accounts');
            $table->foreign('to_account')->references('bank_account_number')->on('accounts');

            //$table->foreignId('from_account')->constrained('accounts');
            //$table->foreignId('to_account')->constrained('accounts');
            $table->decimal('sent_amount', 10, 2);
            $table->decimal('received_amount', 10, 2);
            $table->string('sent_currency');
            $table->string('received_currency');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->renameColumn('from_account', 'from_user_id');
            $table->renameColumn('to_account', 'to_user_id');
            $table->dropForeign(['from_user_id']);
            $table->dropForeign(['to_user_id']);
        });
    }
}