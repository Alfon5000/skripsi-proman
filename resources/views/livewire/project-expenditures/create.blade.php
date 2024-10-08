<x-modal name="add-expenditure" maxWidth="sm">
  <div class="p-5">
    <form wire:submit="store">
      <div class="mb-3">
        <h2 class="text-xl font-semibold">Add Expenditure</h2>
      </div>
      <div class="mb-3">
        <x-input-label value="Title" for="title" class="mb-1" />
        <x-text-input wire:model="title" id="title" class="mb-1 w-full" placeholder="Title..." />
        <x-input-error :messages="$errors->get('title')" class="mb-1" />
      </div>
      <div class="mb-3">
        <x-input-label value="Date" for="date" class="mb-1" />
        <x-text-input type="date" wire:model="date" id="date" class="mb-1 w-full" />
        <x-input-error :messages="$errors->get('date')" class="mb-1" />
      </div>
      <div class="mb-3">
        <x-input-label value="Amount" for="amount" class="mb-1" />
        <x-text-input type="number" wire:model="amount" id="amount" class="mb-1 w-full" />
        <x-input-error :messages="$errors->get('amount')" class="mb-1" />
      </div>
      <div class="mb-3">
        <x-input-label value="Evidence" for="evidence" class="mb-1" />
        <x-text-input type="file" wire:model="evidence" id="evidence" class="mb-1 w-full border p-1.5" />
        <x-input-error :messages="$errors->get('evidence')" class="mb-1" />
      </div>
      <div class="mb-3">
        <x-input-label value="Description" for="description" class="mb-1" />
        <x-textarea wire:model="description" id="description" class="mb-1 w-full h-36"></x-textarea>
        <x-input-error :messages="$errors->get('description')" class="mb-1" />
      </div>
      <div class="flex justify-end items-center gap-x-2">
        <x-primary-button><i class="fa-solid fa-floppy-disk me-2"></i>Save</x-primary-button>
        <x-secondary-button wire:click="$dispatch('close-modal', 'add-expenditure')"><i
            class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
      </div>
    </form>
  </div>
</x-modal>
