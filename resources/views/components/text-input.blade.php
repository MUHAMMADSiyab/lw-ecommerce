@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-md bg-gray-100 p-3 shadow-sm',
]) !!}>
