<div class="hidden sm:flex sm:items-center sm:ms-6" wire:poll.visible>
  <x-dropdown align="right" width="72">
    <x-slot name="trigger">
      <button
        class="inline-flex items-center px-1 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
        <i class="fa-regular fa-comment fa-lg relative">
          @if ($chats->count() > 9)
            <span class="absolute bg-red-500 text-[8px] text-white p-2 rounded-full -top-4 left-2">9+</span>
          @elseif ($chats->count() > 0)
            <span
              class="absolute bg-red-500 text-[8px] text-white p-2 rounded-full -top-4 left-2">{{ $chats->count() }}</span>
          @else
            <span class="absolute bg-gray-500 text-[8px] text-white p-2 rounded-full -top-4 left-2">0</span>
          @endif
        </i>
      </button>
    </x-slot>

    <x-slot name="content">
      <div class="flex justify-between items-center py-2 px-4 min-w-72 font-semibold">
        <div>{{ $chats->count() }} New Chats</div>
        @if ($chats->count())
          <button wire:click="seeAll">
            <i class="fa-solid fa-circle-check hover:ring-2"></i>
          </button>
        @endif
      </div>
      <hr>
      <div class="max-h-72 overflow-y-auto">
        @foreach ($chats as $chat)
          <x-dropdown-item class="flex justify-between items-center {{ $chat->seen ? '' : 'font-bold' }}">
            <div class="flex items-center">
              <img src="{{ asset('storage/users-avatar/' . $chat->fromUser->avatar) }}" alt="User Avatar"
                class="size-10 mr-4 rounded-full">
              <div>
                <p class="text-sm">{{ $chat->fromUser->name }}</p>
                <p class="text-sm">{{ str()->limit($chat->body, 20, '...') }}</p>
                <p class="text-xs text-gray-500">{{ $chat->created_at->diffForHumans() }}
                </p>
              </div>
            </div>
            <button wire:click.stop="seeOne('{{ $chat->id }}')">
              <i class="fa-regular fa-circle-check hover:ring-2"></i>
            </button>
          </x-dropdown-item>
        @endforeach
      </div>
      <hr>
      <x-dropdown-link href="/chats" class="font-semibold flex justify-center items-center">
        {{ __('See All Chats') }}
      </x-dropdown-link>
    </x-slot>
  </x-dropdown>
</div>
