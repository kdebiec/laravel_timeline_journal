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
                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="p-4 flex items-center text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                    Lp
                                </th>
                                <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                    Event Type Name
                                </th>
                                <th scope="col" class="py-3 px-6 pl-12 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
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
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($eventtypes as $eventtype)
                            <tr class="hover:bg-gray-100">
                                <td class="p-4 w-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{$loop->index+1}}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap">{{$eventtype->name}}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap">
                                    <div class="relative rounded-md ">
                                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none text-secondary-400">
                                            <span class="flex items-center self-center pl-1">
                                                <div class="w-4 h-4 rounded shadow border" style="background-color:{{ $eventtype->color}};"></div>
                                            </span>
                                        </div>
                                        <p class="block w-full pl-8">{{$eventtype->color}}</p>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                    <a href="{{route('eventtypes.edit', $eventtype)}}" class="text-blue-600 hover:underline">Edit</a>
                                </td>
                                <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                    <form action="{{ route('eventtypes.destroy', $eventtype) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                          <button type="submit" class="text-red-600 hover:text-red-900">Remove</button>
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