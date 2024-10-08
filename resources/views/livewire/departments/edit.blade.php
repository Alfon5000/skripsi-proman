<x-modal name="edit-department" maxWidth="sm">
  @if ($department)
    <div class="p-5">
      <form wire:submit="update">
        <div class="mb-3">
          <h2 class="text-xl font-semibold">Edit Department</h2>
        </div>
        <div class="mb-3">
          <x-input-label value="Name" for="name" class="mb-1" />
          <x-text-input wire:model="name" id="name" class="mb-1 w-full" placeholder="Name..." />
          <x-input-error :messages="$errors->get('name')" class="mb-1" />
        </div>
        <div class="flex justify-end items-center gap-x-2">
          <x-primary-button><i class="fa-solid fa-circle-up me-2"></i>Update</x-primary-button>
          <x-secondary-button wire:click="$dispatch('close-modal', 'edit-department')"><i
              class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
        </div>
      </form>
    </div>
  @endif
</x-modal>
