<div>
    <h2 class="text-xl font-semibold text-black dark:text-white">Import xlsx</h2>
    <form wire:submit="save">
        <div>
            <input type="file" wire:model="file">
            <div>
                @error('file') <span class="error">{{ $message }}</span> @enderror 
            </div>
            <div wire:loading wire:target="file">Uploading...</div>
            <button type="submit">Save file</button>
        </div>
    </form>
</div>
