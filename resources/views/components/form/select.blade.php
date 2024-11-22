@props(['label', 'required' => true, 'options' => [], 'selected' => null, 'name'])

<div class="col-span-full">
    <x-form.label for="{{ $name }}">{{ $label }}</x-form.label>
    <div class="mt-2">
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            class="block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200"
            @if($required) required @endif
        >
            @foreach ($options as $value => $text)
                <option value="{{ $value }}" @if($value == $selected) selected @endif>
                    {{ $text }}
                </option>
            @endforeach
        </select>
    </div>
</div>
