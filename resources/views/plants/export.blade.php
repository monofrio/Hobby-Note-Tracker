<x-app-layout>
    <div class="container">
        <x-h1>Export Plants</x-h1>
        <div>
            <p>This list contains plants that not have been exported yet.</p>
        </div>

        <section>
            <form action="{{ route('plants.export.submit') }}" method="POST">
                @csrf
                <table class="table border">
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
                            <td>{{ $plant->batch_number }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary">Export Selected Plants</button>
            </form>
        </section>
    </div>

</x-app-layout>
