<?php

// app/Handlers/LazyLoadingViolationHandler.php
namespace App\Handlers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


class LazyLoadingViolationHandler
{
    public function handle($model, $relation)
    {
        $controllerAction = Route::current()->getActionName();
        
        $class = get_class($model);
        
        Log::emergency("Lazy $class::$relation - $controllerAction");

    }
}
