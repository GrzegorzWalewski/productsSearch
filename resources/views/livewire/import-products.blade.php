<div class="pt-3 sm:pt-5 lg:pt-0">
    <h2 class="text-xl font-semibold text-black dark:text-white">Import xlsx</h2>
    <div class="grid grid-cols-6">
        <form wire:submit="save" class="mt-4 col-start-2 col-span-4">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" wire:model="file">
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                    @error('file') <span class="error">{{ $message }}</span> @enderror 
                </div>
                <div wire:loading wire:target="file">Uploading...</div>
                <button class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit">Save file</button>
            </div>
        </form>
    </div>
</div>
