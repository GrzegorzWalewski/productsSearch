<div>
    <div class="grid grid-cols-2 p-4">
        <h2 class="text-xl font-semibold text-black dark:text-white my-auto">Products</h2>
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input wire:keydown="$refresh" type="search" wire:model="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by name or manufacturer" />
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
                        {{ __('Purchase Unit Quantity') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Package Type') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Purchase Package Type') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody x-data="{ expanded: false }">
                @foreach ($products as $product)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$product->name}}
                    </th>
                    <td class="px-6 py-4">
                        {{$product->manufacturer}}
                    </td>
                    <td class="px-6 py-4">
                        {{$product->price_unit}}
                    </td>
                    <td class="px-6 py-4">
                        {{$product->purchase_unit_quantity}}
                    </td>
                    <td class="px-6 py-4">
                        {{$product->packageType->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$product->purchasePackageType->name}}
                    </td>
                    
                    <td @click="expanded === {{$product->id}} ? expanded = false : expanded = {{$product->id}}" class="px-6 py-4 text-right">
                        <svg class="fill-indigo-500 shrink-0 ml-8" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                            <rect y="7" width="16" height="2" rx="1" class="transform origin-center transition duration-200 ease-out" :class="expanded=={{$product->id}} ? '!rotate-180' : ''"/>
                            <rect y="7" width="16" height="2" rx="1" class="transform origin-center rotate-90 transition duration-200 ease-out" :class="expanded=={{$product->id}} ? '!rotate-180' : ''" />
                        </svg>
                    </td>
                </tr>
                <tr>
                    <td :class="expanded=={{$product->id}} ? '' : 'hidden'" colspan="7">
                        <div>
                            <livewire:product-details :product="$product" />
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
