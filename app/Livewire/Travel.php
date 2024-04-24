<?php

namespace App\Livewire;
use Livewire\Attributes\Title;
use Livewire\Component;

class Travel extends Component
{
    #[Title('Create Post')] 
    public function render()
    {
        $title = 'Travel';
        return view('livewire.travel', compact('title'))
        ->layout('layouts.admin');
    }
}
