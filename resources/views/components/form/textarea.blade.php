@props(['label', 'value' => '', 'required' => true])

<div class="col-span-full">
    <x-input-label for="{{ $label }}">{{ $label }}</x-input-label>
    <div class="mt-2">
        <textarea
            name="{{ $label }}"
            id="{{ $label }}"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
            @if($required) required @endif
        >{{ $value }}</textarea>
    </div>
</div>
