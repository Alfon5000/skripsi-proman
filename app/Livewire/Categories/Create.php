<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use App\Models\User;
use App\Notifications\CategoryCreatedNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Create extends Component
{
    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';

    public function render()
    {
        return view('livewire.categories.create');
    }

    public function store()
    {
        $validated = $this->validate();
        $category = Category::create($validated);
        Notification::send(User::roleId(1)->get(), new CategoryCreatedNotification($category));
        $this->dispatch('close-modal', 'create-category');
        $this->reset();
        Session::flash('status', 'New category has been created');
        $this->redirect('categories', true);
    }
}
