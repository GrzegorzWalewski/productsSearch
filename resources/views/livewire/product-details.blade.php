<div class="py-3 mx-3 grid grid-cols-2">
  <div>
    <form class="max-w-sm @if ($product->variants->count() <= 1) hidden @endif">
      <label for="variants" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Select a variant')
        }}</label>
      <select wire:change="resetQuantity" wire:model.live="selectedVariant"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="" selected>{{ __('Select a variant') }}</option>
        @foreach ($product->variants as $variant)
        <option value="{{ $variant->id }}">
          {{ $variant->getName() }}
        </option>
        @endforeach
      </select>
    </form>
    @if ($selectedVariant != null || $product->variants->count() < 2)
    <div class="max-w-sm mt-4">
      <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('How much :priceUnit do You need?', ['priceUnit' => $product->price_unit]) }}</label>
      <input wire:model.live="quantity" type="number"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      @error('quantity') <span class="error">{{ $message }}</span> @enderror
    </div>
    @endif
  </div>

  <div>
    @if ($selectedVariant != null || $product->variants->count() < 2) <div class="grid grid-cols-4">
      <div class="col-span-3 p-3">
        @if ($purchasePackageQuantity)
        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
          @if ($product->purchasePackageType->name !== 'none')
          <li class="pb-3 sm:pb-4">
            <div class="flex items-center space-x-4 rtl:space-x-reverse">
              <div class="flex-shrink-0">
                <img class="w-8 h-8 rounded-full"
                  src="{{ asset('images/' . $product->purchasePackageType->name . '.jpeg') }}">
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                  {{ __('We will send')}}:
                  {{ trans_choice('packages.' . $product->purchasePackageType->name, round($purchasePackageQuantity),
                  ['quantity' => round($purchasePackageQuantity)]) }}
                  @if ($product->purchase_unit_quantity > 1)
                  ({{ __('packed by :unit', ['unit' => $product->purchase_unit_quantity]) }})
                  @endif
                </p>
              </div>
            </div>
          </li>
          @endif

          @if ($product->packageType->name !== 'none')
          <li class="pb-3 sm:pb-4">
            <div class="flex items-center space-x-4 rtl:space-x-reverse">
              <div class="flex-shrink-0">
                <img class="w-8 h-8 rounded-full" src="{{ asset('images/' . $product->packageType->name . '.jpeg') }}">
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                  {{ __('Packages')}}:
                  {{ trans_choice('packages.' . $product->packageType->name, round($packageQuantity), ['quantity' =>
                  round($packageQuantity)]) }}
                </p>
              </div>
            </div>
          </li>
          @endif

          @php ($priceUnit = $product->price_unit === 'szt' ? 'piece' : $product->price_unit)
          <li class="pb-3 sm:pb-4">
            <div class="flex items-center space-x-4 rtl:space-x-reverse">
              <div class="flex-shrink-0">
                <img class="w-8 h-8 rounded-full" src="{{ asset('images/' . $priceUnit . '.jpeg') }}">
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                  {{ trans_choice('packages.' . $priceUnit, round($finalPriceUnitQuantity), ['quantity' =>
                  round($finalPriceUnitQuantity)]) }} {{ __('of product')}}
                </p>
              </div>
            </div>
          </li>
        </ul>
        @endif
      </div>
  </div>
  @endif
</div>
</div>