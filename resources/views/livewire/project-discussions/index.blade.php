<div class="overflow-auto">

  <div class="mb-5 flex justify-between gap-x-2">
    <x-primary-button wire:click="$dispatch('open-modal', 'add-discussion')"><i class="fa-solid fa-plus"></i><span
        class="hidden sm:inline sm:ms-2">Add</span></x-primary-button>
    <div class="flex justify-end gap-x-2">
      <x-select wire:model.live="per_page" placeholder="All" placeholderValue="0">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
      </x-select>
      @can('admin-manager', $project)
        <x-select wire:model.live="department_id" placeholder="All Departments">
          @foreach ($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
          @endforeach
        </x-select>
      @endcan
      <x-text-input wire:model.live="search" placeholder="Search..." />
    </div>
  </div>

  @if ($discussions->count())
    <div class="mb-5">
      <table class="w-full border">
        <thead>
          <tr>
            <th class="border p-2">No</th>
            <th class="border p-2">Title</th>
            @can('admin-manager', $project)
              <th class="border p-2">Department</th>
            @endcan
            <th class="border p-2">Created By</th>
            <th class="border p-2">Created At</th>
            <th class="border p-2">Comments</th>
            <th class="border p-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($discussions as $discussion)
            <tr wire:key="{{ $discussion->id }}">
              <td class="border p-2 text-center">{{ $loop->iteration }}</td>
              <td class="border p-2">{{ $discussion->title }}</td>
              @can('admin-manager', $project)
                <td class="border p-2">{{ $discussion->department->name ?? 'All Departments' }}</td>
              @endcan
              <td class="border p-2">{{ $discussion->creater->name }}</td>
              <td class="border p-2 text-center">{{ $discussion->created_at->toDayDateTimeString() }}</td>
              <td class="border p-2 text-center">{{ $discussion->comments->count() }}</td>
              <td class="border p-2 flex justify-center items-center gap-x-1">
                <x-secondary-link
                  href="{{ route('project.discussion.comments', ['project' => $project, 'discussion' => $discussion]) }}"
                  wire:navigate><i class="fa-solid fa-comment"></i><span
                    class="hidden sm:inline sm:ms-2">Comment</span></x-secondary-link>
                @can('admin-creater', $discussion)
                  <x-primary-button wire:click="$dispatch('open-edit', { discussion: {{ $discussion }} })"><i
                      class="fa-solid fa-pen-to-square"></i><span
                      class="hidden sm:inline sm:ms-2">Edit</span></x-primary-button>
                  <x-danger-button wire:click="$dispatch('open-delete', { discussion: {{ $discussion }} })"><i
                      class="fa-solid fa-trash-can"></i><span
                      class="hidden sm:inline sm:ms-2">Delete</span></x-danger-button>
                @endcan
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div>
      {{ $discussions->links() }}
    </div>
  @else
    <div class="mt-6 p-3 border-2 rounded-lg border-red-500 text-center text-md text-red-500 font-semibold">
      Discussion not
      found</div>
  @endif

</div>
