<x-modal name="delete-category" maxWidth="sm">
  <div class="p-5">
    <div class="mb-3">
      <h1 class="text-xl font-semibold">Delete Category</h1>
    </div>
    <form wire:submit="destroy">
      <div class="mb-3">
        <p class="text-md font-semibold">Are you sure you want to delete this category?</p>
      </div>
      <div class="flex justify-end items-center gap-x-2">
        <x-danger-button><i class="fa-solid fa-trash-can me-2"></i>Delete</x-danger-button>
        <x-secondary-button wire:click="$dispatch('close-modal', 'delete-category')"><i
            class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
      </div>
    </form>
  </div>
</x-modal>
