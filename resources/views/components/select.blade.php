@props(['disabled' => false, 'placeholder' => 'Choose...', 'placeholderValue' => ''])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
]) !!}>
  <option value="{{ $placeholderValue }}">{{ $placeholder }}</option>
  {{ $slot }}
</select>
