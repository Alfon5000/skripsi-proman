<div class="overflow-auto">

  <div class="mb-5 flex justify-between">
    <x-primary-button wire:click="$dispatch('open-modal', 'add-expenditure')"><i class="fa-solid fa-plus"></i><span
        class="hidden sm:inline sm:ms-2">Add</span></x-primary-button>
    <div class="flex justify-end gap-x-2">
      <x-select wire:model.live="per_page" placeholder="All" placeholderValue="0">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
      </x-select>
      <x-text-input wire:model.live="search" placeholder="Search..." />
    </div>
  </div>

  @php
    if ($project->budget != 0) {
        $percentage = round($totalExpenditures / $project->budget, 3) * 100 . '%';
    } else {
        $percentage = '0%';
    }
  @endphp

  <div class="mb-5 border-2 p-5 rounded-lg">
    <div class="flex justify-between">
      <div class="flex items-center gap-x-1">
        <span class="size-3 rounded-full bg-red-500"></span>
        <span>Expenditures: Rp. {{ number_format($totalExpenditures, 0, ',', '.') }}</span>
      </div>
      <div class="flex items-center gap-x-1">
        <span class="size-3 rounded-full bg-green-500"></span>
        <span>Budget: Rp. {{ number_format($project->budget - $totalExpenditures, 0, ',', '.') }}</span>
      </div>
    </div>
    <div class="h-1.5 rounded-full bg-green-500 w-full my-1 flex">
      <div class="h-1.5 rounded-full bg-red-500" style="width: {{ $percentage }}">
      </div>
    </div>
  </div>

  @if ($expenditures->count())
    <div class="mb-5">
      <table class="w-full border">
        <thead>
          <tr>
            <th class="border p-2">No</th>
            <th class="border p-2">Title</th>
            <th class="border p-2">Uploaded By</th>
            <th class="border p-2">Date</th>
            <th class="border p-2">Amount</th>
            <th class="border p-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($expenditures as $expenditure)
            <tr wire:key="{{ $expenditure->id }}">
              <td class="border p-2 text-center">{{ $loop->iteration }}</td>
              <td class="border p-2">{{ $expenditure->title }}</td>
              <td class="border p-2">{{ $expenditure->uploader->name }}</td>
              <td class="border p-2 text-center">{{ $expenditure->date->toDayDateTimeString() }}</td>
              <td class="border p-2">Rp. {{ number_format($expenditure->amount, 0, ',', '.') }}</td>
              <td class="border p-2 flex justify-center items-center gap-x-1">
                <x-secondary-button wire:click="$dispatch('open-details', { expenditure: {{ $expenditure }} })"><i
                    class="fa-solid fa-circle-info"></i><span
                    class="hidden sm:inline sm:ms-2">Details</span></x-secondary-button>
                @can('admin-manager-uploader', $expenditure)
                  <x-primary-button wire:click="$dispatch('open-edit', { expenditure: {{ $expenditure }} })"><i
                      class="fa-solid fa-pen-to-square"></i><span
                      class="hidden sm:inline sm:ms-2">Edit</span></x-primary-button>
                  <x-danger-button wire:click="$dispatch('open-delete', { expenditure: {{ $expenditure }} })"><i
                      class="fa-solid fa-trash-can"></i><span
                      class="hidden sm:inline sm:ms-2">Delete</span></x-danger-button>
                @endcan
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div>
      {{ $expenditures->links() }}
    </div>
  @else
    <div class="mt-6 p-3 border-2 rounded-lg border-red-500 text-center text-md text-red-500 font-semibold">
      Expenditure not
      found</div>
  @endif
</div>
