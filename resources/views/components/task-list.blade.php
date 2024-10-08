@props(['headerColor', 'title', 'id', 'tasks', 'statusId'])

<div>

  <div class="{{ $headerColor }} p-3 rounded-t-md shadow-md">
    <h2 class="text-white text-lg font-semibold">{{ $title }}</h2>
  </div>
  <div class="border p-4 rounded-b-md shadow-md min-h-96">
    <div id="{{ $id }}" class="board min-h-96 py-10 px-5 rounded-md" ondragover="onDragOver(event)"
      ondragenter="onDragEnter(event)" ondragleave="onDragLeave(event)" ondrop="onDrop(event)">
      @foreach ($tasks as $task)
        @php
          if ($task->priority_id == 4) {
              $color = 'text-red-500';
          } elseif ($task->priority_id == 3) {
              $color = 'text-yellow-500';
          } elseif ($task->priority_id == 2) {
              $color = 'text-green-500';
          } else {
              $color = 'text-gray-500';
          }

          if (
              auth()->user()->role_id == 1 ||
              $task->project->manager_id == auth()->id() ||
              $task->worker_id == auth()->id()
          ) {
              $draggable = 'true';
          } else {
              $draggable = 'false';
          }
        @endphp

        @if ($task->status_id == $statusId)
          <div class="task border rounded-md shadow-md my-3 p-3 flex justify-between items-start"
            draggable="{{ $draggable }}" data-id="{{ $task->id }}" wire:key="{{ $task->id }}"
            ondragstart="onDragStart(event)">
            <div class="flex items-start gap-x-3">
              <img src="{{ asset('storage/users-avatar/' . $task->worker->avatar) }}" alt="Worker Avatar"
                class="size-14 rounded-full shadow-sm" draggable="false">
              <div class="text-sm">
                <div class="text-sm">
                  <div class="my-1">
                    <h3 class="font-semibold">Title</h3>
                    <p class="font-normal">{{ $task->title }}</p>
                  </div>
                  <div class="mb-1">
                    <h3 class="font-semibold">Worker</h3>
                    <p class="font-normal">{{ $task->worker->name }}</p>
                  </div>
                  <div class="mb-1">
                    <h3 class="font-semibold">Priority</h3>
                    <p class="font-normal {{ $color }}">{{ $task->priority->name }}</p>
                  </div>
                  <div class="mb-1">
                    <h3 class="font-semibold">Due date</h3>
                    <p class="font-normal">{{ $task->end_time->diffForHumans() }}</p>
                  </div>
                </div>
              </div>
            </div>
            <button>
              <x-dropdown>
                <x-slot name="trigger">
                  <i class="fa-solid fa-ellipsis"></i>
                </x-slot>
                <x-slot name="content">
                  <x-dropdown-link wire:click="$dispatch('open-details', { task: {{ $task }} })"><i
                      class="fa-solid fa-circle-info me-2"></i>Details</x-dropdown-link>
                  @can('admin-manager-worker', $task)
                    <x-dropdown-link wire:click="$dispatch('open-edit', { task: {{ $task }} })"><i
                        class="fa-solid fa-pen-to-square me-2"></i>Edit</x-dropdown-link>
                    <x-dropdown-link wire:click="$dispatch('open-delete', { task: {{ $task }} })"
                      class="text-red-500 font-medium"><i class="fa-solid fa-trash-can me-2"></i>Delete</x-dropdown-link>
                  @endcan
                </x-slot>
              </x-dropdown>
            </button>
          </div>
        @endif
      @endforeach
    </div>
  </div>
</div>

<script>
  var selectedTask = null;

  function onDragStart(event) {
    selectedTask = event.target;
    selectedTask.classList.add('opacity-5');
  }

  function onDragOver(event) {
    event.preventDefault();
    return false;
  }

  function onDragEnter(event) {
    event.target.classList.add('bg-gray-200');
  }

  function onDragLeave(event) {
    event.target.classList.remove('bg-gray-200');
  }

  function onDrop(event) {
    event.stopPropagation();
    event.preventDefault();
    event.target.classList.remove('bg-gray-200');

    if (event.target.classList.contains('board')) {
      event.target.appendChild(selectedTask);
    } else {
      event.preventDefault();
      window.dispatchEvent(new CustomEvent('refresh-tasks'));
    }

    if (event.target.id == 'todos') {
      window.dispatchEvent(new CustomEvent('update-status', {
        detail: {
          id: selectedTask.dataset.id,
          statusId: 1,
        }
      }));
    } else if (event.target.id == 'progresses') {
      window.dispatchEvent(new CustomEvent('update-status', {
        detail: {
          id: selectedTask.dataset.id,
          statusId: 2,
        }
      }));
    } else if (event.target.id == 'reviews') {
      window.dispatchEvent(new CustomEvent('update-status', {
        detail: {
          id: selectedTask.dataset.id,
          statusId: 3,
        }
      }));
    } else if (event.target.id == 'dones') {
      window.dispatchEvent(new CustomEvent('update-status', {
        detail: {
          id: selectedTask.dataset.id,
          statusId: 4,
        }
      }));
    }
  }
</script>
