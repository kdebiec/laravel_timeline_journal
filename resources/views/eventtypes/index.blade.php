<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-md rounded-lg pt-6 pb-6">
            <div class="px-4 sm:px-6">
                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Create Event Type</h2>
            </div>
            <div class="mt-6 flex-1 px-4 sm:px-6">
                <form method="POST" action="{{ route('eventtypes.store') }}">
                    @csrf
                    <x-bladewind.input name="name" label="Event type name"  />
                    <x-input-error :messages="$errors->get('name')" class="" />
                    <x-bladewind.input name="color" label="Event type color"  />
                    <x-input-error :messages="$errors->get('color')" class="" />
                    <x-primary-button class="">{{ __('Create Type') }}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
    <div class="max-w-2xl mx-auto sm:p-6 lg:p-8">
        <div class="flex flex-col">
        <div class="overflow-x-auto shadow-lg sm:rounded-lg">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden ">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="p-4 flex items-center text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Lp
                                </th>
                                <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Event Type Name
                                </th>
                                <th scope="col" class="py-3 px-6 pl-12 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Color
                                </th>
                                <th scope="col" class="p-4">
                                    <span class="sr-only">Edit</span>
                                </th>
                                <th scope="col" class="p-4">
                                    <span class="sr-only">Remove</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach ($event_types as $event_type)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-4 w-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$loop->index+1}}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$event_type->name}}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                    <div class="relative rounded-md ">
                                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none text-secondary-400">
                                            <span class="flex items-center self-center pl-1">
                                                <div class="w-4 h-4 rounded shadow border" style="background-color:{{ $event_type->color}};"></div>
                                            </span>
                                        </div>
                                        <p class="block w-full pl-8">{{$event_type->color}}</p>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                    <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                                <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                    {{-- <form method="POST" action="{{ route('eventtypes.destroy', $event_type) }}">
                                        @csrf
                                        @method('delete')
                                        <x-dropdown-link :href="route('eventtypes.destroy', $event_type)" onclick="event.preventDefault(); this.closest('form').submit();" class="text-blue-600 dark:text-blue-500 hover:underline">
                                            {{ __('Delete') }}
                                        </x-dropdown-link>
                                    </form> --}}
                                    <form action="{{ route('eventtypes.destroy', $event_type->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                          <button type="submit" class="text-red-600 hover:text-red-900">{{$event_type->id}}</button>
                                      </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>