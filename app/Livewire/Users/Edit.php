<?php

namespace App\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Position;
use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public User $user;
    public string $name = '';
    public string $phone_number = '';
    public string $role_id = '';
    public string $department_id = '';
    public string $position_id = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public $avatar;
    public $old_avatar;

    public function rules()
    {
        return [
            'role_id' => ['required'],
            'department_id' => ['required'],
            'position_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', Rule::unique('users')->ignore($this->user), 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user), 'max:255'],
            'password' => ['sometimes', 'string', 'confirmed', 'max:255'],
            'password_confirmation' => ['sometimes', 'string', 'max:255'],
            'avatar' => ['max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => 'The role field is required.',
            'department_id.required' => 'The department field is required.',
            'position_id.required' => 'The position field is required.',
        ];
    }

    public function render()
    {
        $roles = Role::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();

        return view('livewire.users.edit', compact(['roles', 'departments', 'positions']));
    }

    #[On('open-edit')]
    public function setUser(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone_number = $user->phone_number;
        $this->role_id = $user->role_id;
        $this->department_id = $user->department_id;
        $this->position_id = $user->position_id;
        $this->avatar = $user->avatar;
        $this->old_avatar = $user->avatar;
        $this->dispatch('open-modal', 'edit-user');
    }

    public function update()
    {
        $validated = $this->validate();

        if (gettype($this->avatar) == 'object') {
            $this->avatar->storeAs('users-avatar', $this->avatar->hashName());
            $validated['avatar'] = $this->avatar->hashName();

            if ($this->avatar != 'avatar.png') {
                Storage::delete('users-avatar/' . $this->old_avatar);
            }
        }

        $this->user->update($validated);
        $this->dispatch('close-modal', 'edit-user');
        $this->reset();
        Session::flash('status', 'The user has been updated');
        $this->redirect('users', true);
    }
}
