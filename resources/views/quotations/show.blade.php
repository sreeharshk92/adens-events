<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Quotation Details') }}
            </h2>
            <div class="space-x-2">


    <a href="{{ route('quotations.share-whatsapp', $quotation) }}" target="_blank" 
       class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded   space-x-2">
       <i class="fab fa-whatsapp mr-2"></i>  Share via WhatsApp
    </a>


                <a href="{{ route('quotations.download-pdf', $quotation) }}"  class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Download PDF
                </a>
  
                <a href="{{ route('quotations.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Client Details -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Client Details</h3>
                            <div class="space-y-2">
                                <p><strong>Name:</strong> {{ $quotation->client_name }}</p>
                                <p><strong>Place:</strong> {{ $quotation->client_place }}</p>
                                <p><strong>Contact:</strong> {{ $quotation->client_contact }}</p>
                            </div>
                        </div>

                        <!-- Event Details -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Event Details</h3>
                            <div class="space-y-2">
                                <p><strong>Event:</strong> {{ $quotation->event_name }}</p>
                                <p><strong>Date:</strong> {{ $quotation->event_date }}</p>
                                <p><strong>Time:</strong> {{ $quotation->event_time }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Details -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Pricing Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <p><strong>Number of People:</strong> {{ $quotation->number_of_people }}</p>
                            <p><strong>Per Plate Price:</strong> ₹{{ number_format($quotation->per_plate_price, 2) }}</p>
                            <p class="md:col-span-2"><strong>Total Amount:</strong> ₹{{ number_format($quotation->total_amount, 2) }}</p>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Selected Menu Items</h3>
                        @php
                            $groupedItems = $quotation->quotationItems->groupBy(function($item) {
                                return $item->menuItem->category->name;
                            });
                        @endphp
                        
                        @foreach($groupedItems as $categoryName => $items)
                        <div class="mb-4">
                            <h4 class="font-medium text-gray-700 mb-2">{{ $categoryName }}</h4>
                            <ul class="list-disc list-inside ml-4">
                                @foreach($items as $item)
                                <li>{{ $item->menuItem->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            Created: {{ $quotation->created_at->format('M d, Y \\a\\t h:i A') }}
                        </div>
                        <div class="space-x-2">
                          
                          
                            
           <div x-data="{ open: false }">
    <button type="button" @click="open = true" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
        Delete Quotation
    </button>

    <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Delete</h2>
            <p class="text-sm text-gray-600 mb-6">Are you sure you want to delete this quotation?</p>

            <div class="flex justify-end space-x-3">
                <button type="button" @click="open = false" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                    Cancel
                </button>

                <form action="{{ route('quotations.destroy', $quotation) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

    </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>