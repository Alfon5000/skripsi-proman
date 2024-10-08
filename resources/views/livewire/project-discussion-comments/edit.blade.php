<x-modal name="edit-comment" maxWidth="2xl">
  <div class="p-5">
    <form wire:submit="update">
      <div class="mb-3">
        <h2 class="text-xl font-semibold">Edit Comment</h2>
      </div>
      <div class="mb-3" wire:model.debounce.500ms="body">
        <input type="hidden" id="edit-comment" value="{{ $body }}">
        <trix-editor input="edit-comment" class="mb-1 w-full h-48"></trix-editor>
        <x-input-error :messages="$errors->get('body')" class="mb-1" />
      </div>
      <div class="flex justify-end items-center gap-x-2">
        <x-primary-button><i class="fa-solid fa-circle-up me-2"></i>Update</x-primary-button>
        <x-secondary-button wire:click="$dispatch('close-modal', 'edit-comment')"><i
            class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
      </div>
    </form>
  </div>
</x-modal>
