<div class="overflow-auto">

  <div class="mb-3 flex justify-between items-center gap-x-2">
    <h2 class="font-semibold text-xl mb-3">
      <a href="{{ route('projects') }}" wire:navigate>Projects Status</a>
    </h2>
    <div class="flex justify-end items-center gap-x-2">
      <x-select wire:model.live="per_page" placeholder="All" placeholderValue="0">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
      </x-select>
      <x-select wire:model.live="category_id" placeholder="All Categories">
        @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </x-select>
      <x-text-input wire:model.live="search" placeholder="Search..." />
    </div>
  </div>
  @if ($projects->count())
    <div class="mb-3">
      <table class="w-full">
        <thead>
          <tr>
            <th class="border p-2">No.</th>
            <th class="border p-2">Name</th>
            <th class="border p-2">Category</th>
            <th class="border p-2">Manager</th>
            <th class="border p-2">Progress</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $project)
            @php
              $weightDoneTasks = DB::table('tasks AS t')
                  ->join('priorities AS p', 't.priority_id', '=', 'p.id')
                  ->select('p.weight')
                  ->where('project_id', $project->id)
                  ->where('t.status_id', 4)
                  ->sum('p.weight');
              $weightAllTasks = DB::table('tasks AS t')
                  ->join('priorities AS p', 't.priority_id', '=', 'p.id')
                  ->select('p.weight')
                  ->where('project_id', $project->id)
                  ->sum('p.weight');

              if ($weightAllTasks > 0) {
                  $progress = round(($weightDoneTasks / $weightAllTasks) * 100, 0) . '%';
              } else {
                  $progress = '0%';
              }

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
            <tr wire:key="{{ $project->id }}">
              <td class="border p-2 text-center">{{ $loop->iteration }}</td>
              <td class="border p-2">{{ $project->name }}</td>
              <td class="border p-2">{{ $project->category->name }}</td>
              <td class="border p-2">{{ $project->manager->name }}</td>
              <td class="border p-2 text-center">
                <div class="h-5 rounded-full bg-gray-200 w-full my-1">
                  <div class="h-5 rounded-full {{ $color }} flex justify-center items-center"
                    style="width: {{ $progress }}">
                    <div class="text-xs text-white font-bold">{{ (int) $progress > 0 ? $progress : null }}</div>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div>
      {{ $projects->links() }}
    </div>
  @else
    <div class="mt-6 p-3 border-2 rounded-lg border-red-500 text-center text-md text-red-500 font-semibold">Project not
      found</div>
  @endif

</div>
