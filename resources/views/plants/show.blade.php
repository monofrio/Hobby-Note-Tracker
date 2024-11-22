{{-- resources/views/plants/show.blade.php --}}
<x-app-layout>
    <x-h1>{{ $plant->name }}</x-h1>

    <section class="m-4">

        <div><strong>Start Date:</strong> {{ $plant->created_at->format('M d, Y') }}</div>
        <div><strong>Description:</strong> {{ $plant->description }}</div>
        <div><strong>Location Type:</strong> {{ ucfirst($plant->location_type) }}</div>

        <div><strong>Plant Number:</strong> {{ $plant->batch_plant_number }} of {{  $plant->active_plants  }}</div>
        <div><strong>Start Type:</strong> {{ ucfirst($plant->start_type) }}</div>
        <div><strong>Batch Number:</strong> {{ $plant->batch_number }}</div>

    </section>

    <aside class="m-4">
        <a  class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            href="{{ route('plants.edit', $plant) }}">Edit</a>

        <form
            action="{{ route('plants.destroy', $plant) }}"
            method="POST"
            style="display:inline;"
            onsubmit="return confirm('Are you sure you want to delete this plant?');"
        >
            @csrf
            @method('DELETE')
            <x-form.button color="red">{{ __('Delete') }}</x-form.button>
        </form>
    </aside>

    <hr class="my-10"/>

    <section class="m-4 ">
     <h3 class="text-3xl">Add a Note</h3>
    <form method="POST" action="{{ route('notes.store', $plant) }}">
        @csrf
{{--        <div>--}}
{{--            <label for="content" class="hidden">Note</label>--}}
{{--            <textarea name="content" id="content" required></textarea>--}}
{{--        </div>--}}
        <x-form.textarea
            label="content"
            value=""
            required="true"
        />
        <x-form.button color="blue" type="submit">Add Note</x-form.button>
    </form>


    <h2 class="text-4xl m-4" >Notes List </h2>
    @foreach($plant->notes as $note)
        <div class="mb-4 p-2 border rounded">
            <p>{{ $note->content }}</p>
            <small>Added on {{ $note->created_at->format('M d, Y') }}</small>
        </div>
    @endforeach

    {{-- Add a new note --}}
    </section>

    <a href="{{ route('plants.index') }}" class="text-blue-500 underline">Back to Plant List</a>


</x-app-layout>
