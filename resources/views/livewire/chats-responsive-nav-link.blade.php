<x-responsive-nav-link :href="route('chats')" class="flex justify-between items-center" wire:poll.visible>
  <div>{{ __('Chats') }}</div>
  <div
    class="size-6 {{ $unseenChats->count() > 0 ? 'bg-red-500' : 'bg-gray-500' }} rounded-full text-white text-xs flex justify-center items-center">
    {{ $unseenChats->count() > 9 ? '9+' : $unseenChats->count() }}</div>
</x-responsive-nav-link>
