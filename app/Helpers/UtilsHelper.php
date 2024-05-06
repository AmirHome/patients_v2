<?php

use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

if (!function_exists('generateCode')) {
    function generateCode($countryId)
    {

        $country = Country::where('id', $countryId)->first(['short_code', 'code_inc']);
        $code = $country->short_code;
        $code_inc = $country->code_inc + 1;

        return Carbon::now()->format('0y') . $code . str_pad(($code_inc), 3, "0", STR_PAD_LEFT);
    }
}
