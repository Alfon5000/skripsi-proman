<x-modal name="task-details" maxWidth="sm">
  @if ($task)
    <div class="p-5">
      <div class="mb-3 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Task Details</h2>
        <button wire:click="$dispatch('close-modal', 'task-details')">
          <i class="fa-solid fa-xmark fa-lg"></i>
        </button>
      </div>
      <table class="w-full">
        <tr>
          <td class="border p-2">Title</td>
          <td class="border p-2">{{ $task->title }}</td>
        </tr>
        <tr>
          <td class="border p-2">Project</td>
          <td class="border p-2">{{ $task->project->name }}</td>
        </tr>
        <tr>
          <td class="border p-2">Start Time</td>
          <td class="border p-2">{{ $task->start_time->toDayDateTimeString() }}</td>
        </tr>
        <tr>
          <td class="border p-2">End Time</td>
          <td class="border p-2">{{ $task->end_time->toDayDateTimeString() }}</td>
        </tr>
        <tr>
          <td class="border p-2">Priority</td>
          <td class="border p-2">{{ $task->priority->name }}</td>
        </tr>
        <tr>
          <td class="border p-2">Status</td>
          <td class="border p-2">{{ $task->status->name }}</td>
        </tr>
        <tr>
          <td class="border p-2">Description</td>
          <td class="border p-2">{{ $task->description }}</td>
        </tr>
      </table>
    </div>
  @endif
</x-modal>
