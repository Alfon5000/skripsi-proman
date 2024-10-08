<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      <a href="{{ route('project.discussions', ['project' => request('project')]) }}" wire:navigate><i
          class="fa-solid fa-arrow-left-long me-3"></i></a>
      {{ __('Discussion Comments') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

          <livewire:project-discussion-comments.index projectId="{{ request('project') }}"
            discussionId="{{ request('discussion') }}" />
          <livewire:project-discussion-comments.create projectId="{{ request('project') }}"
            discussionId="{{ request('discussion') }}" />
          <livewire:project-discussion-comments.edit />
          <livewire:project-discussion-comments.delete />

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
