<x-modal name="add-member" maxWidth="sm">
  <div class="p-5">
    <form wire:submit="store">
      <div class="mb-3">
        <h2 class="text-xl font-semibold">Add Member</h2>
      </div>
      <div class="mb-3">
        <x-input-label value="Member" for="member_id" class="mb-1" />
        <x-select wire:model="member_id" id="member_id" class="mb-1 w-full" placeholder="Choose Member...">
          @foreach ($members as $member)
            <option value="{{ $member->id }}">{{ $member->name }}</option>
          @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('member_id')" class="mb-1" />
      </div>
      <div class="flex justify-end items-center gap-x-2">
        <x-primary-button><i class="fa-solid fa-floppy-disk me-2"></i>Save</x-primary-button>
        <x-secondary-button wire:click="$dispatch('close-modal', 'add-member')"><i
            class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
      </div>
    </form>
  </div>
</x-modal>
