<x-modal name="edit-project" maxWidth="sm">
  @if ($project)
    <div class="p-5">
      <form wire:submit="update">
        <div class="mb-3">
          <h2 class="text-xl font-semibold">Edit Project</h2>
        </div>
        <div class="mb-3">
          <x-input-label value="Name" for="name" class="mb-1" />
          <x-text-input wire:model="name" id="name" class="mb-1 w-full" placeholder="Name..." />
          <x-input-error :messages="$errors->get('name')" class="mb-1" />
        </div>
        <div class="mb-3">
          <x-input-label value="Category" for="category" class="mb-1" />
          <x-select wire:model="category_id" placeholder="Choose Category..." class="mb-1 w-full" id="category">
            @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </x-select>
          <x-input-error :messages="$errors->get('category_id')" class="mb-1" />
        </div>
        @can('admin')
          <div class="mb-3">
            <x-input-label value="Manager" for="manager_id" class="mb-1" />
            <x-select wire:model="manager_id" placeholder="Choose Manager..." class="mb-1 w-full" id="manager_id">
              @foreach ($project->members()->orderBy('name')->get() as $manager)
                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
              @endforeach
            </x-select>
            <x-input-error :messages="$errors->get('manager_id')" class="mb-1" />
          </div>
        @endcan
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
          <x-input-label value="Budget" for="budget" class="mb-1" />
          <x-text-input type="number" wire:model="budget" id="budget" class="mb-1 w-full" placeholder="Budget..." />
          <x-input-error :messages="$errors->get('budget')" class="mb-1" />
        </div>
        <div class="mb-3">
          <x-input-label value="Description" for="description" class="mb-1" />
          <x-textarea wire:model="description" id="description" class="mb-1 w-full h-36"></x-textarea>
          <x-input-error :messages="$errors->get('description')" class="mb-1" />
        </div>
        <div class="flex justify-end items-center gap-x-2">
          <x-primary-button><i class="fa-solid fa-circle-up me-2"></i>Update</x-primary-button>
          <x-secondary-button wire:click="$dispatch('close-modal', 'edit-project')"><i
              class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
        </div>
      </form>
    </div>
  @endif
</x-modal>
