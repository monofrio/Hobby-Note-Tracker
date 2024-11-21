<x-app-layout>

    <div class="mx-auto max-w-2xl">
    <x-h1>Create Plant Batch</x-h1>


        <form method="POST" action="{{ route('plants.store') }}">

            @csrf
                <section class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <x-form-input label="name" type="text" value=""  />

                    <x-form-textarea label="description" value=""/>

                    <x-form-select
                        label="Location Type"
                        name="location_type"
                        :options="['indoor' => 'Indoor', 'outdoor' => 'Outdoor']"
                        value=""
                    />

                    <x-form-input type="number" label="quantity" required="required"  value=""/>

                    <x-form-select
                        label="Start Type"
                        name="start_type"
                        :options="['seed' => 'Seed', 'transplant' => 'Transplant', 'clone' => 'Clone']"
                        value=""
                    />

                    <x-form-select
                        label="Start Type"
                        :options="['seed' => 'Seed', 'transplant' => 'Transplant', 'clone' => 'Clone']"
                        selected="transplant"
                        value=""
                    />

                </section>
                <x-button class="mt-4" color="gray">{{ __('Add Plant') }}</x-button>

        </form>


    </div>
</x-app-layout>
