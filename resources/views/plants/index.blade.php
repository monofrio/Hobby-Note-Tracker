<x-app-layout>
    <section class="m-4">
        <h1 class="text-4xl text-black">Plant List</h1>

    @if(session('success'))
            <p>{{ session('success') }}</p>
    @endif
    @if( $plantCount != 0)
        <h2 class="text-xl my-4">Plants:</h2>
    @endif
        <ul>
            @foreach($plants as $plant)
                <li class="mb-4">
                    <a href="{{ route('plants.show', $plant) }}" class="text-blue-500 underline">
                        <strong>{{ $plant->name }} #{{ $plant->batch_plant_number}}</strong> -
                        <span class="text-green-700" >{{ $plant->start_type }}</span> -
                        <span class="text-green-700">{{ $plant->location_type }}</span>

                    </a>
                </li>
            @endforeach
        </ul>

<hr />

        @if ($plantCount === 0)
            <div class="alert alert-info">
                <p class="text-xl my-4">No plants available.</p>
            </div>
            <a href="{{ route('plants.create') }}" class="btn btn-primary">Add Plant</a>
        @else
            <p class="my-3">You have {{ $plantCount }} plants in the database.</p>
            <p><a href="{{ route('plants.export') }}" class="btn btn-primary">Export Plants to CSV</a></p>
            @if(session('message'))
                <div class="alert alert-info">{{ session('message') }}</div>
            @endif
        @endif
    </section>
</x-app-layout>
