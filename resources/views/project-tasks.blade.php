<x-app-layout>
  <x-slot name="header">
    <livewire:layout.project-navigation title="Project Tasks" />
  </x-slot>

  <div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

          <livewire:project-tasks.index projectId="{{ request('project') }}" />
          <livewire:project-tasks.create projectId="{{ request('project') }}" />
          <livewire:project-tasks.show />
          <livewire:project-tasks.edit />
          <livewire:project-tasks.delete />
          <livewire:project-tasks.update projectId="{{ request('project') }}" />

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
