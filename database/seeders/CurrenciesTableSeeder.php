<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('currencies')->insert([

            [
                'symbol'=> 'AUD',
                'rate' => 1.4891902902,
            ] ,
            [
                'symbol'=> 'BGN',
                'rate' => 1.7937602072,
            ] ,
            [
                'symbol'=> 'BRL',
                'rate' => 4.8743207845,
            ] ,
            [
                'symbol'=> 'CAD',
                'rate' => 1.3363302338,
            ] , [
                'symbol'=> 'CHF',
                'rate' => 0.850430091,
            ] ,
            [
                'symbol'=> 'CNY',
                'rate' => 7.1400407691,
            ] , [
                'symbol'=> 'CZK',
                'rate' => 22.4678425954,
            ] ,
            [
                'symbol'=> 'DKK',
                'rate' => 6.8144111044,
            ] , [
                'symbol'=> 'EUR',
                'rate' => 0.9140201488,
            ] ,
            [
                'symbol'=> 'GBP',
                'rate' => 0.7863101492,
            ] , [
                'symbol'=> 'HKD',
                'rate' => 7.8105910374,
            ] ,
            [
                'symbol'=> 'HRK',
                'rate' => 7.0220209031,
            ] , [
                'symbol'=> 'HUF',
                'rate' => 345.2939768695,
            ] ,
            [
                'symbol'=> 'IDR',
                'rate' =>15498.130693183,
            ] , [
                'symbol'=> 'ILS',
                'rate' => 3.6772106778,
            ] ,
            [
                'symbol'=> 'INR',
                'rate' => 83.0777956661,
            ] , [
                'symbol'=> 'ISK',
                'rate' => 137.7068236419,
            ] ,
            [
                'symbol'=> 'JPY',
                'rate' => 144.6059234169,
            ] , [
                'symbol'=> 'KRW',
                'rate' => 1312.5434969096,
            ] ,
            [
                'symbol'=> 'MXN',
                'rate' => 16.8725223597,
            ] , [
                'symbol'=> 'MYR',
                'rate' => 4.6468705266,
            ] ,
            [
                'symbol'=> 'NOK',
                'rate' => 10.3002915489,
            ] , [
                'symbol'=> 'NZD',
                'rate' => 1.6013503131,
            ] ,
            [
                'symbol'=> 'PHP',
                'rate' => 55.6206486324,
            ] , [
                'symbol'=> 'PLN',
                'rate' => 3.9725305638,
            ] ,
            [
                'symbol'=> 'RON',
                'rate' => 4.5444206145,
            ] , [
                'symbol'=> 'RUB',
                'rate' => 90.9393441658,
            ] ,
            [
                'symbol'=> 'SEK',
                'rate' => 10.2601115684,
            ] , [
                'symbol'=> 'SGD',
                'rate' => 1.3292502307,
            ] ,
            [
                'symbol'=> 'THB',
                'rate' => 34.7181137367,
            ] , [
                'symbol'=> 'TRY',
                'rate' => 29.8208847407,
            ] ,
            [
                'symbol'=> 'USD',
                'rate' => 1,
            ] ,
            [
                'symbol'=> 'ZAR',
                'rate' => 18.6727126121,
            ] ,
        ]);
    }
}
