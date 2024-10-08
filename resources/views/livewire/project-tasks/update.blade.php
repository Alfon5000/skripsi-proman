<x-modal name="update-task" maxWidth="sm">
  @if ($can)
    <div class="p-5">
      <div class="mb-3">
        <h1 class="text-xl font-semibold">Update Task Status</h1>
      </div>
      <form wire:submit="update">
        <div class="mb-3">
          <p class="text-md font-semibold">Are you sure you want to update task status?</p>
        </div>
        <div class="flex justify-end items-center gap-x-2">
          <x-primary-button><i class="fa-solid fa-check me-2"></i>Yes</x-primary-button>
          <x-secondary-button wire:click="cancel"><i class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
        </div>
      </form>
    </div>
  @else
    <div class="p-5">
      <div class="mb-3">
        <h1 class="text-xl font-semibold">Update Task Status</h1>
      </div>
      <div class="mb-3">
        <p class="text-md font-semibold">Work in progress limit has been reached</p>
      </div>
      <div class="flex justify-center items-center">
        <x-primary-button wire:click="cancel"><i class="fa-solid fa-check me-2"></i>OK</x-primary-button>
      </div>
    </div>
  @endif
</x-modal>
