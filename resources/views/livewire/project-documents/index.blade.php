<div class="overflow-auto">

  <div class="mb-5 flex justify-between">
    <x-primary-button wire:click="$dispatch('open-modal', 'add-document')"><i class="fa-solid fa-plus"></i><span
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

  @if ($documents->count())
    <div class="mb-5">
      <table class="w-full border">
        <thead>
          <tr>
            <th class="border p-2">No</th>
            <th class="border p-2">Title</th>
            <th class="border p-2">Uploaded By</th>
            <th class="border p-2">Uploaded At</th>
            <th class="border p-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($documents as $document)
            <tr wire:key="{{ $document->id }}">
              <td class="border p-2 text-center">{{ $loop->iteration }}</td>
              <td class="border p-2">{{ $document->title }}</td>
              <td class="border p-2">{{ $document->uploader->name }}</td>
              <td class="border p-2 text-center">{{ $document->created_at->toDayDateTimeString() }}</td>
              <td class="border p-2 flex justify-center items-center gap-x-1">
                <x-secondary-button wire:click="download('{{ $document->file }}')"><i
                    class="fa-solid fa-download"></i><span
                    class="hidden sm:inline sm:ms-2">Download</span></x-secondary-button>
                @can('admin-manager-uploader', $document)
                  <x-primary-button wire:click="$dispatch('open-edit', { document: {{ $document }} })"><i
                      class="fa-solid fa-pen-to-square"></i><span
                      class="hidden sm:inline sm:ms-2">Edit</span></x-primary-button>
                  <x-danger-button wire:click="$dispatch('open-delete', { document: {{ $document }} })"><i
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
      {{ $documents->links() }}
    </div>
  @else
    <div class="mt-6 p-3 border-2 rounded-lg border-red-500 text-center text-md text-red-500 font-semibold">
      Document not
      found</div>
  @endif

</div>
