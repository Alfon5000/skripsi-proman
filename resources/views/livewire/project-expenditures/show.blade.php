<x-modal name="expenditure-details" maxWidth="sm">
  @if ($expenditure)
    <div class="p-5">
      <div class="mb-3 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Expenditure Details</h2>
        <button wire:click="$dispatch('close-modal', 'expenditure-details')">
          <i class="fa-solid fa-xmark fa-lg"></i>
        </button>
      </div>
      <table class="w-full">
        <tr>
          <td class="border p-2">Title</td>
          <td class="border p-2">{{ $expenditure->title }}</td>
        </tr>
        <tr>
          <td class="border p-2">Uploaded By</td>
          <td class="border p-2">{{ $expenditure->uploader->name }}</td>
        </tr>
        <tr>
          <td class="border p-2">Date</td>
          <td class="border p-2">{{ $expenditure->date->toDayDateTimeString() }}</td>
        </tr>
        <tr>
          <td class="border p-2">Amount</td>
          <td class="border p-2">Rp. {{ number_format($expenditure->amount, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <td class="border p-2">Description</td>
          <td class="border p-2">{{ $expenditure->description }}</td>
        </tr>
        <tr>
          <td class="border p-2">Evidence</td>
          <td class="border p-2">
            <x-primary-button wire:click="download('{{ $expenditure->evidence }}')"><i
                class="fa-solid fa-download me-2"></i>Download</x-primary-button>
          </td>
        </tr>
      </table>
    </div>
  @endif
</x-modal>
