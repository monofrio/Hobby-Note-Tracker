 @props(['label', 'required' => true, 'type', 'value'])

<div class="col-span-full">
    <x-input-label for="{{$label}}">{{$label}}</x-input-label>
    <div class="mt-2">
        <x-text-input name="{{$label}}" id="{{$label}}" type="{{$type}}" required="{{$required}}" value="{{$value}}"></x-text-input>
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>
</div>
