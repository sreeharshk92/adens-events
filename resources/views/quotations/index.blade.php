<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Quotations') }}
            </h2>
            <a href="{{ route('quotations.create') }}" class="main-btn">
                Create Quotation
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quotation No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($quotations as $quotation)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $quotation->quotation_number }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $quotation->client_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $quotation->client_place }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $quotation->event_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $quotation->event_date }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $quotation->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        ₹{{ number_format($quotation->total_amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <!-- Action Buttons -->
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('quotations.show', $quotation) }}" 
                                               class="text-indigo-600 hover:text-indigo-900"
                                               title="View Quotation">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            <a href="{{ route('quotations.download-pdf', $quotation) }}" 
                                               class="text-green-600 hover:text-green-900"
                                               title="Download PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>

                                            <!-- WhatsApp Share -->
                                            <a href="{{ route('quotations.share-whatsapp', $quotation) }}" 
                                               target="_blank"
                                               class="text-green-500 hover:text-green-700"
                                               title="Share via WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>

                                            <!-- Delete Modal -->
                                            <div x-data="{ deleteOpen: false }" class="inline">
                                                <button type="button" 
                                                        @click="deleteOpen = true" 
                                                        class="text-red-600 hover:text-red-900"
                                                        title="Delete Quotation">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                                <!-- Delete Modal -->
                                                <div x-cloak x-show="deleteOpen" 
                                                     class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                                                    <div class="bg-white rounded-lg shadow-lg w-96 p-6 mx-4">
                                                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Delete</h2>
                                                        <p class="text-sm text-gray-600 mb-6">
                                                            Are you sure you want to delete quotation <br> 
                                                            <span class="font-semibold">"{{ $quotation->quotation_number }}"</span> 
                                                            for <span class="font-semibold">{{ $quotation->client_name }}</span>?
                                                        </p>

                                                        <div class="flex justify-end space-x-3">
                                                            <button type="button" 
                                                                    @click="deleteOpen = false" 
                                                                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                                                Cancel
                                                            </button>
                                                            <form action="{{ route('quotations.destroy', $quotation) }}" method="POST" class="inline">
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
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($quotations->isEmpty())
                    <div class="text-center py-8">
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No quotations</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new quotation.</p>
                        <div class="mt-6">
                            <a href="{{ route('quotations.create') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Create Quotation
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>