<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public User $user;
    public string $name = '';
    public string $email = '';
    public string $phone_number = '';
    public string $role_id = '';
    public string $department_id = '';
    public string $position_id = '';
    public $avatar;
    public $old_avatar;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->user = User::find(Auth::id());
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone_number = $this->user->phone_number;
        $this->role_id = $this->user->role_id;
        $this->department_id = $this->user->department_id;
        $this->position_id = $this->user->position_id;
        $this->avatar = $this->user->avatar;
        $this->old_avatar = $this->user->avatar;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore(Auth::id())],
            'phone_number' => ['required', 'string', Rule::unique(User::class)->ignore(Auth::id())],
            'role_id' => ['required'],
            'department_id' => ['required'],
            'position_id' => ['required'],
            'avatar' => ['max:2048'],
        ]);

        if (gettype($this->avatar) == 'object') {
            if ($this->avatar != 'avatar.png') {
                Storage::delete('users-avatar/' . $this->old_avatar);
            }

            $this->avatar->storeAs('users-avatar', $this->avatar->hashName());
            $validated['avatar'] = $this->avatar->hashName();
        } else {
            $validated['avatar'] = $this->avatar;
        }

        $this->user->fill($validated);

        if ($this->user->isDirty('email')) {
            $this->user->email_verified_at = null;
        }

        $this->user->save();

        $this->dispatch('profile-updated', name: $this->user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $path = session('url.intended', RouteServiceProvider::HOME);

            $this->redirect($path);

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    public function messages()
    {
        return [
            'role_id.required' => 'The role field is required.',
            'department_id.required' => 'The department field is required.',
            'position_id.required' => 'The position field is required.',
        ];
    }
}; ?>

<section>
  <header>
    <h2 class="text-lg font-medium text-gray-900">
      {{ __('Profile Information') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
      {{ __("Update your account's profile information.") }}
    </p>
  </header>

  <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
    <div>
      <x-input-label for="name" :value="__('Name')" />
      <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" autofocus
        autocomplete="name" />
      <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full"
        autocomplete="username" />
      <x-input-error class="mt-2" :messages="$errors->get('email')" />

      @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
        <div>
          <p class="text-sm mt-2 text-gray-800">
            {{ __('Your email address is unverified.') }}

            <button wire:click.prevent="sendVerification"
              class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              {{ __('Click here to re-send the verification email.') }}
            </button>
          </p>

          @if (session('status') === 'verification-link-sent')
            <p class="mt-2 font-medium text-sm text-green-600">
              {{ __('A new verification link has been sent to your email address.') }}
            </p>
          @endif
        </div>
      @endif
    </div>

    <div>
      <x-input-label for="phone_number" :value="__('Phone Number')" />
      <x-text-input wire:model="phone_number" id="phone_number" name="phone_number" class="mt-1 block w-full" />
      <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
    </div>

    <div>
      <x-input-label for="department_id" :value="__('Department')" />
      <x-select wire:model="department_id" id="department_id" name="department_id" class="mt-1 block w-full">
        @foreach (\App\Models\Department::orderBy('name')->get() as $department)
          <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
      </x-select>
      <x-input-error class="mt-2" :messages="$errors->get('department_id')" />
    </div>

    <div>
      <x-input-label for="position_id" :value="__('Position')" />
      <x-select wire:model="position_id" id="position_id" name="position_id" class="mt-1 block w-full">
        @foreach (\App\Models\Position::orderBy('name')->get() as $position)
          <option value="{{ $position->id }}">{{ $position->name }}</option>
        @endforeach
      </x-select>
      <x-input-error class="mt-2" :messages="$errors->get('position_id')" />
    </div>

    <div>
      <x-input-label for="role_id" :value="__('Role')" />
      <x-select wire:model="role_id" id="role_id" name="role_id" class="mt-1 block w-full" :disabled="auth()->user()->role_id == 1 ? false : true">
        @foreach (\App\Models\Role::orderBy('name')->get() as $role)
          <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
      </x-select>
      <x-input-error class="mt-2" :messages="$errors->get('role_id')" />
    </div>

    <div>
      <x-input-label for="avatar" :value="__('Avatar')" />
      @if (gettype($avatar) == 'string')
        <img src="{{ asset('storage/users-avatar/' . $avatar) }}" alt="User Avatar" class="mt-1 mb-2 w-1/2 rounded-md">
      @else
        <img src="{{ $avatar->temporaryUrl() }}" alt="User Avatar" class="mt-1 mb-2 w-1/2 rounded-md">
      @endif
      <x-text-input type="file" wire:model="avatar" id="avatar" name="avatar"
        class="mt-1 block w-full border p-1.5" />
      <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
    </div>

    <div class="flex items-center gap-4">
      <x-primary-button><i class="fa-solid fa-floppy-disk me-2"></i>{{ __('Save') }}</x-primary-button>

      <x-action-message class="me-3" on="profile-updated">
        {{ __('Saved.') }}
      </x-action-message>
    </div>
  </form>
</section>
