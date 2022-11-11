<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-sm rounded-lg divide-y">
            <div class="p-6">
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="font-bold tracking-tight text-gray-800">{{ $event->event_name }}</span>
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
                                    <form method="POST" action="{{ route('events.destroy', $event) }}">
                                        @csrf
                                        @method('delete')
                                        <x-dropdown-link :href="route('events.destroy', $event)" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Delete') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @endif
                    </div>
                    <div class="mt-2">
                        <div class="mt-0">
                            <p class="text-sm text-gray-600">{{ $event->short_desc }}</p>
                        </div>
                    </div>
            
                    <div class="mt-4">
                        <h2 class="text-sm font-medium text-gray-900">Long Description</h2>
            
                        <div class="mt-2">
                            <p class="text-sm text-gray-600">{{ $event->long_desc }}</p>
                        </div>
                    </div>
                    @if ($event->image != "")
                    <div class="mt-4">
                        <img src="{{ asset('storage/'.$event->image) }}">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>