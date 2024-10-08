<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;
    #[Layout('layouts.guest')]
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $phone_number = '';
    public string $department_id = '';
    public string $position_id = '';
    public $avatar;

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults(), 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'department_id' => ['required'],
            'position_id' => ['required'],
            'avatar' => ['image', 'max:2048'],
        ]);

        if ($this->avatar) {
            $this->avatar->storeAs('users-avatar', $this->avatar->hashName());
            $validated['avatar'] = $this->avatar->hashName();
        } else {
            $validated['avatar'] = 'avatar.png';
        }

        $validated['role_id'] = 2;
        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        Session::flash('status', 'Registration successful');

        $this->redirect(RouteServiceProvider::HOME);
    }

    public function messages()
    {
        return [
            'department_id.required' => 'The department field is required.',
            'position_id.required' => 'The position field is required.',
        ];
    }
}; ?>

<div>
  <form wire:submit="register">
    <!-- Name -->
    <div>
      <x-input-label for="name" :value="__('Name')" />
      <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" autofocus
        autocomplete="name" />
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Phone Number -->
    <div class="mt-4">
      <x-input-label for="phone_number" :value="__('Phone Number')" />
      <x-text-input wire:model="phone_number" id="phone_number" class="block mt-1 w-full" type="text"
        name="phone_number" autofocus autocomplete="phone_number" />
      <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
    </div>

    <!-- Department -->
    <div class="mt-4">
      <x-input-label for="department_id" :value="__('Department')" />
      <x-select wire:model="department_id" placeholder="Choose Department..." class="block mt-1 w-full">
        @foreach (\App\Models\Department::orderBy('name')->get() as $department)
          <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
      </x-select>
      <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
    </div>

    <!-- Position -->
    <div class="mt-4">
      <x-input-label for="position_id" :value="__('Position')" />
      <x-select wire:model="position_id" placeholder="Choose Position..." class="block mt-1 w-full">
        @foreach (\App\Models\Position::orderBy('name')->get() as $position)
          <option value="{{ $position->id }}">{{ $position->name }}</option>
        @endforeach
      </x-select>
      <x-input-error :messages="$errors->get('position_id')" class="mt-2" />
    </div>

    <!-- Avatar -->
    <div class="mt-4">
      <x-input-label value="Avatar" for="avatar" />
      @if ($avatar)
        <img src="{{ $avatar->temporaryUrl() }}" alt="User Avatar" class="mt-1 w-full">
      @endif
      <x-text-input type="file" wire:model="avatar" id="avatar" class="mt-1 w-full border p-1.5" />
      <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
        autocomplete="username" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" />

      <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password"
        autocomplete="new-password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
      <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

      <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
        type="password" name="password_confirmation" autocomplete="new-password" />

      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
      <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        href="{{ route('login') }}" wire:navigate>
        {{ __('Already registered?') }}
      </a>

      <x-primary-button class="ms-4">
        {{ __('Register') }}
      </x-primary-button>
    </div>
  </form>
</div>
