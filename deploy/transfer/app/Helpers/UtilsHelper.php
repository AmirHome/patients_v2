<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

if(!function_exists('generateCode')) {
    function generateCode($refferingType){
        //$refferingType = @$input['travel']['reffering_type']
        if ( $refferingType == 'Ministry') {
            $ministry = Ministry::findOrFail($input['travel']['reffering_id']['Ministry']);
            $code = $ministry->code;
            $code_inc = $ministry->code_inc + 1;
        } else {
            $code = Auth::user()->office->city->country->code;
            $code_inc = Auth::user()->office->city->country->code_inc + 1;
        }
    
        return Carbon::now()->format('0y').$code.str_pad(($code_inc), 3, "0", STR_PAD_LEFT);    
    }
}

