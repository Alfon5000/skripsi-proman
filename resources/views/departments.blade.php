<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Departments') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

          <livewire:departments.index />
          <livewire:departments.create />
          <livewire:departments.edit />
          <livewire:departments.delete />

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
