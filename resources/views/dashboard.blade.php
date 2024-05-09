<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-4 p-8">
                <div>
                    <livewire:ImportProducts />
                    <livewire:status />
                </div>
                <div class="col-span-3">
                    <livewire:ProductsList />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
