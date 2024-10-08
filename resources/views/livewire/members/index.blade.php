<div wire:poll.visible>

  <div class="mb-5 flex justify-start sm:justify-end items-center gap-x-2 overflow-auto">
    <x-select wire:model.live="per_page" placeholder="All" placeholderValue="0">
      <option value="4">4</option>
      <option value="8">8</option>
      <option value="12">12</option>
      <option value="16">16</option>
      <option value="20">20</option>
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

  @if ($members->count())
    <div class="mb-5 grid grid-cols-1 sm:grid-cols-4 gap-3">
      @foreach ($members as $member)
        @php
          if ($member->login_at) {
              $status = 'Online';
              $color = 'text-green-500';
          } else {
              $status = 'Offline';
              $color = 'text-gray-500';
          }

        @endphp

        <div class="border rounded-md shadow-md p-3 flex justify-between">
          <div class="flex justify-start items-center gap-x-3">
            <img src="{{ asset('storage/users-avatar/' . $member->avatar) }}" alt="Member Avatar"
              class="size-16 rounded-full shadow-sm">
            <div class="text-sm">
              <h2 class="font-semibold">{{ $member->name }}</h2>
              <p class="font-normal">{{ $member->department->name }} {{ $member->position->name }}</p>
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
                  <x-dropdown-link wire:click="$dispatch('open-details', {'member': {{ $member }}})"><i
                      class="fa-solid fa-circle-info me-2"></i>Details</x-dropdown-link>
                  <x-dropdown-link href="chats/{{ $member->id }}"><i
                      class="fa-solid fa-comment me-2"></i>Chat</x-dropdown-link>
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
