<x-modal name="event-menu" maxWidth="sm">
  <div class="p-5">
    <div class="mb-3 flex justify-between items-center">
      <h1 class="text-xl font-semibold">Event Menu</h1>
      <button wire:click="$dispatch('close-modal', 'event-menu')">
        <i class="fa-solid fa-xmark fa-lg"></i>
      </button>
    </div>
    <div class="mb-3 flex justify-center items-center gap-x-2">
      <x-secondary-button wire:click="$dispatch('open-details', { event: {{ $event }} })">
        <i class="fa-solid fa-info-circle me-2"></i>Details
      </x-secondary-button>
      @if ($show)
        <x-primary-button wire:click="$dispatch('open-edit', { event: {{ $event }} })">
          <i class="fa-solid fa-pen-to-square me-2"></i>Edit
        </x-primary-button>
        <x-danger-button wire:click="$dispatch('open-delete', { event: {{ $event }} })">
          <i class="fa-solid fa-trash-can me-2"></i>Delete
        </x-danger-button>
      @endif
    </div>
  </div>
</x-modal>
