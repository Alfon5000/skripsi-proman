<x-modal name="event-details" maxWidth="sm">
  @if ($event)
    <div class="p-5">
      <div class="mb-3 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Event Details</h2>
        <button wire:click="$dispatch('close-modal', 'event-details')">
          <i class="fa-solid fa-xmark fa-lg"></i>
        </button>
      </div>
      <table class="w-full">
        <tr>
          <td class="border p-2">Title</td>
          <td class="border p-2">{{ $event->title }}</td>
        </tr>
        <tr>
          <td class="border p-2">Start Time</td>
          <td class="border p-2">{{ $event->start_time->toDayDateTimeString() }}</td>
        </tr>
        <tr>
          <td class="border p-2">End Time</td>
          <td class="border p-2">{{ $event->end_time->toDayDateTimeString() }}</td>
        </tr>
        <tr>
          <td class="border p-2">Description</td>
          <td class="border p-2">{{ $event->description }}</td>
        </tr>
      </table>
    </div>
  @endif
</x-modal>
