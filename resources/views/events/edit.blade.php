<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="flex h-full flex-col bg-white py-6 shadow-xl">
            <div class="px-4 sm:px-6">
                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Edit Post</h2>
            </div>
            <div class="mt-6 flex-1 px-4 sm:px-6">
                <form method="POST" action="{{ route('events.update', $event) }}">
                    @csrf
                    @method('patch')
                    <x-bladewind.input class="text-sm" name="event_name" label="Event name" selected_value="{{ old('event_name', $event->event_name) }}"/>
                    <x-input-error :messages="$errors->get('event_name')" class="" />
                    <x-bladewind.dropdown
                        placeholder="Choose event type"
                        searchable="true"
                        name="event_type_id"
                        label_key="name"
                        labelKey="name"
                        value_key="id"
                        data="{{ json_encode($eventtypes) }}" 
                        selected_value="{{ old('event_type_id', $event->event_type_id) }}"
                    />
                    <x-bladewind.textarea name="short_desc" label="Short description"  selected_value="{{ old('short_desc', $event->short_desc) }}" />
                    <x-input-error :messages="$errors->get('short_desc')" class="" />
                    <x-bladewind.textarea name="long_desc" label="Long description" selected_value="{{ old('long_desc', $event->long_desc) }}" />
                    <x-input-error :messages="$errors->get('long_desc')" class="" />
                    <x-bladewind.radio-button label="Event"     value="event" name="post_type" checked="true" />
                    <x-bladewind.radio-button label="Process"   value="process" name="post_type"  />
                    <div class="mt-2">
                        <x-bladewind.datepicker name="start_date" label="Start Date" default_date="{{ old('start_date', $event->start_date) }}"/>
                        <x-input-error :messages="$errors->get('start_date')" class=""/>
                    </div>
                    <div class="hidden" id="end_date_div">
                        <x-bladewind.datepicker name="end_date" label="End Date"  />
                        <x-input-error :messages="$errors->get('end_date')" class="" />
                    </div>
                    <div class="mt-4 space-x-2">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                        <a href="{{ route('events.index') }}">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const radioButtonSection = document.getElementsByName('post_type');
    radioButtonSection.forEach((item)=>{
        item.onclick = function() {
            if(this.value == "event") {
                document.getElementById("end_date_div").classList.add("hidden");
            } else {
                document.getElementById("end_date_div").classList.remove("hidden");
            }
        }
    })
</script>

{{-- <x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('events.update', $event) }}">
            @csrf
            @method('patch')
            <textarea
                name="message"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message', $event->message) }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('events.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout> --}}