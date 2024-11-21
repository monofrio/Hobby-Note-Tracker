<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


        <div class="mt-6">
            {{-- ## Plant Batch List ## --}}
            <section class="max-w-7xl mx-auto mt-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl">Plant Batches</h2>
                <table class="table-auto border-collapse border border-gray-400">
                    <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Batch</th>
                        <th class="border border-gray-300 px-4 py-2">Total Plants</th>
                        <th class="border border-gray-300 px-4 py-2">Batch Number</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($batches as $batch)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('plants.batch', $batch->batch_number) }}" class="text-blue-500 underline">
                                    {{ $batch->name }}
                                </a>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $batch->total_plants }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $batch->batch_number }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </section>
            {{-- ## New Exports ## --}}
            <section class="max-w-7xl mx-auto mt-4 sm:px-6 lg:px-8" >
                @if( $notExportedCount > 0 )

                    <h2 class="text-2xl">New Export</h2>
                    <div class="my-4">
                        <a href="{{ route('plants.export') }}" class="btn-primary">Export Plants to CSV</a>
                    </div>
                @endif
            </section>

{{-- ## Chrips ## --}}
{{--            <section class="max-w-7xl mx-auto mt-4 sm:px-6 lg:px-8">--}}
{{--                <div class="max-w-7xl mx-auto"> <h2 class="font-semibold text-xl text-gray-800">The lastest Chrips</h2> </div>--}}
{{--                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                    <x-chirps-list :chirps="$chirps" list-num="2" />--}}
{{--                </div>--}}
{{--            </section>--}}

        </div>

</x-app-layout>
