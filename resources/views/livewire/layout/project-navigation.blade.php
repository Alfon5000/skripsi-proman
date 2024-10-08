<?php

use Livewire\Volt\Component;

new class extends Component {
    public string $title = '';

    public function mount(string $title)
    {
        $this->title = $title;
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-gray-100">
  <!-- Primary Navigation Menu -->
  <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between">
      <div class="flex">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __($title) }}
        </h2>

        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
          <x-nav-link :href="route('project.overview', ['project' => \App\Models\Project::find(request('project'))])" :active="request()->routeIs('project.overview')" wire:navigate>
            {{ __('Overview') }}
          </x-nav-link>
          <x-nav-link :href="route('project.members', ['project' => \App\Models\Project::find(request('project'))])" :active="request()->routeIs('project.members')" wire:navigate>
            {{ __('Members') }}
          </x-nav-link>
          <x-nav-link :href="route('project.tasks', ['project' => \App\Models\Project::find(request('project'))])" :active="request()->routeIs('project.tasks')" wire:navigate>
            {{ __('Tasks') }}
          </x-nav-link>
          <x-nav-link :href="route('project.discussions', ['project' => \App\Models\Project::find(request('project'))])" :active="request()->routeIs('project.discussions')" wire:navigate>
            {{ __('Discussions') }}
          </x-nav-link>
          <x-nav-link :href="route('project.documents', ['project' => \App\Models\Project::find(request('project'))])" :active="request()->routeIs('project.documents')" wire:navigate>
            {{ __('Documents') }}
          </x-nav-link>
          <x-nav-link :href="route('project.expenditures', ['project' => \App\Models\Project::find(request('project'))])" :active="request()->routeIs('project.expenditures')" wire:navigate>
            {{ __('Expenditures') }}
          </x-nav-link>
        </div>
      </div>

      <!-- Hamburger -->
      <div class="-me-2 flex items-center sm:hidden">
        <button @click="open = ! open"
          class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('project.overview', ['project' => \App\Models\Project::find(request('project'))])" :active="request()->routeIs('project.overview')">
        {{ __('Overview') }}
      </x-responsive-nav-link>
      <x-responsive-nav-link :href="route('project.members', ['project' => \App\Models\Project::find(request('project'))])" :active="request()->routeIs('project.members')">
        {{ __('Members') }}
      </x-responsive-nav-link>
      <x-responsive-nav-link :href="route('project.tasks', ['project' => \App\Models\Project::find(request('project'))])" :active="request()->routeIs('project.tasks')">
        {{ __('Tasks') }}
      </x-responsive-nav-link>
      <x-responsive-nav-link :href="route('project.discussions', ['project' => \App\Models\Project::find(request('project'))])" :active="request()->routeIs('project.discussions')">
        {{ __('Discussions') }}
      </x-responsive-nav-link>
      <x-responsive-nav-link :href="route('project.documents', ['project' => \App\Models\Project::find(request('project'))])" :active="request()->routeIs('project.documents')">
        {{ __('Documents') }}
      </x-responsive-nav-link>
      <x-responsive-nav-link :href="route('project.expenditures', ['project' => \App\Models\Project::find(request('project'))])" :active="request()->routeIs('project.expenditures')">
        {{ __('Expenditures') }}
      </x-responsive-nav-link>
    </div>

  </div>
</nav>
