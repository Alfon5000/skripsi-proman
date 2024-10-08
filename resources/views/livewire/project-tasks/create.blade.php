<x-modal name="add-task" maxWidth="sm">
  <div class="p-5">
    <form wire:submit="store">
      <div class="mb-3">
        <h2 class="text-xl font-semibold">Add Task</h2>
      </div>
      <div class="mb-3">
        <x-input-label value="Title" for="title" class="mb-1" />
        <x-text-input wire:model="title" id="title" class="mb-1 w-full" placeholder="Title..." />
        <x-input-error :messages="$errors->get('title')" class="mb-1" />
      </div>
      @can('admin-manager', $project)
        <div class="mb-3">
          <x-input-label value="Worker" for="worker_id" class="mb-1" />
          <x-select wire:model="worker_id" id="worker_id" class="mb-1 w-full" placeholder="Choose Worker...">
            @foreach ($workers as $worker)
              <option value="{{ $worker->id }}">{{ $worker->name }}</option>
            @endforeach
          </x-select>
          <x-input-error :messages="$errors->get('worker_id')" class="mb-1" />
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
        <x-input-label value="Priority" for="priority_id" class="mb-1" />
        <x-select wire:model="priority_id" id="priority_id" class="mb-1 w-full" placeholder="Choose Priority...">
          @foreach ($priorities as $priority)
            <option value="{{ $priority->id }}">{{ $priority->name }}</option>
          @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('priority_id')" class="mb-1" />
      </div>
      {{-- <div class="mb-3">
        <x-input-label value="Status" for="status_id" class="mb-1" />
        <x-select wire:model="status_id" id="status_id" class="mb-1 w-full" placeholder="Choose Status...">
          @foreach ($statuses as $status)
            <option value="{{ $status->id }}">{{ $status->name }}</option>
          @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('status_id')" class="mb-1" />
      </div> --}}
      <div class="mb-3">
        <x-input-label value="Description" for="description" class="mb-1" />
        <x-textarea wire:model="description" id="description" class="mb-1 w-full h-36"></x-textarea>
        <x-input-error :messages="$errors->get('description')" class="mb-1" />
      </div>
      <div class="flex justify-end items-center gap-x-2">
        <x-primary-button><i class="fa-solid fa-floppy-disk me-2"></i>Save</x-primary-button>
        <x-secondary-button wire:click="$dispatch('close-modal', 'add-task')"><i
            class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
      </div>
    </form>
  </div>
</x-modal>
