<x-modal name="user-details" maxWidth="sm">
  @if ($user)
    <div class="p-5">
      <div class="mb-3 flex justify-between items-center">
        <h2 class="text-xl font-semibold">User Details</h2>
        <button wire:click="$dispatch('close-modal', 'user-details')">
          <i class="fa-solid fa-xmark fa-lg"></i>
        </button>
      </div>
      <table class="w-full mb-3">
        <tr>
          <td class="border p-2" colspan="2">
            <img src="{{ asset('storage/users-avatar/' . $user->avatar) }}" alt="User Avatar"
              class="rounded-md shadow-md">
          </td>
        </tr>
        <tr>
          <td class="border p-2">Name</td>
          <td class="border p-2">{{ $user->name }}</td>
        </tr>
        <tr>
          <td class="border p-2">Phone Number</td>
          <td class="border p-2">{{ $user->phone_number }}</td>
        </tr>
        <tr>
          <td class="border p-2">Email</td>
          <td class="border p-2">{{ $user->email }}</td>
        </tr>
        <tr>
          <td class="border p-2">Role</td>
          <td class="border p-2">{{ $user->role->name }}</td>
        </tr>
        <tr>
          <td class="border p-2">Department</td>
          <td class="border p-2">{{ $user->department->name }}</td>
        </tr>
        <tr>
          <td class="border p-2">Position</td>
          <td class="border p-2">{{ $user->position->name }}</td>
        </tr>
      </table>
    </div>
  @endif
</x-modal>
