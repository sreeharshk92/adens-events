<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="md:text-left mb-5 md:mb-0">
                        <h1 class="text-2xl md:text-3xl font-bold mb-2">Welcome to Adens Events</h1>
                        <p>Professional quotation management for your catering business</p>
                    </div>

                    <div class="flex md:flex-col lg:flex-col w-full md:w-auto lg:w-auto flex-row items-end  justify-between">
                        <p class="text-xs">Welcome back, {{ Auth::user()->name }}!</p>
                        <p class="text-xs">{{ now()->format('l, M j, Y') }}</p>
                    </div>
                    {{-- <div class="bg-white/20 rounded-lg p-3 text-center">
                        <div class="text-2xl font-bold">{{ \App\Models\Quotation::whereDate('created_at',
                            today())->count() }}</div>
                        <div class="text-sm text-blue-100">Quotes Today</div>
                    </div> --}}
                </div>
            </div>
            <!-- Simple 2-column grid for mobile -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
                <!-- Create Quotation -->
                <a href="{{ route('quotations.create') }}"
   class="group bg-white hover:bg-[rgb(51,13,83)] hover:text-white rounded-xl shadow-lg p-5 text-center min-h-[120px] flex flex-col justify-center border-0">
    <div class="mb-2">
        <svg class="w-8 h-8 text-gray-600 group-hover:text-white mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
    </div>
    <h5 class="font-bold text-sm mb-1">Create Quotations</h5>
</a>


                <!-- Previous Quotations -->
                <a href="{{ route('quotations.index') }}"
                    class=" group bg-white  hover:bg-[rgb(51,13,83)] hover:text-white rounded-xl shadow-lg p-5 text-center min-h-[120px] flex flex-col justify-center border border-gray-200">
                    <div class="mb-2">
                        <svg class="w-8 h-8 mx-auto group-text-gray-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h5 class="font-bold text-sm mb-1">Previous Quotations</h5>
                </a>

                <!-- Menu Categories -->
                <a href="{{ route('menu-categories.index') }}"
                    class="group bg-white  hover:bg-[rgb(51,13,83)] hover:text-white rounded-xl shadow-lg p-5 text-center min-h-[120px] flex flex-col justify-center border border-gray-200">
                    <div class="mb-2">
                        <svg class="w-8 h-8 mx-auto group-text-gray-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    </div>
                    <h5 class="font-bold text-sm mb-1">Menu Categories</h5>
                </a>

                <!-- Menu Items -->
                <a href="{{ route('menu-items.index') }}"
                    class="group bg-white  hover:bg-[rgb(51,13,83)] hover:text-white rounded-xl shadow-lg p-5 text-center min-h-[120px] flex flex-col justify-center border border-gray-200">
                    <div class="mb-2">
                        <svg class="w-8 h-8 mx-auto group-text-gray-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h5 class="font-bold text-sm mb-1">Menu Items</h5>
                </a>

                <!-- Company Profile -->
                <a href="{{ route('profile.edit') }}"
                    class="group bg-white  hover:bg-[rgb(51,13,83)] hover:text-white rounded-xl shadow-lg p-5 text-center min-h-[120px] flex flex-col justify-center border border-gray-200">
                    <div class="mb-2">
                        <svg class="w-8 h-8 mx-auto group-text-gray-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h5 class="font-bold text-sm mb-1">Company Profile</h5>
                </a>
            </div>
        </div>
    </div>


    <style>
        /* Custom color theme based on Adens Events branding */
        .bg-gradient-brand {
            /* background: linear-gradient(135deg, #1e40af 0%, #7c3aed 100%); */
            background: #3b125e
        }

        /* Smooth animations */
        .group:hover .group-hover\:scale-105 {
            transform: scale(1.05);
        }

        /* Mobile optimizations */
        @media (max-width: 640px) {
            .grid.grid-cols-1.sm\:grid-cols-2.lg\:grid-cols-3 {
                grid-template-columns: 1fr;
            }

            .grid.grid-cols-2.lg\:grid-cols-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .grid.grid-cols-1.sm\:grid-cols-2.lg\:grid-cols-3 {
                grid-template-columns: repeat(3, 1fr);
            }
        }
    </style>
</x-app-layout>