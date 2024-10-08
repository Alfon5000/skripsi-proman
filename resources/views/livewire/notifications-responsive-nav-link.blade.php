<x-responsive-nav-link :href="route('notifications')" wire:navigate class="flex justify-between items-center" wire:poll.visible>
  <div>{{ __('Notifications') }}</div>
  <div
    class="size-6 {{ $unreadNotifications->count() > 0 ? 'bg-red-500' : 'bg-gray-500' }} rounded-full text-white text-xs flex justify-center items-center">
    {{ $unreadNotifications->count() > 9 ? '9+' : $unreadNotifications->count() }}</div>
</x-responsive-nav-link>
