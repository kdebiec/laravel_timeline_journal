<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-md rounded-lg pt-6 pb-6">
            <div class="px-4 sm:px-6">
                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Edit Event Type</h2>
            </div>
            <div class="mt-6 flex-1 px-4 sm:px-6">
                <form method="POST" action="{{ route('eventtypes.update', $eventtype) }}">
                    @csrf
                    @method('patch')
                    <x-bladewind.input name="name" label="Event type name"  selected_value="{{ old('name', $eventtype->name) }}"/>
                    <x-input-error :messages="$errors->get('name')" class="" />
                    <x-bladewind.input name="color" label="Event type color"  selected_value="{{ old('color', $eventtype->color)}}"/>
                    <x-input-error :messages="$errors->get('color')" class="" />
                    <div class="mt-4 space-x-2">
                        <x-primary-button class="">{{ __('Edit Type') }}</x-primary-button>
                        <a href="{{ route('eventtypes.index') }}">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>