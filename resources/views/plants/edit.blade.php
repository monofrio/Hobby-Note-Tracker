<x-app-layout>

    <div class="mx-auto max-w-2xl">
        <x-h1>Edit Plant</x-h1>

        <form method="POST" action="{{ route('plants.update', $plant) }}">
            @csrf
            @method('PUT')
            <p><strong>Plant Number in Batch:</strong> {{ $plant->batch_plant_number }}/{{ \App\Models\Plant::where('batch_number', $plant->batch_number)->count() }}</p>

            <x-form.input label="name" type="text" value="{{ old('name', $plant->name) }}" required />

            <x-form.textarea
                label="description"
                :value="old('description', $plant->description)"
                required="true"
            />

            <x-form.select
                label="Location Type"
                name="location_type"
                :options="['indoor' => 'Indoor', 'outdoor' => 'Outdoor']"
                :checked="old('location_type', $plant->location_type)"
            />

            <x-form.select
                label="Start Type"
                :options="['seed' => 'Seed', 'transplant' => 'Transplant', 'clone' => 'Clone']"
                selected="transplant"
                :checked="old('start_type', $plant->location_type)"
            />

            <x-primary-button color="blue" type="submit">Update Plant</x-primary-button>
        </form>
    </div>

    <a href="{{ route('plants.show', $plant) }}"
       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Back to {{$plant->name}}
    </a>
</x-app-layout>
