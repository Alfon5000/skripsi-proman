<div wire:poll.visible>

  <div class="mb-5 flex justify-start sm:justify-end items-center gap-x-2 overflow-auto">
    <x-select wire:model.live="per_page" placeholder="All" placeholderValue="0">
      <option value="5">5</option>
      <option value="10">10</option>
      <option value="20">20</option>
      <option value="50">50</option>
      <option value="100">100</option>
    </x-select>
    <x-text-input wire:model.live="search" placeholder="Search..." />
  </div>

  <div class="p-3 border rounded-md shadow-md m-1 w-full flex justify-between items-start">
    <div class="flex gap-x-3">
      <img src="{{ asset('storage/users-avatar/' . $discussion->creater->avatar) }}" alt="Creater Avatar"
        class="size-16 rounded-full shadow-md">
      <div>
        <h2 class="text-md font-semibold">{{ $discussion->title }}</h2>
        <p class="text-sm font-medium">
          {{ 'By. ' . $discussion->creater->name . ' - ' . $discussion->updated_at->diffForHumans() }}</p>
        <p class="text-md font-normal">{!! $discussion->description !!}</p>
        <x-primary-button wire:click="$dispatch('open-modal', 'create-comment')" class="my-1"><i
            class="fa-solid fa-reply me-2"></i>Reply</x-primary-button>
      </div>
    </div>
  </div>

  <div class="flex flex-col items-end mb-5">
    @foreach ($comments as $comment)
      <div class="flex justify-between items-start p-3 border rounded-md shadow-md m-1 w-[95%]">
        <div class="flex gap-x-3">
          <img src="{{ asset('storage/users-avatar/' . $comment->commenter->avatar) }}" alt="Creater Avatar"
            class="size-16 rounded-full shadow-md">
          <div>
            <h2 class="text-md font-semibold">Reply: {{ $discussion->title }}</h2>
            <p class="text-sm font-medium">
              {{ 'By. ' . $comment->commenter->name . ' - ' . $comment->updated_at->diffForHumans() }}</p>
            <p class="text-md font-normal">{!! $comment->body !!}</p>
          </div>
        </div>
        @can('commenter', $comment)
          <button>
            <x-dropdown>
              <x-slot name="trigger">
                <i class="fa-solid fa-ellipsis"></i>
              </x-slot>
              <x-slot name="content">
                <x-dropdown-link wire:click="$dispatch('open-edit', { comment: {{ $comment }} })">
                  <i class="fa-solid fa-pen-to-square me-2"></i>Edit</x-dropdown-link>
                <x-dropdown-link wire:click="$dispatch('open-delete', { comment: {{ $comment }} })"
                  class="text-red-500"><i class="fa-solid fa-trash-can me-2"></i>Delete
                </x-dropdown-link>
              </x-slot>
            </x-dropdown>
          </button>
        @endcan
      </div>
    @endforeach
  </div>

  <div>
    {{ $comments->links() }}
  </div>

</div>
