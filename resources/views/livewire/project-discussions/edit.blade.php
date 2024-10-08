<x-modal name="edit-discussion" maxWidth="2xl">
  <div class="p-5">
    <form wire:submit="update">
      <div class="mb-3">
        <h2 class="text-xl font-semibold">Edit Discussion</h2>
      </div>
      <div class="mb-3">
        <x-input-label value="Title" for="title" class="mb-1" />
        <x-text-input wire:model="title" id="title" class="mb-1 w-full" placeholder="Title..." />
        <x-input-error :messages="$errors->get('title')" class="mb-1" />
      </div>
      @can('admin-manager', $project)
        <div class="mb-3">
          <x-input-label value="Department" for="department_id" class="mb-1" />
          <x-select wire:model="department_id" id="department_id" class="mb-1 w-full" placeholder="All Departments">
            @foreach ($departments as $department)
              <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
          </x-select>
          <x-input-error :messages="$errors->get('department_id')" class="mb-1" />
        </div>
      @endcan
      <div class="mb-3" wire:model.debounce.500ms="description">
        <x-input-label value="Description" for="edit-discussion" class="mb-1" />
        <input type="hidden" id="edit-discussion" value="{{ $description }}">
        <trix-editor input="edit-discussion" class="mb-1 w-full h-48"></trix-editor>
        <x-input-error :messages="$errors->get('description')" class="mb-1" />
      </div>
      <div class="flex justify-end items-center gap-x-2">
        <x-primary-button><i class="fa-solid fa-circle-up me-2"></i>Update</x-primary-button>
        <x-secondary-button wire:click="$dispatch('close-modal', 'edit-discussion')"><i
            class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
      </div>
    </form>
  </div>
</x-modal>
