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


if (!function_exists('refferingType')) {
    function refferingType($str)
    {
        // App\Models\Doctor ...
        
        // 'Other'    => 'Diğer',
        // 'Doctor'   => 'Doktor',
        // 'Fond'     => 'Fon',
        // 'Ministry' => 'Kurum',
        // 'Office'   => 'Ofis',
        $new_str = substr($str, strrpos($str, '\\') + 1);
        return $new_str == 'Fond' ? 'Phone' : $new_str;
    }
}

if (!function_exists('formatSize')) {
    function formatSize($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
}