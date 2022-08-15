<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class DashboardController extends Component
{
    public function mount()
    {
        $this->user = User::all();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}