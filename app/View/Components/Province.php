<?php

namespace App\View\Components;

use App\Models\Country;
use App\Models\Province as ModelsProvince;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Province extends Component
{
    private $data;
    private $class;

    public function __construct($class, $data)
    {
        $this->data = $data;
        $this->class = $class;
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $countries = Country::get();
        $cities = ModelsProvince::where('country_id', $this->data->country_id??0)->get();
        $class = $this->class;
        return view('components.'.($this->data->template ?? 'province'), compact('countries', 'cities', 'class'));
    }

}
