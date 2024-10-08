@php
  if (auth()->user()->role_id == 1) {
      $query = 'users';
  } else {
      $query = 'members';
  }
@endphp

<div wire:poll.visible>
  <h2 class="font-semibold text-xl mb-3">
    Online Users
  </h2>
  <div class="border rounded-md p-3 overflow-y-scroll max-h-96">
    @foreach ($onlineUsers as $user)
      <a href="/{{ $query }}?search={{ $user->name }}"
        class="flex justify-between items-center border rounded-sm p-3 hover:ring" wire:navigate>
        <div class="flex justify-start items-center">
          <img src="{{ asset('storage/users-avatar/' . $user->avatar) }}" alt="User Avatar"
            class="size-14 rounded-full border me-3">
          <div>
            <p class="font-semibold text-md">{{ $user->name }}</p>
            <p class="font-normal text-sm">{{ $user->department->name }} {{ $user->position->name }}</p>
          </div>
        </div>
        <div class="flex justify-center items-center">
          <div class="size-3 rounded-full {{ $user->login_at ? 'bg-green-500' : 'bg-gray-500' }}"></div>
        </div>
      </a>
    @endforeach
  </div>
</div>
