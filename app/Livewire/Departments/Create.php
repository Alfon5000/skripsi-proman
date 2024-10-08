<?php

namespace App\Livewire\Departments;

use App\Models\User;
use Livewire\Component;
use App\Models\Department;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DepartmentCreatedNotification;

class Create extends Component
{
    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';

    public function render()
    {
        return view('livewire.departments.create');
    }

    public function store()
    {
        $validated = $this->validate();
        $department = Department::create($validated);
        Notification::send(User::roleId(1)->get(), new DepartmentCreatedNotification($department));
        $this->dispatch('close-modal', 'create-department');
        $this->reset();
        Session::flash('status', 'New department has been created');
        $this->redirect('departments', true);
    }
}
