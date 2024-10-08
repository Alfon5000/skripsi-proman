<x-modal name="create-user" maxWidth="sm">
  <div class="p-5">
    <form wire:submit="store">
      <div class="mb-3">
        <h2 class="text-xl font-semibold">Create User</h2>
      </div>
      <div class="mb-3">
        <x-input-label value="Name" for="name" class="mb-1" />
        <x-text-input wire:model="name" id="name" class="mb-1 w-full" placeholder="Name..." />
        <x-input-error :messages="$errors->get('name')" class="mb-1" />
      </div>
      <div class="mb-3">
        <x-input-label value="Phone Number" for="phone_number" class="mb-1" />
        <x-text-input wire:model="phone_number" id="phone_number" class="mb-1 w-full" placeholder="Phone Number..." />
        <x-input-error :messages="$errors->get('phone_number')" class="mb-1" />
      </div>
      <div class="mb-3">
        <x-input-label value="Role" for="role_id" class="mb-1" />
        <x-select wire:model="role_id" id="role_id" class="mb-1 w-full" placeholder="Choose Role...">
          @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
          @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('role_id')" class="mb-1" />
      </div>
      <div class="mb-3">
        <x-input-label value="Department" for="department_id" class="mb-1" />
        <x-select wire:model="department_id" id="department_id" class="mb-1 w-full" placeholder="Choose Department...">
          @foreach ($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
          @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('department_id')" class="mb-1" />
      </div>
      <div class="mb-3">
        <x-input-label value="Position" for="position_id" class="mb-1" />
        <x-select wire:model="position_id" id="position_id" class="mb-1 w-full" placeholder="Choose Position...">
          @foreach ($positions as $position)
            <option value="{{ $position->id }}">{{ $position->name }}</option>
          @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('position_id')" class="mb-1" />
      </div>
      <div class="mb-3">
        <x-input-label value="Avatar" for="avatar" class="mb-1" />
        @if ($avatar)
          <img src="{{ $avatar->temporaryUrl() }}" alt="User Avatar" class="mb-1 w-full">
        @endif
        <x-text-input type="file" wire:model="avatar" id="avatar" class="mb-1 w-full border p-1.5" />
        <x-input-error :messages="$errors->get('avatar')" class="mb-1" />
      </div>
      <div class="mb-3">
        <x-input-label value="Email" for="email" class="mb-1" />
        <x-text-input type="email" wire:model="email" id="email" class="mb-1 w-full" placeholder="Email..." />
        <x-input-error :messages="$errors->get('email')" class="mb-1" />
      </div>
      <div class="mb-3">
        <x-input-label value="Password" for="password" class="mb-1" />
        <x-text-input type="password" wire:model="password" id="password" class="mb-1 w-full"
          placeholder="Password..." />
        <x-input-error :messages="$errors->get('password')" class="mb-1" />
      </div>
      <div class="mb-3">
        <x-input-label value="Password Confirmation" for="password_confirmation" class="mb-1" />
        <x-text-input type="password" wire:model="password_confirmation" id="password_confirmation" class="mb-1 w-full"
          placeholder="Password Confirmation..." />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mb-1" />
      </div>
      <div class="flex justify-end items-center gap-x-2">
        <x-primary-button><i class="fa-solid fa-floppy-disk me-2"></i>Save</x-primary-button>
        <x-secondary-button wire:click="$dispatch('close-modal', 'create-user')"><i
            class="fa-solid fa-xmark me-2"></i>Cancel</x-secondary-button>
      </div>
    </form>
  </div>
</x-modal>
