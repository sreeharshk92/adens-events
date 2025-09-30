<x-app-layout>
   <x-slot name="header">
   <div class="flex flex-col lg:flex-row justify-between lg:items-center">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2 lg:mb-0">
        {{ __('Quotation Details') }}
    </h2>

 
        <div class="flex flex-col lg:flex-row  sm:flex-row sm:space-x-2 gap-2 sm:space-y-2 sm:space-y-0">
            <a href="{{ route('quotations.share-whatsapp', $quotation) }}" target="_blank"
               class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center">
                <i class="fab fa-whatsapp mr-2"></i> Share via WhatsApp
            </a>

            <a href="{{ route('quotations.download-pdf', $quotation) }}"
               class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center">
                <i class="fas fa-download mr-2"></i> Download PDF
            </a>
        </div>
{{-- 
        <a href="{{ route('quotations.index') }}"
           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center mt-2 sm:mt-0">
           Back
        </a> --}}
  
</div>

</x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                        role="alert">
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
                             <p><strong>Date & Time:</strong> {{ \Carbon\Carbon::parse($quotation->event_date)->format('d M Y') }} at {{ $quotation->event_time }}</p>
                                <p><strong>Venue:</strong> {{ $quotation->event_venue }}</p>
                       

                            </div>
                        </div>
                    </div>



                  <!-- Menu Items -->
<div class="bg-gray-50 p-4 mb-6 rounded-lg">
    <h3 class="text-lg font-medium text-gray-900 mb-3">Selected Menu Items</h3>

    @php
    // group by the snapshot category stored in quotation_items
    $groupedItems = $quotation->quotationItems->groupBy('item_category');
    @endphp

    @foreach($groupedItems as $categoryName => $items)
        <div class="mb-4">
            <h4 class="font-medium text-gray-700 mb-2">{{ $categoryName ?? 'Uncategorized' }}</h4>
            <ul class="list-disc list-inside ml-4">
                @foreach($items as $item)
                    <li>{{ $item->item_name }}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>



                                  @if($quotation->number_of_tables && $quotation->table_amount)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
@else
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mb-8">

                     @endif
                       
                        <!-- Food Price Details -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Food Price</h3>
                            <div class="space-y-2">
                                <p><strong>Number of People:</strong> {{ $quotation->number_of_people }} Nos</p>
                                <p><strong>Per Plate Price:</strong> ₹{{ $quotation->per_plate_price }}</p>

                            </div>
                        </div>

 <!-- Stage Decor -->
                        @if($quotation->decor_type && $quotation->stage_amount)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Stage Decor</h3>
                            <div class="space-y-2">
                                <p><strong>Type:</strong> {{ $quotation->decor_type }}</p>
                                <p><strong>Amount:</strong> ₹{{ $quotation->stage_amount }}</p>
                            </div>
                        </div>
                        @endif
                       
                    </div>

                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                       
  @if($quotation->number_of_tables && $quotation->table_amount)
                        <!-- Seating Details -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Table Details</h3>
                            <div class="flex justify-between">                          
                            <div class="space-y-2">
                                <p><strong>Number of Tables:</strong> {{ $quotation->number_of_tables }} Nos</p>
                                <p><strong>Amount:</strong> ₹{{ $quotation->table_amount }}</p>
                            </div>

                             </div>
                        </div>
                        @endif
                         @if($quotation->number_of_seats && $quotation->seat_amount)
                        <!-- Seating Details -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Seating Details</h3>
                            <div class="flex justify-between">

                           
                            <div class="space-y-2">
                                <p><strong>Number of Seats:</strong> {{ $quotation->number_of_seats }} Nos</p>
                                <p><strong>Amount:</strong> ₹{{ $quotation->seat_amount }}</p>
                            </div>

        
                             </div>
                        </div>
                        @endif
                    </div>


                 <!-- Pricing Details -->
<div class="bg-gray-50 p-4 rounded-lg mb-6">
    <h3 class="text-lg font-medium text-gray-900 mb-3">Pricing Details</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg">
            <tbody class="divide-y divide-gray-200">
                <tr>
                    <td class="px-4 py-2 text-gray-700 font-medium">Per Plate Price × Number of People</td>
                    <td class="px-4 py-2 text-right">
                 ₹{{ number_format($quotation->per_plate_price * $quotation->number_of_people, 2) }}
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-700 font-medium">Stage & Decor</td>
                    <td class="px-4 py-2 text-right">
                        ₹{{ number_format($quotation->stage_amount ?? 0, 2) }}
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-700 font-medium">Seating & Table Setting</td>
                    <td class="px-4 py-2 text-right">
                        ₹{{ number_format($quotation->seat_amount ?? 0, 2) }}
                    </td>
                </tr>
                <tr class="bg-gray-100 font-semibold">
                    <td class="px-4 py-2 text-gray-900">Total Amount</td>
                    <td class="px-4 py-2 text-right text-green-600">
                        ₹{{ number_format($quotation->total_amount, 2) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


                    <div>
                       
                        <div class="space-x-2 mt-2 flex justify-between align-center flex-col lg:flex-row md:flex-row">
                             <div class="text-sm text-gray-500">
                            Created: {{ $quotation->created_at->format('M d, Y \\a\\t h:i A') }}
                        </div>
                            <div x-data="{ open: false }">
                                <div class="flex justify-end align-center mt-3 lg:mt-0 gap-2">

                              <a href="{{ route('quotations.index') }}"
           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center">
           Back
        </a>
                       <button type="button" @click="open = true"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete Quotation
                                </button>
  </div>
                                <div x-show="open"
                                    class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                                    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Delete</h2>
                                        <p class="text-sm text-gray-600 mb-6">Are you sure you want to delete this
                                            quotation?</p>

                                        <div class="flex justify-end space-x-3">
                                            <button type="button" @click="open = false"
                                                class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                                Cancel
                                            </button>

                                            <form action="{{ route('quotations.destroy', $quotation) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                            
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
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