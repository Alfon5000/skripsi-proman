<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">

      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-0">
        <div class="p-6 text-gray-900">
          <livewire:dashboard.greeting-user />
        </div>
      </div>

      <div class="flex flex-col sm:flex-row gap-x-6">

        <div class="basis-3/4">
          @can('admin')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-6">
              <div class="p-6 text-gray-900">
                <h2 class="font-semibold text-xl mb-3">
                  Overall Status
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-5">
                  <a href="{{ route('users') }}" wire:navigate>
                    <x-status-card bgColor="bg-red-500" icon="fa-users" iconType="fa-solid" :items="$users"
                      itemName="Users" url="{{ route('users') }}" />
                  </a>
                  <a href="{{ route('departments') }}" wire:navigate>
                    <x-status-card bgColor="bg-yellow-500" icon="fa-building" iconType="fa-solid" :items="$departments"
                      itemName="Departments" />
                  </a>
                  <a href="{{ route('positions') }}" wire:navigate>
                    <x-status-card bgColor="bg-green-500" icon="fa-ranking-star" iconType="fa-solid" :items="$positions"
                      itemName="Positions" />
                  </a>
                  <a href="{{ route('categories') }}" wire:navigate>
                    <x-status-card bgColor="bg-blue-500" icon="fa-layer-group" iconType="fa-solid" :items="$categories"
                      itemName="Categories" />
                  </a>
                </div>
              </div>
            </div>
          @endcan

          @can('user')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-6">
              <div class="p-6 text-gray-900">
                <h2 class="font-semibold text-xl mb-3">
                  Overall Status
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-5">
                  <a href="{{ route('projects') }}" wire:navigate>
                    <x-status-card bgColor="bg-red-500" icon="fa-clipboard-list" iconType="fa-solid" :items="$projects"
                      itemName="Projects" />
                  </a>
                  <a href="{{ route('dashboard') }}" wire:navigate>
                    <x-status-card bgColor="bg-yellow-500" icon="fa-list" iconType="fa-solid" :items="$undones"
                      itemName="Tasks" />
                  </a>
                  <a href="{{ route('members') }}" wire:navigate>
                    <x-status-card bgColor="bg-green-500" icon="fa-people-group" iconType="fa-solid" :items="$members"
                      itemName="Members" />
                  </a>
                  <a href="{{ route('events') }}">
                    <x-status-card bgColor="bg-blue-500" icon="fa-calendar-days" iconType="fa-solid" :items="$events"
                      itemName="Events" />
                  </a>
                </div>
              </div>
            </div>
          @endcan

          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-6">
            <div class="p-6 text-gray-900">
              <livewire:dashboard.projects-status />
            </div>
          </div>

        </div>

        <div class="basis-1/4">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-6">
            <div class="p-6 text-gray-900">
              <livewire:dashboard.events.index />
              <livewire:dashboard.events.show />
            </div>
          </div>

          @can('user')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-6">
              <div class="p-6 text-gray-900">
                <h2 class="font-semibold text-xl mb-3">
                  My Tasks
                </h2>
                <div id="tasks-chart"></div>
              </div>
            </div>
          @endcan

          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-6">
            <div class="p-6 text-gray-900">
              <livewire:dashboard.online-users />
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  @if (auth()->user()->role_id == 2)
    <script type="module">
      GoogleCharts.load(drawTasksChart);

      function drawTasksChart() {
        const data = GoogleCharts.api.visualization.arrayToDataTable(@json($tasksData));

        const options = {
          chartArea: {
            top: 0,
            right: 0,
            bottom: 25,
            left: 0,
          },
          legend: {
            position: 'bottom',
          },
          pieHole: 0.4,
          pieSliceText: 'value',
          pieSliceTextStyle: {
            fontSize: 20,
            color: 'white',
          },
          slices: {
            0: {
              color: '#ef4444'
            },
            1: {
              color: 'eab308'
            },
            2: {
              color: '22c55e'
            },
            3: {
              color: '3b82f6'
            },
          },
        };

        const tasksChart = new GoogleCharts.api.visualization.PieChart(document.getElementById('tasks-chart'));
        tasksChart.draw(data, options);
      }
    </script>
  @endif

</x-app-layout>
