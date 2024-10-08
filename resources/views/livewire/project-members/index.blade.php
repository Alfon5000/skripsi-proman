<div wire:poll.visible>

  <div class="mb-5 flex flex-row-reverse justify-between">
    <div class="flex justify-end gap-x-2">
      <x-select wire:model.live="per_page" placeholder="All" placeholderValue="0">
        <option value="4">4</option>
        <option value="8">8</option>
        <option value="12">12</option>
        <option value="16">16</option>
        <option value="20">20</option>
      </x-select>
      <x-text-input wire:model.live="search" placeholder="Search..." />
    </div>
    @can('admin-manager', $project)
      <x-primary-button wire:click="$dispatch('open-modal', 'add-member')"><i class="fa-solid fa-plus"></i><span
          class="hidden sm:inline sm:ms-2">Add</span></x-primary-button>
    @endcan
  </div>

  @if ($members->count())
    <div class="mb-5 grid grid-cols-1 sm:grid-cols-4 gap-2">
      @foreach ($members as $member)
        @php
          if ($member->login_at) {
              $status = 'Online';
              $color = 'text-green-500';
          } else {
              $status = 'Offline';
              $color = 'text-gray-500';
          }

          $role = $member->id == $project->manager_id ? 'Manager' : 'Member';
        @endphp

        <div class="border rounded-md shadow-md p-3 flex justify-between">
          <div class="flex justify-start items-center gap-x-3">
            <img src="{{ asset('storage/users-avatar/' . $member->avatar) }}" alt="Member Avatar"
              class="size-16 rounded-full shadow-sm">
            <div class="text-sm">
              <h2 class="font-semibold">{{ $member->name }}</h2>
              <p class="font-normal">{{ $role }}</p>
              <p class="font-extrabold {{ $color }}">{{ $status }}</p>
            </div>
          </div>
          <div class="flex justify-center items-start">
            <button>
              <x-dropdown>
                <x-slot name="trigger">
                  <i class="fa-solid fa-ellipsis"></i>
                </x-slot>
                <x-slot name="content">
                  <x-dropdown-link
                    wire:click="$dispatch('open-details', {'project': {{ $project }}, 'member': {{ $member }}})"><i
                      class="fa-solid fa-circle-info me-2"></i>Details</x-dropdown-link>
                  @can('admin-manager', $project)
                    @if ($project->manager_id != $member->id)
                      <hr>
                      <x-dropdown-link
                        wire:click="$dispatch('open-change', {'project': {{ $project }}, 'member': {{ $member }}})"><i
                          class="fa-solid fa-user-tie me-2"></i>Set as Manager</x-dropdown-link>
                      <x-dropdown-link
                        wire:click="$dispatch('open-delete', {'project': {{ $project }}, 'member': {{ $member }}})"
                        class="text-red-500"><i class="fa-solid fa-trash-can me-2"></i>Delete</x-dropdown-link>
                    @endif
                  @endcan
                </x-slot>
              </x-dropdown>
            </button>
          </div>
        </div>
      @endforeach
    </div>

    <div>
      {{ $members->links() }}
    </div>
  @else
    <div class="mt-6 p-3 border-2 rounded-lg border-red-500 text-center text-md text-red-500 font-semibold">
      Member not
      found</div>
  @endif

</div>
