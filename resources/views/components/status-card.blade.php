@props(['bgColor', 'icon', 'iconType', 'items', 'itemName'])

@php
  $textSize = '';

  if (strlen($items) >= 8) {
      $textSize = 'text-2xl';
  } elseif (strlen($items) >= 4 && strlen($items) < 8) {
      $textSize = 'text-3xl';
  } else {
      $textSize = 'text-4xl';
  }
@endphp

<div class="{{ $bgColor }} rounded-lg shadow-lg py-10 flex">
  <div class="basis-1/2 flex justify-center items-center">
    <i class="{{ $iconType }} {{ $icon }} text-7xl text-white opacity-50"></i>
  </div>
  <div class="basis-1/2 flex flex-col justify-center items-center text-white">
    <h1 class="{{ $textSize }} text-">{{ $items }}</h1>
    <h3 class="text-lg">{{ $itemName }}</h3>
  </div>
</div>
