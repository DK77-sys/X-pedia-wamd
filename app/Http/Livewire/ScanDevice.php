<?php

namespace App\Http\Livewire;

use App\Models\Device;
use Livewire\Component;

class ScanDevice extends Component
{
    public $deviceId;
    public $data;

    public function mount()
    {
        $this->data = Device::whereId($this->deviceId)->first();
    }
    public function render()
    {
        return view('livewire.scan-device');
    }
}