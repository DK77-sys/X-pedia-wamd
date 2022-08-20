<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index_view()
    {
        return view('pages.device.device-data', [
            'device' => Device::class
        ]);
    }
}