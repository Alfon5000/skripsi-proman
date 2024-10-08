<?php

namespace App\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Position;
use App\Models\Department;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserCreatedNotification;
use App\Notifications\MemberCreatedNotification;

class Create extends Component
{
    use WithFileUploads;

    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';

    #[Validate(['required', 'string', 'unique:users', 'max:255'])]
    public string $phone_number = '';

    #[Validate('required', message: 'The role field is required.')]
    public string $role_id = '';

    #[Validate('required', message: 'The department field is required.')]
    public string $department_id = '';

    #[Validate('required', message: 'The position field is required.')]
    public string $position_id = '';

    #[Validate(['image', 'max:2048'])]
    public $avatar;

    #[Validate(['required', 'email', 'unique:users', 'max:255'])]
    public string $email = '';

    #[Validate(['required', 'string', 'confirmed', 'max:255'])]
    public string $password = '';

    #[Validate(['required', 'string', 'max:255'])]
    public string $password_confirmation = '';

    public function render()
    {
        $roles = Role::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();

        return view('livewire.users.create', compact(['roles', 'departments', 'positions']));
    }

    public function store()
    {
        $validated = $this->validate();

        if ($this->avatar) {
            $this->avatar->storeAs('users-avatar', $this->avatar->hashName());
            $validated['avatar'] = $this->avatar->hashName();
        } else {
            $validated['avatar'] = 'avatar.png';
        }

        $user = User::create($validated);
        Notification::send(User::roleId(1)->get(), new UserCreatedNotification($user));
        Notification::send(User::roleId(2)->get(), new MemberCreatedNotification($user));
        $this->dispatch('close-modal', 'create-user');
        $this->reset();
        Session::flash('status', 'New user has been created');
        $this->redirect('users', true);
    }
}
