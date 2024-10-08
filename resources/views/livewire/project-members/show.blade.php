<x-modal name="member-details" maxWidth="sm">
  @if ($member)
    @php
      $role = $member->id == $project->manager_id ? 'Manager' : 'Member';
    @endphp

    <div class="p-5">
      <div class="mb-3 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Member Details</h2>
        <button wire:click="$dispatch('close-modal', 'member-details')">
          <i class="fa-solid fa-xmark fa-lg"></i>
        </button>
      </div>
      <table class="w-full">
        <tr>
          <td class="border p-2" colspan="2">
            <img src="{{ asset('storage/users-avatar/' . $member->avatar) }}" alt="Member Avatar"
              class="rounded-md shadow-md">
          </td>
        </tr>
        <tr>
          <td class="border p-2">Name</td>
          <td class="border p-2">{{ $member->name }}</td>
        </tr>
        <tr>
          <td class="border p-2">Phone Number</td>
          <td class="border p-2">{{ $member->phone_number }}</td>
        </tr>
        <tr>
          <td class="border p-2">Email</td>
          <td class="border p-2">{{ $member->email }}</td>
        </tr>
        <tr>
          <td class="border p-2">Role</td>
          <td class="border p-2">{{ $role }}</td>
        </tr>
        <tr>
          <td class="border p-2">Department</td>
          <td class="border p-2">{{ $member->department->name }}</td>
        </tr>
        <tr>
          <td class="border p-2">Position</td>
          <td class="border p-2">{{ $member->position->name }}</td>
        </tr>
      </table>
    </div>
  @endif
</x-modal>
