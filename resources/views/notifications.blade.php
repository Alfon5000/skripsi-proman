<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Notifications') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg pb-6">
        <div class="p-6 text-gray-900">

          <livewire:notifications.index />
          <livewire:notifications.read-all />
          <livewire:notifications.delete-all />
          <livewire:notifications.read-one />
          <livewire:notifications.delete-one />

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
