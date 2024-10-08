<div>

  <div class="mb-5 flex justify-end gap-x-2 overflow-auto">
    <div class="flex justify-end items-center gap-x-2">
      <x-select wire:model.live="per_page" placeholder="All" placeholderValue="0">
        <option value="4">4</option>
        <option value="8">8</option>
        <option value="12">12</option>
        <option value="16">16</option>
        <option value="20">20</option>
      </x-select>
      <x-select wire:model.live="project_id" placeholder="All Projects">
        @foreach ($projects as $project)
          <option value="{{ $project->id }}">{{ $project->name }}</option>
        @endforeach
      </x-select>
      <x-select wire:model.live="priority_id" placeholder="All Priorities">
        @foreach ($priorities as $priority)
          <option value="{{ $priority->id }}">{{ $priority->name }}</option>
        @endforeach
      </x-select>
      <x-select wire:model.live="status_id" placeholder="All Statuses">
        @foreach ($statuses as $status)
          <option value="{{ $status->id }}">{{ $status->name }}</option>
        @endforeach
      </x-select>
      <x-text-input wire:model.live="search" placeholder="Search..." />
    </div>
  </div>

  @php
    $done = \App\Models\Task::workerId(auth()->id())->done()->get()->count();
    $all = \App\Models\Task::workerId(auth()->id())->get()->count();

    if ($all > 0) {
        $percentage = round($done / $all, 2) * 100 . '%';
    } else {
        $percentage = '0%';
    }
  @endphp

  <div class="mb-5">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-md">Done Tasks</h2>
      <h2 class="font-semibold text-md">
        {{ $done }}/{{ $all }}
      </h2>
    </div>
    <div class="h-1.5 rounded-full bg-gray-200 w-full my-1">
      <div class="h-1.5 rounded-full bg-blue-500" style="width: {{ $percentage }}">
      </div>
    </div>
  </div>

  @if ($tasks->count())


    <div class="mb-5 grid grid-cols-1 sm:grid-cols-4 gap-3 sm:gap-6">
      @foreach ($tasks as $task)
        @php
          $borderColor = '';
          $statusColor = '';

          if ($task->status_id == 1) {
              $borderColor = 'border-red-500';
              $statusColor = 'text-red-500';
          } elseif ($task->status_id == 2) {
              $borderColor = 'border-yellow-500';
              $statusColor = 'text-yellow-500';
          } elseif ($task->status_id == 3) {
              $borderColor = 'border-green-500';
              $statusColor = 'text-green-500';
          } else {
              $borderColor = 'border-blue-500';
              $statusColor = 'text-blue-500';
          }

          $priorityColor = '';

          if ($task->priority_id == 4) {
              $priorityColor = 'text-red-500';
          } elseif ($task->priority_id == 3) {
              $priorityColor = 'text-yellow-500';
          } elseif ($task->priority_id == 2) {
              $priorityColor = 'text-green-500';
          } else {
              $priorityColor = 'text-gray-500';
          }
        @endphp

        <div class="border {{ $borderColor }} rounded-md shadow-md flex justify-between items-start p-5">
          <div class="my-1">
            <div class="mb-1">
              <h2 class="font-semibold text-md">Title</h2>
              <p class="font-normal text-sm">{{ $task->title }}</p>
            </div>
            <div class="mb-1">
              <h2 class="font-semibold text-md">Project</h2>
              <p class="font-normal text-sm">{{ $project->name }}</p>
            </div>
            <div class="mb-1">
              <h2 class="font-semibold text-md">Status</h2>
              <p class="font-normal text-sm {{ $statusColor }}">{{ $task->status->name }}</p>
            </div>
            <div>
              <h2 class="font-semibold text-md">Priority</h2>
              <p class="font-normal text-sm {{ $priorityColor }}">{{ $task->priority->name }}</p>
            </div>
          </div>
          <button>
            <x-dropdown>
              <x-slot name="trigger">
                <i class="fa-solid fa-ellipsis"></i>
              </x-slot>
              <x-slot name="content">
                <x-dropdown-link href="projects/{{ $task->project_id }}/tasks?search={{ $task->title }}"
                  wire:navigate>
                  <i class="fa-solid fa-circle-right me-2"></i>Go to Task
                </x-dropdown-link>
                <x-dropdown-link wire:click="$dispatch('open-details', { task : {{ $task }} })">
                  <i class="fa-solid fa-circle-info me-2"></i>Details
                </x-dropdown-link>
              </x-slot>
            </x-dropdown>
          </button>
        </div>
      @endforeach
    </div>

    <div>
      {{ $tasks->links() }}
    </div>
  @else
    <div class="mt-6 p-3 border-2 rounded-lg border-red-500 text-center text-md text-red-500 font-semibold">Task not
      found</div>
  @endif

</div>
