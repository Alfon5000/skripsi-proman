<div>

  <div class="mb-5 flex justify-between gap-x-2 overflow-auto">
    <x-primary-button wire:click="$dispatch('open-modal', 'create-project')">
      <i class="fa-solid fa-plus-square"></i><span class="hidden sm:inline sm:ms-2">Create</span>
    </x-primary-button>
    <div class="flex justify-end items-center gap-x-2">
      <x-select wire:model.live="per_page" placeholder="All" placeholderValue="0">
        <option value="3">3</option>
        <option value="6">6</option>
        <option value="9">9</option>
        <option value="12">12</option>
        <option value="15">15</option>
      </x-select>
      <x-select wire:model.live="category_id" placeholder="All Categories">
        @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </x-select>
      <x-text-input wire:model.live="search" placeholder="Search..." />
    </div>
  </div>

  @if ($projects->count())
    <div class="mb-5 grid grid-cols-1 sm:grid-cols-3 gap-3">
      @foreach ($projects as $project)
        @php
          $weightDoneTasks = DB::table('tasks AS t')
              ->join('priorities AS p', 't.priority_id', '=', 'p.id')
              ->select('p.weight')
              ->where('project_id', $project->id)
              ->where('t.status_id', 4)
              ->sum('p.weight');
          $weightAllTasks = DB::table('tasks AS t')
              ->join('priorities AS p', 't.priority_id', '=', 'p.id')
              ->select('p.weight')
              ->where('project_id', $project->id)
              ->sum('p.weight');

          if ($weightAllTasks > 0) {
              $progress = round(($weightDoneTasks / $weightAllTasks) * 100, 0) . '%';
          } else {
              $progress = '0%';
          }

          $color = '';

          if ((int) $progress > 0 && (int) $progress <= 25) {
              $color = 'bg-red-500';
          } elseif ((int) $progress > 25 && (int) $progress <= 50) {
              $color = 'bg-orange-500';
          } elseif ((int) $progress > 50 && (int) $progress <= 75) {
              $color = 'bg-yellow-500';
          } elseif ((int) $progress > 75 && (int) $progress <= 99) {
              $color = 'bg-green-500';
          } else {
              $color = 'bg-blue-500';
          }
        @endphp

        <div class="min-h-36 border rounded-md shadow-md p-5">
          <div class="flex justify-end mb-1">
            <button>
              <x-dropdown>
                <x-slot name="trigger">
                  <i class="fa-solid fa-ellipsis"></i>
                </x-slot>
                <x-slot name="content">
                  <x-dropdown-link href="projects/{{ $project->id }}/overview" wire:navigate>
                    <i class="fa-solid fa-chart-line me-2"></i>Overview
                  </x-dropdown-link>
                  <x-dropdown-link href="projects/{{ $project->id }}/members" wire:navigate>
                    <i class="fa-solid fa-people-group me-2"></i>Members
                  </x-dropdown-link>
                  <x-dropdown-link href="projects/{{ $project->id }}/tasks" wire:navigate>
                    <i class="fa-solid fa-list me-2"></i>Tasks
                  </x-dropdown-link>
                  <x-dropdown-link href="projects/{{ $project->id }}/discussions" wire:navigate>
                    <i class="fa-solid fa-comments me-2"></i>Discussions
                  </x-dropdown-link>
                  <x-dropdown-link href="projects/{{ $project->id }}/documents" wire:navigate>
                    <i class="fa-solid fa-file me-2"></i>Documents
                  </x-dropdown-link>
                  <x-dropdown-link href="projects/{{ $project->id }}/expenditures" wire:navigate>
                    <i class="fa-solid fa-coins me-2"></i>Expenditures
                  </x-dropdown-link>
                  <x-dropdown-link wire:click="$dispatch('open-details', { project: {{ $project }} })">
                    <i class="fa-solid fa-circle-info me-2"></i>Details
                  </x-dropdown-link>
                  @can('admin-manager', $project)
                    <hr>
                    <x-dropdown-link wire:click="$dispatch('open-edit', { project: {{ $project }} })">
                      <i class="fa-solid fa-pen-to-square me-2"></i>Edit
                    </x-dropdown-link>
                    <x-dropdown-link wire:click="$dispatch('open-delete', { project: {{ $project }} })"
                      class="text-red-500 font-medium">
                      <i class="fa-solid fa-trash-can me-2"></i>Delete
                    </x-dropdown-link>
                  @endcan
                </x-slot>
              </x-dropdown>
            </button>
          </div>
          <div class="mb-1">
            <h2 class="font-semibold text-md">Name</h2>
            <p class="font-normal text-sm">{{ $project->name }}</p>
          </div>
          <div class="mb-1">
            <h2 class="font-semibold text-md">Category</h2>
            <p class="font-normal text-sm">{{ $project->category->name }}</p>
          </div>
          <div class="mb-1">
            <div class="flex justify-between">
              <h2 class="font-semibold text-md">Progress</h2>
              <h2 class="font-semibold text-md">
                {{ $progress }}
              </h2>
            </div>
            <div class="h-1.5 rounded-full bg-gray-200 w-full my-1">
              <div class="h-1.5 rounded-full {{ $color }}" style="width: {{ $progress }}">
              </div>
            </div>
          </div>
          <div class="mb-1">
            <h2 class="font-semibold text-md">Members</h2>
            <div class="flex items-center gap-x-1 overflow-x-auto">
              @foreach ($project->members as $member)
                <img src="{{ asset('storage/users-avatar/' . $member->avatar) }}" alt="Member Avatar"
                  class="size-12 rounded-full shadow-md my-1">
              @endforeach
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div>
      {{ $projects->links() }}
    </div>
  @else
    <div class="mt-6 p-3 border-2 rounded-lg border-red-500 text-center text-md text-red-500 font-semibold">Project not
      found</div>
  @endif

</div>
