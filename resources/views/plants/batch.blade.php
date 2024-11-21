<x-app-layout>
    <section>
    <h1 class="text-4xl">Plants in Batch {{ $batchNumber }}</h1>

    {{-- Display Batch Description --}}
    <div class="mb-4">
        <strong>Description:</strong> {{ $batchDescription }}
    </div>

    <table class="table-auto border-collapse border border-gray-400">
        <thead>
        <tr>
            <th class="border border-gray-300 px-4 py-2">Plant Name</th>
{{--            <th class="border border-gray-300 px-4 py-2">Description</th>--}}
            <th class="border border-gray-300 px-4 py-2">Location Type</th>
            <th class="border border-gray-300 px-4 py-2">Start Type</th>
{{--            <th class="border border-gray-300 px-4 py-2">Plant Number</th>--}}
            <th class="border border-gray-300 px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($plants as $plant)
            <tr>
                <td class="border border-gray-300 px-4 py-2">
                    {{ $plant->name }}
                </td>
{{--                <td class="border border-gray-300 px-4 py-2">{{ $plant->description }}</td>--}}
                <td class="border border-gray-300 px-4 py-2">{{ ucfirst($plant->location_type) }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ ucfirst($plant->start_type) }}</td>
{{--                <td class="border border-gray-300 px-4 py-2">{{ $plant->batch_plant_number }}</td>--}}
                <td class="border border-gray-300 px-4 py-2">
                    <a href="{{ route('plants.show', $plant) }}"
                       class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        View
                    </a>
                    &nbsp;
                    <a href="{{ route('plants.edit', $plant) }}"
                       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Edit
                    </a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mt-5"><a href="{{ route('dashboard') }}" class=" btn-primary">Back to Dashboard</a></div>

</x-app-layout>