@props([
    'status' => 'pending',
    'stacked' => 'false',
    'date' => '',
    'label' => '',
    'last' => 'false',
    'color' => 'indigo',
    'coloring' => [
        'bg' => [
            'red' => 'bg-red-500',
            'yellow' => 'bg-yellow-500',
            'green' => 'bg-emerald-500',
            'blue' => 'bg-blue-500',
            'orange' => 'bg-orange-500',
            'purple' => 'bg-purple-500',
            'cyan' => 'bg-cyan-500',
            'pink' => 'bg-pink-500',
            'black' => 'bg-black',
        ],
        'border' => [
            'red' => 'border-red-500',
            'yellow' => 'border-yellow-500',
            'green' => 'border-emerald-500',
            'blue' => 'border-blue-500',
            'orange' => 'border-orange-500',
            'purple' => 'border-purple-500',
            'cyan' => 'border-cyan-500',
            'pink' => 'border-pink-500',
            'black' => 'border-black',
            'indigo' => 'border-indigo-400',
        ],
        'text' => [
            'red' => 'text-red-500',
            'yellow' => 'text-yellow-500',
            'green' => 'text-emerald-500',
            'blue' => 'text-blue-500',
            'orange' => 'text-orange-500',
            'purple' => 'text-purple-500',
            'cyan' => 'text-cyan-500',
            'pink' => 'text-pink-500',
            'black' => 'text-black',
        ],
    ],
])

<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        {{-- @if (Auth::check())
        
        <div class="flex h-full flex-col bg-white py-6 shadow-xl">
            <div class="px-4 sm:px-6">
                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Create Post</h2>
            </div>
            <div class="relative mt-6 flex-1 px-4 sm:px-6">
                <form method="POST" action="{{ route('events.store') }}">
                    @csrf
                    <x-bladewind.input label="Event name"  />
                    <x-bladewind.textarea label="Short description"  />
                    <x-bladewind.textarea label="Long description"  />
                    <x-bladewind.radio-button label="Event"     value="event" name="post_type" checked="true" />
                    <x-bladewind.radio-button label="Process"   value="process" name="post_type"  />
                    <div>
                        <x-bladewind.datepicker label="Start Date"/>
                    </div>
                    <div class="hidden" id="end_date_div">
                        <x-bladewind.datepicker label="End Date"  />
                    </div>
                    <x-primary-button class="mt-4">{{ __('Post') }}</x-primary-button>
                </form>
            </div>
        </div>
        @endif --}}

        <div class="w-96 mx-auto">
            @foreach ($events as $event)
            <div class="flex text-slate-600">
                <div class="z-20">
                    <div class="h-8 w-8 @if($status=='pending') bg-white border-4 {{ $coloring['border'][$color] }}  @else {{$coloring['bg'][$color]}} @endif rounded-full" style="border-color: {{$event->event_type->color}}"></div>
                </div>
                <div class="@if(!$loop->last) border-l-4 {{ $coloring['border'][$color] }}@endif pl-8 pb-14 z-10" style="margin-left: -18px; border-color: {{$event->event_type->color}}">
                    <div class="bg-white shadow-sm rounded-lg divide-y">
                        <a href="{{route('events.show', $event)}}">
                            <div class="p-6 w-96">
                                <div class="flex-1">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <span class="font-bold tracking-tight text-gray-800">{{ $event->event_name }}</span>
                                            <small class="ml-2 text-sm text-gray-600">{{ $event->start_date }}</small>
                                            @if(isset($event->end_date) && !empty($event->end_date))
                                                <small class="ml-2 text-sm text-gray-600">-</small>
                                                <small class="ml-2 text-sm text-gray-600">{{ $event->end_date }}</small>
                                            @endif
                                            @unless ($event->created_at->eq($event->updated_at))
                                                <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                            @endunless
                                        </div>
                                    </div>
                                    <x-bladewind.tag label="{{ $event->event_type->name }}" color="{{ $event->event_type->color }}"/>
                                    <div class="mt-2">
                                        <div class="mt-0">
                                            <p class="text-sm text-gray-600">{{ $event->short_desc }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        {{-- <a href="{{route('events.show', $event)}}">
                            <div class="p-6 w-96 ">
                                <div class="flex-1">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <span class="text-gray-800">{{ $event->event_name }}</span>
                                            <small class="ml-2 text-sm text-gray-600">{{ $event->created_at->format('j M Y') }}</small>
                                            @unless ($event->created_at->eq($event->updated_at))
                                                <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                            @endunless
                                        </div>
                                        @if ($event->user->is(auth()->user()))
                                            <x-dropdown>
                                                <x-slot name="trigger">
                                                    <button>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        </svg>
                                                    </button>
                                                </x-slot>
                                                <x-slot name="content">
                                                    <x-dropdown-link :href="route('events.edit', $event)">
                                                        {{ __('Edit') }}
                                                    </x-dropdown-link>
                                                </x-slot>
                                            </x-dropdown>
                                        @endif
                                    </div>
                                    <p class="flex mt-4 text-lg text-gray-900">{{ $event->short_desc }}</p>
                                </div>
                            </div>
                        </a> --}}
                    </div>
                </div>
            </div>
            @endforeach
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