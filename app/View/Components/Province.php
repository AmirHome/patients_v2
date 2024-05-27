<?php

namespace App\View\Components;

use App\Models\Country;
use App\Models\Province as ModelsProvince;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Province extends Component
{
    private $template;
    private $class;

    public function __construct($class, $template='province')
    {
        $this->template = $template;
        $this->class = $class;
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $countries = Country::get();
        $cities = ModelsProvince::get();
        $class = $this->class;
        return view('components.'.$this->template, compact('countries', 'cities', 'class'));
    }

}
