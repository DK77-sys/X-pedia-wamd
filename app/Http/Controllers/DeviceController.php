<?php

namespace App\Http\Controllers;

use App\Models\Device;

class DeviceController extends Controller
{
    public function index_view()
    {
        return view('pages.device.device-data', [
            'device' => Device::class
        ]);
    }
}