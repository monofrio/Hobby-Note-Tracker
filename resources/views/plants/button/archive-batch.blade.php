<form action="{{ route('plants.batch.archive', $batchNumber) }}" method="POST">
    @csrf
    @method('PATCH')
    <x-button
        class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md text-white hover:bg-yellow-700">
        Archive Batch
    </x-button>
</form>
