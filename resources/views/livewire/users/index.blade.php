<div class="overflow-auto">

  <div class="mb-5 flex justify-between gap-x-2">
    <x-primary-button wire:click="$dispatch('open-modal', 'create-user')"><i class="fa-solid fa-plus-square"></i><span
        class="hidden sm:inline sm:ms-2">Create</span></x-primary-button>
    <div class="flex justify-end items-center gap-x-2">
      <x-select wire:model.live="per_page" placeholder="All" placeholderValue="0">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="50">50</option>
        <option value="100">100</option>
      </x-select>
      <x-select wire:model.live="role_id" placeholder="All Roles">
        @foreach ($roles as $role)
          <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
      </x-select>
      <x-select wire:model.live="department_id" placeholder="All Departments">
        @foreach ($departments as $department)
          <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
      </x-select>
      <x-select wire:model.live="position_id" placeholder="All Positions">
        @foreach ($positions as $position)
          <option value="{{ $position->id }}">{{ $position->name }}</option>
        @endforeach
      </x-select>
      <x-text-input wire:model.live="search" placeholder="Search..." />
    </div>
  </div>

  @if ($users->count())
    <div class="mb-5">
      <table class="w-full border">
        <thead>
          <tr>
            <th class="border p-2">No</th>
            <th class="border p-2">Name</th>
            <th class="border p-2">Email</th>
            <th class="border p-2">Role</th>
            <th class="border p-2">Department</th>
            <th class="border p-2">Position</th>
            <th class="border p-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr wire:key="{{ $user->id }}">
              <td class="border p-2 text-center">{{ $loop->iteration }}</td>
              <td class="border p-2">{{ $user->name }}</td>
              <td class="border p-2">{{ $user->email }}</td>
              <td class="border p-2 text-center">{{ $user->role->name }}</td>
              <td class="border p-2 text-center">{{ $user->department->name }}</td>
              <td class="border p-2 text-center">{{ $user->position->name }}</td>
              <td class="border p-2 flex justify-center items-center gap-x-1">
                <x-secondary-button wire:click="$dispatch('open-details', { user: {{ $user }} })"><i
                    class="fa-solid fa-circle-info"></i><span
                    class="hidden sm:inline sm:ms-2">Details</span></x-secondary-button>
                <x-primary-button wire:click="$dispatch('open-edit', { user: {{ $user }} })"><i
                    class="fa-solid fa-pen-to-square"></i><span
                    class="hidden sm:inline sm:ms-2">Edit</span></x-primary-button>
                <x-danger-button wire:click="$dispatch('open-delete', { user: {{ $user }} })"><i
                    class="fa-solid fa-trash-can"></i><span
                    class="hidden sm:inline sm:ms-2">Delete</span></x-danger-button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div>
      {{ $users->links() }}
    </div>
  @else
    <div class="mt-6 p-3 border-2 rounded-lg border-red-500 text-center text-md text-red-500 font-semibold">
      User not
      found</div>
  @endif
</div>
