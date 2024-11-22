<x-app-layout>
    <h1>Archived Plants</h1>

    <table class="table-auto border-collapse border border-gray-400 w-full">
        <thead>
        <tr>
            <th class="border border-gray-300 px-4 py-2">Plant Name</th>
            <th class="border border-gray-300 px-4 py-2">Description</th>
            <th class="border border-gray-300 px-4 py-2">Batch Number</th>
            <th class="border border-gray-300 px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($archivedPlants as $plant)
        <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $plant->name }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $plant->description }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $plant->batch_number }}</td>
            <td class="border border-gray-300 px-4 py-2">
                <form action="{{ route('plants.restore', $plant) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <x-form.button color="green" >  Restore  </x-form.button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
