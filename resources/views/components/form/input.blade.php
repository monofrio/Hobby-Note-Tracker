 @props(['label', 'required' => true, 'type', 'value'])

<div class="col-span-full">
    <x-form.label for="{{$label}}">{{$label}}</x-form.label>
    <div class="mt-2">
        <x-input-text name="{{$label}}" id="{{$label}}" type="{{$type}}" required="{{$required}}" value="{{$value}}"></x-input-text>
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>
</div>
