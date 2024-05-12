@if ($paginator->hasPages())
    <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">{{ __('Showing') }} <span class="font-semibold text-gray-900 dark:text-white">{{$paginator->firstItem()}} - {{$paginator->lastItem()}}</span> {{ __('of') }} <span class="font-semibold text-gray-900 dark:text-white">{{$paginator->total()}}</span></span>
        <span>
            @if ($paginator->onFirstPage())
                <span>Previous</span>
            @else
                <button type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" wire:click="previousPage" wire:loading.attr="disabled" rel="prev">{{ __('Previous') }}</button>
            @endif
        </span>

        <span>
            @if ($paginator->onLastPage())
                <span>Next</span>
            @else
                <button type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" wire:click="nextPage" wire:loading.attr="disabled" rel="next">{{ __('Next') }}</button>
            @endif
        </span>
@endif