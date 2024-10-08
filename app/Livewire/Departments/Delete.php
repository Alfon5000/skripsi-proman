<?php

namespace App\Livewire\Departments;

use Livewire\Component;
use App\Models\Department;
use App\Models\User;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;

class Delete extends Component
{
    public Department $department;

    public function render()
    {
        return view('livewire.departments.delete');
    }

    #[On('open-delete')]
    public function setDepartment(Department $department)
    {
        $this->department = $department;
        $this->dispatch('open-modal', 'delete-department');
    }

    public function destroy()
    {
        User::departmentId($this->department->id)->delete();
        $this->department->delete();
        $this->dispatch('close-modal', 'delete-department');
        Session::flash('status', 'The department has been deleted');
        $this->redirect('departments', true);
    }
}
