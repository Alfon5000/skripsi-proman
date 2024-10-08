<x-modal name="delete-comment" maxWidth="sm">
  <div class="p-5">
    <div class="mb-3">
      <h1 class="text-xl font-semibold">Delete Comment</h1>
    </div>
    <form wire:submit="destroy">
      <div class="mb-3">
        <p class="text-md font-semibold">Are you sure you want to delete this comment?</p>
      </div>
      <div class="flex justify-end items-center gap-x-2">
        <x-danger-button><i class="fa-solid fa-trash-can me-2"></i>Delete</x-danger-button>
        <x-secondary-button wire:click="$dispatch('close-modal', 'delete-comment')"><i
            class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
      </div>
    </form>
  </div>
</x-modal>
