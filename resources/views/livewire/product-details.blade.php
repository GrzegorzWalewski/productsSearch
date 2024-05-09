<div class="py-3 mx-3 grid grid-cols-2">
  @if ($product->variants->count() > 1)
  <form class="max-w-sm">
    <label for="variants" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a variant</label>
    <select wire:change="resetQuantity" wire:model.live="selectedVariant"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <option value="" selected>Select a variant</option>
      @foreach ($product->variants as $variant)
      <option value="{{ $variant->id }}">
        {{ $variant->getName() }}
      </option>
      @endforeach
    </select>
  </form>
  @else
  <p>Only one variant available</p>
  @endif

  <div>
    @if ($selectedVariant != null || $product->variants->count() < 2)
      <div class="grid grid-cols-2">
        <div>
          <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">How much {{ $product->price_unit }} do You
            need?</label>
          <input wire:model.live="quantity" type="text" id="small-input"
            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div>
          @if ($purchasePackageQuantity)
            pur pack: {{ float($purchasePackageQuantity) }}
            pack: {{ float($packageQuantity)}}
            m2: {{ float($finalPriceUnitQuantity)}}
          @endif
        </div>
      </div>
    @endif
  </div>
</div>