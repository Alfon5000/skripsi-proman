<div class="overflow-auto" wire:poll.visible>

  <div class="mb-5 flex justify-end gap-x-2">
    <x-select wire:model.live="per_page" placeholder="All" placeholderValue="0">
      <option value="5">5</option>
      <option value="10">10</option>
      <option value="20">20</option>
      <option value="50">50</option>
      <option value="100">100</option>
    </x-select>
    <x-text-input wire:model.live="search" placeholder="Search..." />
  </div>
  @if ($notifications->count())
    <div class="mb-5">
      <table class="w-full">
        <thead>
          <tr>
            <th class="text-left border-b-2 pb-4 text-lg">Notification</th>
            <th class="text-left border-b-2 pb-4 text-lg">Notified At</th>
            <th class="text-center border-b-2 pb-4">
              <div class="flex justify-end gap-x-3 {{ $notifications->count() ? '' : 'hidden' }}">
                @if ($unreadNotifications->count())
                  <button wire:click="$dispatch('open-modal', 'read-all')">
                    <i class="fa-solid fa-circle-check hover:ring-2"></i>
                  </button>
                @endif
                <button wire:click="$dispatch('open-modal', 'delete-all')">
                  <i class="fa-solid fa-trash-can hover:ring-2 text-red-500"></i>
                </button>
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($notifications as $notification)
            <tr class="{{ $notification->read_at ? '' : 'font-bold' }}">
              <td class="text-left border-b-2 py-2">
                <a href="{{ $notification->data['url'] }}"
                  class="text-md text-gray-900 hover:text-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  wire:navigate>{{ $notification->data['message'] }}</a>
              </td>
              <td class="text-left border-b-2 py-2">
                {{ $notification->created_at->diffForHumans() }}</td>
              <td class="text-center border-b-2 py-2">
                <div class="flex justify-end gap-x-3">
                  <button wire:click="$dispatch('open-read-one', { notification: {{ $notification }} })"
                    class="{{ $notification->read_at ? 'hidden' : '' }}">
                    <i class="fa-regular fa-circle-check hover:ring-2"></i>
                  </button>
                  <button wire:click="$dispatch('open-delete-one', { notification: {{ $notification }} })">
                    <i class="fa-regular fa-trash-can hover:ring-2 text-red-500"></i>
                  </button>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div>
      {{ $notifications->links() }}
    </div>
  @else
    <div class="mt-6 p-3 border-2 rounded-lg border-red-500 text-center text-md text-red-500 font-semibold">
      Notification not
      found</div>
  @endif

</div>
