<?php

namespace App\Livewire\Users;

use App\Models\Department;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';
    #[Url]
    public string $role_id = '';
    #[Url]
    public string $department_id = '';
    #[Url]
    public string $position_id = '';
    #[Url]
    public int $per_page = 0;

    #[On('refresh-users')]
    public function render()
    {
        $roles = Role::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();
        $users = User::filter([
            'search' => $this->search,
            'role_id' => $this->role_id,
            'department_id' => $this->department_id,
            'position_id' => $this->position_id
        ])->latest()->paginate($this->per_page);

        return view('livewire.users.index', compact(['roles', 'departments', 'positions', 'users']));
    }
}
