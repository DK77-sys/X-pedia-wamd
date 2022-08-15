@section('title', 'Device List')
<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Device List') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Device</a></div>
            <div class="breadcrumb-item"><a href="{{ route('device') }}">Device List</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="device" :model="$device" />
    </div>
</x-app-layout>
