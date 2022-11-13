<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="flex h-full flex-col bg-white py-6 shadow-lg rounded-lg">
            <div class="px-4 sm:px-6">
                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Create Post</h2>
            </div>
            <div class="mt-6 flex-1 px-4 sm:px-6">
                <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                    @csrf
                    <x-bladewind.input name="event_name" label="Event name"  />
                    <x-input-error :messages="$errors->get('event_name')" class="" />
                    @if(isset($eventtypes) && !empty($eventtypes))
                    <x-bladewind.dropdown
                        placeholder="Choose event type"
                        searchable="true"
                        name="event_type_id"
                        label_key="name"
                        labelKey="name"
                        value_key="id"
                        data="{{ json_encode($eventtypes) }}" 
                    />
                    @endif
                    <x-bladewind.textarea name="short_desc" label="Short description"  />
                    <x-input-error :messages="$errors->get('short_desc')" class="" />
                    <x-bladewind.textarea name="long_desc" label="Long description"  />
                    <x-input-error :messages="$errors->get('long_desc')" class="" />
                    <x-bladewind.radio-button label="Event"     value="event" name="post_type" checked="true" />
                    <x-bladewind.radio-button label="Process"   value="process" name="post_type"  />
                    <div class="mt-2">
                        <x-bladewind.datepicker name="start_date" label="Start Date"/>
                        <x-input-error :messages="$errors->get('start_date')" class="" />
                    </div>
                    <div class="hidden" id="end_date_div">
                        <x-bladewind.datepicker name="end_date" label="End Date"  />
                        <x-input-error :messages="$errors->get('end_date')" class="" />
                    </div>
                    <label class="block mb-4">
                        <span class="sr-only">Choose File</span>
                        <input type="file" name="image" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                        <x-input-error :messages="$errors->get('image')" class="" />
                            {{-- @error('image')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror --}}
                    </label>
                    <x-primary-button class="">{{ __('Post') }}</x-primary-button>
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