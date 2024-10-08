<x-app-layout>
  <x-slot name="header">
    <livewire:layout.project-navigation title="Project Members" />
  </x-slot>

  <div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

          <livewire:project-members.index projectId="{{ request('project') }}" />
          <livewire:project-members.create projectId="{{ request('project') }}" />
          <livewire:project-members.show />
          <livewire:project-members.change />
          <livewire:project-members.delete />

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
