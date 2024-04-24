<?php

namespace App\Livewire;
use Livewire\Attributes\Title;
use Livewire\Component;

class Travel extends Component
{
    ##[Title('Wizard - Travel')]
    ##[Layout('layouts.admin')]
    public function render()
    {
        $title = 'Title';
        return view('livewire.travel', compact('title'))->layout('layouts.app');
    }
}
