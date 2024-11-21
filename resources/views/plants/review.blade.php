<x-app-layout>
    <div class="container">
        <x-h1>Review Exported Plants</x-h1>

        <form action="{{ route('plants.review.submit') }}" method="POST">
            @csrf
            <table class="table">
                <thead>
                <tr>
                    <th>Select</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Batch Number</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($plants as $plant)
                    <tr>
                        <td>
                            <input type="checkbox" name="plant_ids[]" value="{{ $plant->id }}">
                        </td>
                        <td>{{ $plant->id }}</td>
                        <td>{{ $plant->name }}</td>
                        <td>{{ $plant->start_type }}</td>
                        <td class="text-right">{{ $plant->batch_number }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Add Selected Plants to Export</button>
        </form>
    </div>
</x-app-layout>
