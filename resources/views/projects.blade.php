<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ auth()->user()->role_id == 1 ? __('Projects') : __('My Projects') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

          <livewire:projects.index />
          <livewire:projects.create />
          <livewire:projects.show />
          <livewire:projects.edit />
          <livewire:projects.delete />

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
