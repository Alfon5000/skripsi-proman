<x-modal name="project-details" maxWidth="sm">
  @if ($project)
    <div class="p-5">
      <div class="mb-3 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Project Details</h2>
        <button wire:click="$dispatch('close-modal', 'project-details')">
          <i class="fa-solid fa-xmark fa-lg"></i>
        </button>
      </div>
      <table class="w-full">
        <tr>
          <td class="border p-2">Name</td>
          <td class="border p-2">{{ $project->name }}</td>
        </tr>
        <tr>
          <td class="border p-2">Category</td>
          <td class="border p-2">{{ $project->category->name }}</td>
        </tr>
        <tr>
          <td class="border p-2">Manager</td>
          <td class="border p-2">{{ $project->manager->name }}</td>
        </tr>
        <tr>
          <td class="border p-2">Start Time</td>
          <td class="border p-2">{{ $project->start_time->toDayDateTimeString() }}</td>
        </tr>
        <tr>
          <td class="border p-2">End Time</td>
          <td class="border p-2">{{ $project->end_time->toDayDateTimeString() }}</td>
        </tr>
        <tr>
          <td class="border p-2">Budget</td>
          <td class="border p-2">Rp. {{ number_format($project->budget, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <td class="border p-2">Description</td>
          <td class="border p-2">{{ $project->description }}</td>
        </tr>
      </table>
    </div>
  @endif
</x-modal>
