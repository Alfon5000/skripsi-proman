<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('My Events') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

          <livewire:events.index />
          <livewire:events.create />
          <livewire:events.show />
          <livewire:events.edit />
          <livewire:events.delete />
          <livewire:events.menu />

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
