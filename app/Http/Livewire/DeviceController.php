<?php

namespace App\Http\Livewire;

use App\Models\Device;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DeviceController extends Component
{
    public $device;
    public $deviceId;
    public $button;
    public $action;

    protected function getRules()
    {
        $rules = ($this->action == "updateDevice") ? [
            "device.number" => "required|unique:devices,number," . $this->deviceId,
            "device.webhook" => "url"
        ] : [
            "device.number" => "required|unique:devices,number," . $this->deviceId,
            "device.webhook" => "url"
        ];
        return array_merge([
            "device.number" => "required",
            "device.webhook" => "url"
        ], $rules);
    }

    public function createDevice()
    {
        $this->resetErrorBag();
        $this->validate();
        $this->device["user_id"] = Auth()->guard()->user()->id;
        Device::create($this->device);
        $this->emit("saved");
        $this->reset("device");
    }

    public function updateDevice()
    {
        $this->resetErrorBag();
        $this->validate();
        Device::query()
            ->where("id", $this->deviceId)
            ->update([
                "number" => $this->device->number,
                "webhook" => $this->device->webhook,
            ]);

        $this->emit("saved");
    }

    public function mount()
    {
        if (!$this->device && $this->deviceId) {
            $this->device = Device::find($this->deviceId);
        }
        $this->button = create_button($this->action, "Device");
    }

    public function render()
    {
        return view("livewire.create-device");
    }
}