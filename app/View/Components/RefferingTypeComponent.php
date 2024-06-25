<?php

namespace App\View\Components;

use App\Models\Travel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RefferingTypeComponent extends Component
{
    private $data;//channel_id
    private $class;
    private $template;

    public function __construct($class, $data)
    {

        $this->data = $data??[];
        $this->template = $data['template']??'reffering-type';
        $this->class = $class;
    }

    public function render(): View|Closure|string
    {
        $refferingTypes = Travel::REFFERING_TYPE_SELECT;
        $refferingType = $this->data['reffering_type']??null;
        $reffering = $this->data['reffering']??null;
        $refferingIds = [];
        if (in_array($refferingType, ['Doctor', 'Ministry', 'Office'])) {
            $refferingIds = resolve("App\\Models\\$refferingType")::get(['id', 'name'])->pluck('name', 'id');
        }

        $class = $this->class;
        return view('components.'.$this->template.'-component', compact('refferingTypes', 'refferingType', 'refferingIds', 'reffering', 'class'));
    }
}
