@props(['label', 'name', 'options' => [], 'checked' => null, 'required' => true, 'type', 'value'])

<div class="col-span-full">
    <x-form.input.label>{{ $label }}</x-form.input.label>
    <div class="mt-2">
        @foreach ($options as $value => $text)
            <div class="flex items-center gap-x-3">
                <input
                    type="radio"
                    name="{{ $name }}"
                    id="{{ $name . '_' . $value }}"
                    value="{{ $value }}"
                    @if($required) required @endif
                    @if($value == $checked) checked @endif
                    class="size-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                >
                <label for="{{ $name . '_' . $value }}" class="text-gray-700">
                    {{ $text }}
                </label>
            </div>
        @endforeach
    </div>
</div>

