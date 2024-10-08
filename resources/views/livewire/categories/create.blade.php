<x-modal name="create-category" maxWidth="sm">
  <div class="p-5">
    <form wire:submit="store">
      <div class="mb-3">
        <h2 class="text-xl font-semibold">Create Category</h2>
      </div>
      <div class="mb-3">
        <x-input-label value="Name" for="name" class="mb-1" />
        <x-text-input wire:model="name" id="name" class="mb-1 w-full" placeholder="Name..." />
        <x-input-error :messages="$errors->get('name')" class="mb-1" />
      </div>
      <div class="flex justify-end items-center gap-x-2">
        <x-primary-button><i class="fa-solid fa-floppy-disk me-2"></i>Save</x-primary-button>
        <x-secondary-button wire:click="$dispatch('close-modal', 'create-category')"><i
            class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
      </div>
    </form>
  </div>
</x-modal>
