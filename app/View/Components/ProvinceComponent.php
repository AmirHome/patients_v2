<?php

namespace App\View\Components;

use App\Models\Country;
use App\Models\Province as ModelsProvince;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProvinceComponent extends Component
{
    private $data;//province_id
    private $class;
    private $template;

    public function __construct($class, $data)
    {

        $this->data = $data['province_id']??0;
        $this->template = $data['template']??'province';
        $this->class = $class;
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $countries = Country::get()->pluck('name', 'id');
        $city = $this->data??0;
        $country = ModelsProvince::find($city)->country_id??0;
        $cities = ModelsProvince::where('country_id', $country)->get()->pluck('name', 'id');

        $class = $this->class;
        return view('components.'.$this->template.'-component', compact('countries', 'cities', 'class', 'country', 'city'));
    }

}
