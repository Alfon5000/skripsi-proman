<?php

namespace App\Livewire\Members;

use App\Models\User;
use Livewire\Component;
use App\Models\Department;
use App\Models\Position;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url]
    public string $department_id = '';

    #[Url]
    public string $position_id = '';

    #[Url]
    public int $per_page = 0;

    public function render()
    {
        $departments = Department::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();
        $members = User::roleId(2)->filter([
            'search' => $this->search,
            'department_id' => $this->department_id,
            'position_id' => $this->position_id,
        ])->orderBy('name')->paginate($this->per_page);

        return view('livewire.members.index', compact(['departments', 'positions', 'members']));
    }
}
