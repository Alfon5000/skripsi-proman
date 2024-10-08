<x-modal name="change-manager" maxWidth="sm">
  @if ($project)
    <div class="p-5">
      <form wire:submit="change">
        <div class="mb-3">
          <h2 class="text-xl font-semibold">Change Manager</h2>
        </div>
        <div class="mb-3">
          <p class="text-md font-semibold">Are you sure you want to change this user as manager?</p>
        </div>
        <div class="flex justify-end items-center gap-x-2">
          <x-primary-button><i class="fa-solid fa-check me-2"></i>Yes</x-primary-button>
          <x-secondary-button wire:click="$dispatch('close-modal', 'change-manager')"><i
              class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
        </div>
      </form>
    </div>
  @endif
</x-modal>
