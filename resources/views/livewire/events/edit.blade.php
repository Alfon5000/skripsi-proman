<x-modal name="edit-event" maxWidth="sm">
  @if ($event)
    <div class="p-5">
      <form wire:submit="update">
        <div class="mb-3">
          <h2 class="text-xl font-semibold">Edit Event</h2>
        </div>
        <div class="mb-3">
          <x-input-label value="Title" for="title" class="mb-1" />
          <x-text-input wire:model="title" id="title" class="mb-1 w-full" placeholder="Title..." />
          <x-input-error :messages="$errors->get('title')" class="mb-1" />
        </div>
        <div class="mb-3">
          <x-input-label value="Start Time" for="start_time" class="mb-1" />
          <x-text-input type="datetime-local" wire:model="start_time" id="start_time" class="mb-1 w-full" />
          <x-input-error :messages="$errors->get('start_time')" class="mb-1" />
        </div>
        <div class="mb-3">
          <x-input-label value="End Time" for="end_time" class="mb-1" />
          <x-text-input type="datetime-local" wire:model="end_time" id="end_time" class="mb-1 w-full" />
          <x-input-error :messages="$errors->get('end_time')" class="mb-1" />
        </div>
        <div class="mb-3">
          <x-input-label value="Description" for="description" class="mb-1" />
          <x-textarea wire:model="description" id="description" class="mb-1 w-full h-36"></x-textarea>
          <x-input-error :messages="$errors->get('description')" class="mb-1" />
        </div>
        <div class="flex justify-end items-center gap-x-2">
          <x-primary-button><i class="fa-solid fa-circle-up me-2"></i>Update</x-primary-button>
          <x-secondary-button wire:click="$dispatch('close-modal', 'edit-event')"><i
              class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
        </div>
      </form>
    </div>
  @endif
</x-modal>
