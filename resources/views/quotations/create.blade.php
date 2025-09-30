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

                                                              <div class="grid grid-cols-2 md:grid-cols-2 gap-6 mb-6">

                                <div>
                                    <label for="event_date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" min="{{ date('Y-m-d') }}" name="event_date" id="event_date"
                                        required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                   <div>
                                    <label for="event_time" class="block text-sm font-medium text-gray-700">Time</label>
                                    <input type="text" name="event_time" id="event_time" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Select time" />
                                </div>
                                </div>

                                <div>
                                    <label for="event_venue"
                                        class="block text-sm font-medium text-gray-700">Venue</label>
                                    <input type="text" name="event_venue" id="event_venue" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                             

                              <div class="grid grid-cols-2 md:grid-cols-2 gap-6 mb-6">
                                  <div>
                                <label for="per_plate_price" class="block text-sm font-medium text-gray-700">Per Plate Price (₹)</label>
                                <input type="number" placeholder="0.00" name="per_plate_price" id="per_plate_price" required min="0" step="0.01"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="number_of_people" class="block text-sm font-medium text-gray-700">Number of People</label>
                                <input type="number" name="number_of_people" id="number_of_people" required min="1"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                          
                        </div>

                            </div>

                        </div>


                      

                        <!-- Menu Items -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Food Menu</h3>

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

                        <!-- Stage Decor Section - Toggleable -->
                        <div class="mb-6" x-data="{ showDecor: false }">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Stage Decor</h3>
                            </div>

                            <!-- Decor Fields (Shown when toggled) -->
                            <div x-cloak x-show="showDecor"
                                class="p-4 border border-gray-200 rounded-lg bg-gray-50 mb-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="decor_type" class="block font-medium text-gray-700">Type</label>
                                        <input type="text" name="decor_type" id="decor_type"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            placeholder="e.g., Stage, Mandap, Backdrop">
                                    </div>

                                    <div>
                                        <label for="stage_amount" class="block font-medium text-gray-700">Amount
                                            (₹)</label>
                                        <input type="number" placeholder="0.00" name="stage_amount" min="0"
                                            id="stage_amount"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>


                                </div>
                                <!-- Remove Button -->
                                <div class="mt-3 flex justify-end">
                                    <button type="button"
                                        @click="showDecor = false; document.getElementById('decor_type').value = ''; document.getElementById('stage_amount').value = '';"
                                        class="text-red-600 hover:text-red-900 text-sm font-medium">
                                        Remove Decor
                                    </button>
                                </div>
                            </div>

                            <!-- Empty State (Shown when not toggled) -->
                            <div x-cloak x-show="!showDecor" class="empty-state" @click="showDecor = true">
                                <i class="fas fa-plus-circle icon-plus" style="font-size: 2rem;"></i>

                                <h3 class="mt-2 text-sm font-medium text-gray-900">No decor details added</h3>
                                <p class="mt-1 text-sm text-gray-500">Click the plus icon to add stage and decor
                                    arrangements.</p>
                            </div>
                        </div>

                        <!-- Seating and Table -->
                        <div class="mb-6" x-data="{ showSeatings: false }">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Seating & Table Setting</h3>
                            </div>

                            <!-- Decor Fields (Shown when toggled) -->
                            <div x-cloak x-show="showSeatings"
                                class="p-4 border border-gray-200 rounded-lg bg-gray-50 mb-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                                    <div>
                                                                                {{-- <h3 class="text-lg font-medium text-gray-900">Seating Details</h3> --}}

                                        <label for="number_of_seats" class="block font-medium text-gray-700">Number of
                                            Seats</label>
                                        <input type="number" name="number_of_seats" id="number_of_seats"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            placeholder="e.g., 150">
                                    </div>


                                    <div>
                                        <label for="seat_amount" class="block font-medium text-gray-700">Amount
                                            (₹)</label>
                                        <input type="number" placeholder="0.00" name="seat_amount" id="seat_amount"
                                            min="0"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                   



                                    <div>
                                        <label for="number_of_tables" class="block font-medium text-gray-700">Number of
                                            Tables</label>
                                        <input type="number" name="number_of_tables" id="number_of_tables"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            placeholder="e.g., 100">
                                    </div>
                                    <div>
                                        <label for="table_amount" class="block font-medium text-gray-700">Amount
                                            (₹)</label>
                                        <input type="number" placeholder="0.00" name="table_amount" id="table_amount"
                                            min="0"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                              



                                </div>
                                <!-- Remove Button -->
                                <div class="mt-3 flex justify-end">
                                    <button type="button"
                                        @click="showSeatings = false; document.getElementById('decor_type').value = ''; document.getElementById('stage_amount').value = '';"
                                        class="text-red-600 hover:text-red-900 text-sm font-medium">
                                        Remove Seating
                                    </button>
                                </div>
                            </div>

                            <!-- Empty State (Shown when not toggled) -->
                            <div x-cloak x-show="!showSeatings" class="empty-state" @click="showSeatings = true">
                                <i class="fas fa-plus-circle icon-plus"></i>

                                <h3 class="mt-2 text-sm font-medium text-gray-900">No seating details added</h3>
                                <p class="mt-1 text-sm text-gray-500">Click the plus icon to add seating arrangements.
                                </p>
                            </div>
                        </div>





                        <div class="flex justify-end gap-2">
                          
            <a href="{{ route('quotations.index') }}"
                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center">
                Cancel
            </a>
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
              $(function () {
        $('#event_time').timepicker({
            timeFormat: 'h:mm p',
            interval: 15,
            minTime: '12:00am',
            maxTime: '11:45pm',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
        });
    </script>
</x-app-layout>