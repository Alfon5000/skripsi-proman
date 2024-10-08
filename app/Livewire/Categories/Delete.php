<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;
use App\Models\Project;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;

class Delete extends Component
{
    public Category $category;

    public function render()
    {
        return view('livewire.categories.delete');
    }

    #[On('open-delete')]
    public function setCategory(Category $category)
    {
        $this->category = $category;
        $this->dispatch('open-modal', 'delete-category');
    }

    public function destroy()
    {
        Project::categoryId($this->category->id)->delete();
        $this->category->delete();
        $this->dispatch('close-modal', 'delete-category');
        Session::flash('status', 'The category has been deleted');
        $this->redirect('categories', true);
    }
}
