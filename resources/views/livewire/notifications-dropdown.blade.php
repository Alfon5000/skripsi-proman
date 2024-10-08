<div class="hidden sm:flex sm:items-center sm:ms-6" wire:poll.visible>
  <x-dropdown align="right" width="72">
    <x-slot name="trigger">
      <button
        class="inline-flex items-center px-1 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
        <i class="fa-regular fa-bell fa-lg relative">
          @if ($unreadNotifications->count() > 9)
            <span class="absolute bg-red-500 text-[8px] text-white p-2 rounded-full -top-4 left-2">9+</span>
          @elseif ($unreadNotifications->count() > 0)
            <span
              class="absolute bg-red-500 text-[8px] text-white p-2 rounded-full -top-4 left-2">{{ $unreadNotifications->count() }}</span>
          @else
            <span class="absolute bg-gray-500 text-[8px] text-white p-2 rounded-full -top-4 left-2">0</span>
          @endif
        </i>
      </button>
    </x-slot>

    <x-slot name="content">
      <div class="flex justify-between items-center py-2 px-4 min-w-72 font-semibold">
        <div>{{ $unreadNotifications->count() }} New Notifications</div>
        @if ($unreadNotifications->count())
          <button wire:click="readAll">
            <i class="fa-solid fa-circle-check hover:ring-2"></i>
          </button>
        @endif
      </div>
      <hr>
      <div class="max-h-72 overflow-y-auto">
        @foreach ($unreadNotifications as $notification)
          <x-dropdown-item class="flex justify-between items-center {{ $notification->read_at ? '' : 'font-bold' }}">
            <div class="flex flex-col justify-center">
              <a
                href="{{ $notification->data['url'] }}">{{ str()->limit($notification->data['message'], 30, '...') }}</a>
              <p class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
            </div>
            <button wire:click.stop="readOne('{{ $notification->id }}')">
              <i class="fa-regular fa-circle-check hover:ring-2"></i>
            </button>
          </x-dropdown-item>
        @endforeach
      </div>
      <hr>
      <x-dropdown-link href="{{ route('notifications') }}" class="font-semibold flex justify-center items-center"
        wire:navigate>
        {{ __('See All Notifications') }}
      </x-dropdown-link>
    </x-slot>
  </x-dropdown>
</div>
