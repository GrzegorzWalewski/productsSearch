<div>
    <div class="grid grid-cols-2 p-4">
        <h2 class="text-xl font-semibold text-black dark:text-white my-auto">{{ __('Products') }}</h2>
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">{{ __('Search') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input wire:keydown.throttle.200ms="startSearch" type="search" wire:model="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Search by name or manufacturer')}}" />
                <button wire:click="startSearch" type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Name') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Manufacturer') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Price Unit') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Package Type') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Purchase Package Type') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">{{ __('Details') }}</span>
                    </th>
                </tr>
            </thead>
            <tbody x-data="{ expanded: @entangle('expanded') }">
                @foreach ($products as $product)
                <tr wire:key="{{ $product->id }}{{ $search }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                        {{$product->name}}
                    </th>
                    <td class="px-6 py-4">
                        {{$product->manufacturer}}
                    </td>
                    <td class="px-6 py-4">
                        {{$product->price_unit}}
                    </td>
                    <td class="px-6 py-4">
                        {{ __($product->packageType->name) }}
                    </td>
                    <td class="px-6 py-4">
                        @if ($product->purchase_unit_quantity > 1)
                            {{$product->purchase_unit_quantity}} 
                        @endif
                        {{ __($product->purchasePackageType->name) }}
                    </td>
                    
                    <td @click="expanded === {{$product->id}} ? expanded = false : expanded = {{$product->id}}" class="px-6 py-4 text-right">
                        <svg class="fill-indigo-500 shrink-0 ml-8" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                            <rect y="7" width="16" height="2" rx="1" class="transform origin-center transition duration-200 ease-out" :class="expanded=={{$product->id}} ? '!rotate-180' : ''"/>
                            <rect y="7" width="16" height="2" rx="1" class="transform origin-center rotate-90 transition duration-200 ease-out" :class="expanded=={{$product->id}} ? '!rotate-180' : ''" />
                        </svg>
                    </td>
                </tr>
                <tr wire:key="{{ $product->id }}{{ $search }}" class="hidden" :class="expanded=={{$product->id}} ? '!table-row' : ''">
                    <td colspan="7">
                        <div>
                            <livewire:product-details wire:key="{{ $product->id }}{{ $search }}" :product="$product" />
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between p-4" aria-label="Table navigation">
                {{$products->links('custom-pagination-links')}}
        </nav>
    </div>
</div>
