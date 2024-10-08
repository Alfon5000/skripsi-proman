<?php

namespace App\Livewire\Departments;

use Livewire\Component;
use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;

class Edit extends Component
{
    public Department $department;

    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';

    public function render()
    {
        return view('livewire.departments.edit');
    }

    #[On('open-edit')]
    public function setDepartment(Department $department)
    {
        $this->department = $department;
        $this->name = $department->name;
        $this->dispatch('open-modal', 'edit-department');
    }

    public function update()
    {
        $validated = $this->validate();
        $this->department->update($validated);
        $this->dispatch('close-modal', 'edit-department');
        $this->reset();
        Session::flash('status', 'The department has been updated');
        $this->redirect('departments', true);
    }
}
