@section('title', 'Create Device')
<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Create New Device') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Device</a></div>
            <div class="breadcrumb-item"><a href="{{ route('device') }}">Create New Device</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:device-controller action="createDevice" />
    </div>
</x-app-layout>
