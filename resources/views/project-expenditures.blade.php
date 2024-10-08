<x-app-layout>
  <x-slot name="header">
    <livewire:layout.project-navigation title="Project Expenditures" />
  </x-slot>

  <div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

          <livewire:project-expenditures.index projectId="{{ request('project') }}" />
          <livewire:project-expenditures.create projectId="{{ request('project') }}" />
          <livewire:project-expenditures.show />
          <livewire:project-expenditures.edit />
          <livewire:project-expenditures.delete />

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
