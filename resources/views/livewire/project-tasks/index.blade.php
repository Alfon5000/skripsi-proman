@php
  if ($tasks->count() > 0) {
      $percentage = round($dones->count() / $all->count(), 2) * 100 . '%';
  } else {
      $percentage = '0%';
  }
@endphp

<div>

  <div class="mb-5 flex justify-between gap-x-2 overflow-auto">
    <x-primary-button wire:click="$dispatch('open-modal', 'add-task')"><i class="fa-solid fa-plus"></i><span
        class="hidden sm:inline sm:ms-2">Add</span></x-primary-button>
    <div class="flex justify-end items-center gap-x-2">
      <x-select wire:model.live="priority_id" placeholder="All Priorities">
        @foreach ($priorities as $priority)
          <option value="{{ $priority->id }}">{{ $priority->name }}</option>
        @endforeach
      </x-select>
      <x-text-input wire:model.live="search" placeholder="Search..." />
    </div>
  </div>
  <div class="mb-5">
    <div class="flex justify-between">
      <h2 class="text-sm font-semibold">Done Tasks</h2>
      <h2 class="text-sm font-semibold">
        {{ $dones->count() }}/{{ $all->count() }}
      </h2>
    </div>
    <div class="h-1.5 rounded-full bg-gray-200 w-full my-1">
      <div class="h-1.5 rounded-full bg-blue-500" style="width: {{ $percentage }}"></div>
    </div>
  </div>
  <div>
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 sm:gap-6">
      <x-task-list headerColor="bg-red-500" title="To Do" id="todos" :tasks="$tasks" statusId="1" />
      <x-task-list headerColor="bg-yellow-500" title="In Progress" id="progresses" :tasks="$tasks" statusId="2" />
      <x-task-list headerColor="bg-green-500" title="In Review" id="reviews" :tasks="$tasks" statusId="3" />
      <x-task-list headerColor="bg-blue-500" title="Done" id="dones" :tasks="$tasks" statusId="4" />
    </div>
  </div>

</div>
