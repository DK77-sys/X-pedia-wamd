<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Device') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Lengkapi data berikut dan submit untuk membuat device baru') }}
        </x-slot>

        <x-slot name="form">
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="number" value="{{ __('Number') }}" />
                <small>Number</small>
                <x-jet-input id="number" type="number" class="mt-1 block w-full form-control shadow-none"
                    wire:model.defer="device.number" />
                <x-jet-input-error for="device.number" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="webhook" value="{{ __('Webhook') }}" />
                <x-jet-input id="webhook" type="url" class="mt-1 block w-full form-control shadow-none"
                    wire:model.defer="device.webhook" />
                <x-jet-input-error for="device.webhook" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __($button['submit_response']) }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __($button['submit_text']) }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
</div>
