@props(['color' => 'blue'])

@php
    $baseClass = "inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150";

    if($color === "green"){
            $colorClass = "bg-green-800 hover:bg-green-700 focus:bg-green-700 active:bg-green-900";
    } else if( $color === "yellow") {
            $colorClass = "bg-yellow-800 hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900";
    } else {
         $colorClass = "bg-{$color}-800 hover:bg-{$color}-700 focus:bg-{$color}-700 active:bg-{$color}-900";
    }


@endphp

<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => "{$baseClass} {$colorClass}"
]) }}>
    {{ $slot }}
</button>
