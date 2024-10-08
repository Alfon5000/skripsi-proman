<x-modal name="create-comment" maxWidth="2xl">
  <div class="p-5">
    <form wire:submit="store">
      <div class="mb-3">
        <h2 class="text-xl font-semibold">Reply Discussion</h2>
      </div>
      <div class="mb-3" wire:model.debounce.500ms="body">
        <input type="hidden" id="create-comment">
        <trix-editor input="create-comment" class="mb-1 w-full h-48"></trix-editor>
        <x-input-error :messages="$errors->get('body')" class="mb-1" />
      </div>
      <div class="flex justify-end items-center gap-x-2">
        <x-primary-button><i class="fa-solid fa-reply me-2"></i>Reply</x-primary-button>
        <x-secondary-button wire:click="$dispatch('close-modal', 'create-comment')"><i
            class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
      </div>
    </form>
  </div>
</x-modal>
