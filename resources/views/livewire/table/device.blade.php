<div>
    <x-data-table :data="$data" :model="$devices">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('name')" role="button" href="#">
                        Number
                        @include('components.sort-icon', ['field' => 'name'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Webhook
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Status
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Created At
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($devices as $device)
                <tr x-data="window.__controller.dataTableController({{ $device->id }})">
                    <td>{{ $device->id }}</td>
                    <td>{{ $device->number }}</td>
                    <td>{{ $device->webhook }}</td>
                    <td>{{ $device->status }}</td>
                    <td>{{ $device->created_at }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/device/scan/{{ $device->id }}" class="mr-3"><i
                                class="fa fa-16px fa-qrcode"></i></a>
                        <a role="button" href="/device/edit/{{ $device->id }}" class="mr-3"><i
                                class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i
                                class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
