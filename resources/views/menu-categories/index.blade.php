<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Menu Categories') }}
            </h2>
            <div x-data="{ open: false }" class="inline">
                <button @click="open = true" class="main-btn">
                    Add Category
                </button>

                <!-- Modal -->
                <div x-cloak x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 mx-4">
                        <!-- Header -->
                        <div class="flex justify-between items-center border-b pb-2 mb-4">
                            <h2 class="text-lg font-semibold text-gray-800">Add Menu Category</h2>
                            <button @click="open = false" class="text-gray-500 hover:text-gray-700">&times;</button>
                        </div>

                        <!-- Form -->
                        <form action="{{ route('menu-categories.store') }}" method="POST">
                            @csrf

                            <div class="space-y-4">
                                <!-- Category Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                                    <input type="text" name="name" id="name" required
                                           value="{{ old('name') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           placeholder="e.g., Live Juice Counter, Main Course, Starters">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Sort Order -->
                                <div>
                                    <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort Order</label>
                                    <input type="number" name="sort_order" id="sort_order"
                                           value="{{ old('sort_order', 0) }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           placeholder="Lower numbers appear first">
                                    @error('sort_order')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Active Checkbox -->
                                {{-- <div class="flex items-center">
                                    <input type="checkbox" name="is_active" value="1"
                                           {{ old('is_active', true) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-600">Active</span>
                                </div> --}}
                            </div>

                            <!-- Actions -->
                            <div class="flex justify-end mt-6 space-x-3">
                                <button type="button" @click="open = false"
                                        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                    Cancel
                                </button>
                                <button type="submit"
                                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                                    Save Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu Items</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sort Order</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($categories as $category)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $category->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $category->menu_items_count }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $category->sort_order }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <!-- Edit Modal -->
                                        <div x-data="{ editOpen: false }" class="inline">
                                            <button type="button" 
                                                    @click="editOpen = true" 
                                                    class="text-indigo-600 hover:text-indigo-900 mr-3">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            <div x-cloak x-show="editOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                                <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 mx-4">
                                                    <div class="flex justify-between items-center border-b pb-2 mb-4">
                                                        <h2 class="text-lg font-semibold text-gray-800">Edit Category</h2>
                                                        <button @click="editOpen = false" class="text-gray-500 hover:text-gray-700">&times;</button>
                                                    </div>

                                                    <form action="{{ route('menu-categories.update', $category) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="space-y-4">
                                                            <!-- Name -->
                                                            <div>
                                                                <label for="name-{{ $category->id }}" class="block text-sm font-medium text-gray-700">Category Name</label>
                                                                <input type="text" name="name" id="name-{{ $category->id }}" required
                                                                    value="{{ $category->name }}"
                                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                            </div>

                                                            <!-- Sort Order -->
                                                            <div>
                                                                <label for="sort_order-{{ $category->id }}" class="block text-sm font-medium text-gray-700">Sort Order</label>
                                                                <input type="number" name="sort_order" id="sort_order-{{ $category->id }}"
                                                                    value="{{ $category->sort_order }}"
                                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                            </div>

                                                            <!-- Active Checkbox -->
                                                            {{-- <div class="flex items-center">
                                                                <input type="checkbox" name="is_active" value="1"
                                                                       {{ $category->is_active ? 'checked' : '' }}
                                                                       class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                                <span class="ml-2 text-sm text-gray-600">Active</span>
                                                            </div> --}}
                                                        </div>

                                                        <!-- Actions -->
                                                        <div class="flex justify-end mt-6 space-x-3">
                                                            <button type="button" @click="editOpen = false"
                                                                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                                                Cancel
                                                            </button>
                                                            <button type="submit"
                                                                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                                                Update
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div x-data="{ deleteOpen: false }" class="inline">
                                            <button type="button" @click="deleteOpen = true" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                            <div x-cloak x-show="deleteOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                                                <div class="bg-white rounded-lg shadow-lg w-96 p-6 mx-4">
                                                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Delete</h2>
                                                    <p class="text-sm text-gray-600 mb-6">
                                                        Are you sure you want to delete "{{ $category->name }}"?
                                    
                                                    </p>

                                                    <div class="flex justify-end space-x-3">
                                                        <button type="button" @click="deleteOpen = false" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                                            Cancel
                                                        </button>
                                                        <form action="{{ route('menu-categories.destroy', $category) }}" method="POST" class="inline">
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
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($categories->isEmpty())
                    <div class="text-center py-8">
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No menu categories</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new menu category.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>