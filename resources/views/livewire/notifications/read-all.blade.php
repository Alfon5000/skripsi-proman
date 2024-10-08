<x-modal name="read-all" maxWidth="sm">
  <div class="p-5">
    <div class="mb-3">
      <h1 class="text-xl font-semibold">Mark All Notifications as Read</h1>
    </div>
    <form wire:submit="readAll">
      <div class="mb-3">
        <p class="text-md font-semibold">Are you sure you want to mark all notifications as read?</p>
      </div>
      <div class="flex justify-end items-center gap-x-2">
        <x-primary-button><i class="fa-solid fa-check me-2"></i>Yes</x-primary-button>
        <x-secondary-button wire:click="$dispatch('close-modal', 'read-all')"><i
            class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
      </div>
    </form>
  </div>
</x-modal>
