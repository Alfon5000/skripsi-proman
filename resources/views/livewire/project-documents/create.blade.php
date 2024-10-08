<x-modal name="add-document" maxWidth="sm">
  <div class="p-5">
    <form wire:submit="store">
      <div class="mb-3">
        <h2 class="text-xl font-semibold">Add Document</h2>
      </div>
      <div class="mb-3">
        <x-input-label value="Title" for="title" class="mb-1" />
        <x-text-input wire:model="title" id="title" class="mb-1 w-full" placeholder="Title..." />
        <x-input-error :messages="$errors->get('title')" class="mb-1" />
      </div>
      <div class="mb-3">
        <x-input-label value="File" for="file" class="mb-1" />
        <x-text-input type="file" wire:model="file" id="file" class="mb-1 w-full border p-1.5" />
        <x-input-error :messages="$errors->get('file')" class="mb-1" />
      </div>
      <div class="flex justify-end items-center gap-x-2">
        <x-primary-button><i class="fa-solid fa-floppy-disk me-2"></i>Save</x-primary-button>
        <x-secondary-button wire:click="$dispatch('close-modal', 'add-document')"><i
            class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
      </div>
    </form>
  </div>
</x-modal>
