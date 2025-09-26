<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Quotation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('quotations.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Client Details -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900">Client Details</h3>

                                <div>
                                    <label for="client_name" class="block text-sm font-medium text-gray-700">Client
                                        Name</label>
                                    <input type="text" name="client_name" id="client_name" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label for="client_place"
                                        class="block text-sm font-medium text-gray-700">Place</label>
                                    <input type="text" name="client_place" id="client_place" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label for="client_contact" class="block text-sm font-medium text-gray-700">Contact
                                        Number</label>
                                    <input type="text" name="client_contact" id="client_contact" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>

                            <!-- Event Details -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900">Event Details</h3>

                                <div>
                                    <label for="event_name" class="block text-sm font-medium text-gray-700">Event
                                        Name</label>
                                    <input type="text" name="event_name" id="event_name" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label for="event_date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date"  min="{{ date('Y-m-d') }}" name="event_date" id="event_date" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label for="event_time" class="block text-sm font-medium text-gray-700">Time</label>
                                    <input type="text" name="event_time" id="event_time" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="hh:mm AM/PM" />
                                </div>
                            </div>
                        </div>

                        <!-- Pricing -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="number_of_people" class="block text-sm font-medium text-gray-700">Number of
                                    People</label>
                                <input type="number" name="number_of_people" id="number_of_people" required min="1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="per_plate_price" class="block text-sm font-medium text-gray-700">Per Plate
                                    Price (₹)</label>
                                <input type="number" name="per_plate_price" id="per_plate_price" required min="0"
                                    step="0.01"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <!-- Menu Items -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Select Menu Items</h3>

                            @foreach($categories as $category)
                            <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                                <h4 class="font-medium text-gray-700 mb-3">{{ $category->name }}</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                                    @foreach($category->activeMenuItems as $item)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="menu_items[]" value="{{ $item->id }}"
                                            id="item_{{ $item->id }}"
                                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label for="item_{{ $item->id }}" class="ml-2 text-sm text-gray-700">{{
                                            $item->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create Quotation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

 <script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#event_time').timepicker({
            timeFormat: 'h:i A',
            interval: 15,
            dropdown: true,
            scrollbar: true,
            defaultTime: '12:00 PM'
        });
    });
</script>

</x-app-layout>