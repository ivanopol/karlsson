<?php


namespace App\Helpers;


use Illuminate\Support\Facades\DB;

class Utilities
{
    public static function getMinimalPayment($price)
    {
        $minimal_percent_rate = DB::selectOne('select min(percent_rate) as rate from credit_programs');

        $monthly_rate = $minimal_percent_rate->rate / 12 / 100;

        return ceil(($price / 2) * (($monthly_rate * pow((1 + $monthly_rate), Constants::max_credit_period))
                / (pow((1 + $monthly_rate), Constants::max_credit_period) - 1)));
    }
}
