@php

  $color = '';

  if ((int) $progress > 0 && (int) $progress <= 25) {
      $color = 'bg-red-500';
  } elseif ((int) $progress > 25 && (int) $progress <= 50) {
      $color = 'bg-orange-500';
  } elseif ((int) $progress > 50 && (int) $progress <= 75) {
      $color = 'bg-yellow-500';
  } elseif ((int) $progress > 75 && (int) $progress <= 99) {
      $color = 'bg-green-500';
  } else {
      $color = 'bg-blue-500';
  }

@endphp

<div>

  <div class="mb-5 border-2 rounded-lg p-5">
    <div class="flex justify-between items-center mb-1">
      <h2 class="text-lg font-semibold">Project Progress</h2>
      <h2 class="text-lg font-semibold">{{ $progress }}</h2>
    </div>
    <div class="h-1.5 rounded-full bg-gray-200 w-full my-1">
      <div class="h-1.5 rounded-full {{ $color }}" style="width: {{ $progress }}"></div>
    </div>
  </div>

  <div class="sm:flex sm:justify-between sm:gap-x-5">

    <div class="mb-5 border-2 rounded-lg p-5 sm:basis-3/4">
      <h2 class="text-lg font-semibold mb-3">Project Status</h2>
      <div class="grid grid-cols-1 sm:grid-cols-4 gap-5">
        <a href="{{ route('project.members', $project) }}" wire:navigate>
          <x-status-card bgColor="bg-red-500" icon="fa-people-group" iconType="fa-solid" :items="$members"
            itemName="Members" url="/projects/{{ $project->id }}/members" />
        </a>
        <a href="{{ route('project.discussions', $project) }}" wire:navigate>
          <x-status-card bgColor="bg-orange-500" icon="fa-comments" iconType="fa-solid" :items="$discussions"
            itemName="Discussions" url="/projects/{{ $project->id }}/discussions" />
        </a>
        <a href="{{ route('project.documents', $project) }}" wire:navigate>
          <x-status-card bgColor="bg-yellow-500" icon="fa-file" iconType="fa-solid" :items="$documents"
            itemName="Documents" url="/projects/{{ $project->id }}/documents" />
        </a>
        <a href="{{ route('project.expenditures', $project) }}" wire:navigate>
          <x-status-card bgColor="bg-green-500" icon="fa-coins" iconType="fa-solid" :items="$expenditures"
            itemName="Expenditures" url="/projects/{{ $project->id }}/expenditures" />
        </a>
      </div>
    </div>

    <div class="mb-5 border-2 rounded-lg p-5 sm:basis-1/4">
      <h2 class="text-lg font-semibold mb-3">Project Tasks</h2>
      <div id="tasks-chart" class="w-full h-96"></div>
    </div>

  </div>

  <div class="border-2 rounded-lg p-5">
    <h2 class="text-lg font-semibold mb-3">Project Expenditures</h2>
    <div id="expenditures-chart" class="w-full h-96"></div>
  </div>

</div>

<script type="module">
  GoogleCharts.load(drawTasksChart);
  GoogleCharts.load(drawExpendituresChart);

  function drawTasksChart() {

    const data = GoogleCharts.api.visualization.arrayToDataTable(@json($tasksData));

    const options = {
      chartArea: {
        top: 10,
        right: 10,
        bottom: 25,
        left: 10,
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

  function drawExpendituresChart() {

    const data = GoogleCharts.api.visualization.arrayToDataTable(@json($expendituresData));

    const options = {
      chartArea: {
        top: 50,
        right: 50,
        bottom: 100,
        left: 100,
      },
      legend: {
        position: 'bottom',
      },
    };

    const expendituresChart = new GoogleCharts.api.visualization.LineChart(document.getElementById(
      'expenditures-chart'));
    expendituresChart.draw(data, options);
  }
</script>
