<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;

class Edit extends Component
{
    public Category $category;

    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';

    public function render()
    {
        return view('livewire.categories.edit');
    }

    #[On('open-edit')]
    public function setCategory(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->dispatch('open-modal', 'edit-category');
    }

    public function update()
    {
        $validated = $this->validate();
        $this->category->update($validated);
        $this->dispatch('close-modal', 'edit-category');
        $this->reset();
        Session::flash('status', 'The category has been updated');
        $this->redirect('categories', true);
    }
}
