<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Menu Items') }}
            </h2>
            <div x-data="{ open: false }" class="inline">
                <button @click="open = true" class="main-btn">
                    Add Menu Item
                </button>

                <!-- Add Modal -->
                <div x-cloak x-show="open"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 mx-4">
                        <div class="flex justify-between items-center border-b pb-2 mb-4">
                            <h2 class="text-lg font-semibold text-gray-800">Add Menu Item</h2>
                            <button @click="open = false" class="text-gray-500 hover:text-gray-700">&times;</button>
                        </div>

                        <form action="{{ route('menu-items.store') }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Menu Item
                                        Name</label>
                                    <input type="text" name="name" id="name" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        value="{{ old('name') }}">
                                    @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="menu_category_id"
                                        class="block text-sm font-medium text-gray-700">Category</label>
                                    <select name="menu_category_id" id="menu_category_id" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('menu_category_id')==$category->id ?
                                            'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('menu_category_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description
                                        (Optional)</label>
                                    <textarea name="description" id="description" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                                    @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex justify-end mt-6 space-x-3">
                                <button type="button" @click="open = false"
                                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                                    Save Menu Item
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
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                    @endif

                    <div class="overflow-x-auto">
                        @foreach($categories as $category)
                        <h3 class="text-lg font-semibold text-gray-800 mb-2 mt-6 border-b pb-1">
                            {{ $category->name }}
                        </h3>

                        @php
                        $categoryItems = $items->where('menu_category_id', $category->id);
                        @endphp

                        @if($categoryItems->isNotEmpty())
                        <table class="min-w-full divide-y divide-gray-200 mb-6">
                            <thead class="bg-gray-50">
                                <tr>
                                    <!-- Fixed width for Name column -->
                                    <th class="w-1/2 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <!-- Fixed width for Description column -->
                                    <th class="w-1/2 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <!-- Flexible width for Actions column -->
                                    <th class="w-auto px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($categoryItems as $item)
                                <tr>
                                    <!-- Fixed width Name cell -->
                                    <td class="w-1/2 px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                                    </td>
                                    <!-- Fixed width Description cell -->
                                    <td class="w-1/2 px-6 py-4">
                                        <div class="text-sm text-gray-500">{{ $item->description ?? 'No description' }}</div>
                                    </td>
                                    <!-- Flexible width Actions cell -->
                                    <td class="w-auto px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <!-- Edit Modal -->
                                        <div x-data="{ editOpen: false }" class="inline">
                                            <button type="button"
                                                @click="editOpen = true"
                                                class="text-indigo-600 hover:text-indigo-900 mr-3">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <div x-cloak x-show="editOpen"
                                                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                                <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 mx-4">
                                                    <div class="flex justify-between items-center border-b pb-2 mb-4">
                                                        <h2 class="text-lg font-semibold text-gray-800">Edit Menu Item</h2>
                                                        <button @click="editOpen = false"
                                                            class="text-gray-500 hover:text-gray-700">&times;</button>
                                                    </div>
                                                    <form action="{{ route('menu-items.update', $item) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="space-y-4">
                                                            <div>
                                                                <label for="name-{{ $item->id }}"
                                                                    class="block text-sm font-medium text-gray-700">Menu
                                                                    Item Name</label>
                                                                <input type="text" name="name"
                                                                    id="name-{{ $item->id }}" required
                                                                    value="{{ $item->name }}"
                                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                            </div>
                                                            <div>
                                                                <label for="menu_category_id-{{ $item->id }}"
                                                                    class="block text-sm font-medium text-gray-700">Category</label>
                                                                <select name="menu_category_id"
                                                                    id="menu_category_id-{{ $item->id }}" required
                                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                                    <option value="">Select a category</option>
                                                                    @foreach($categories as $category)
                                                                    <option value="{{ $category->id }}" {{ $item->menu_category_id == $category->id ? 'selected' : '' }}>
                                                                        {{ $category->name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <label for="description-{{ $item->id }}"
                                                                    class="block text-sm font-medium text-gray-700">Description
                                                                    (Optional)</label>
                                                                <textarea name="description"
                                                                    id="description-{{ $item->id }}" rows="3"
                                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $item->description }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="flex justify-end mt-6 space-x-3">
                                                            <button type="button" @click="editOpen = false"
                                                                class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                                                Cancel
                                                            </button>
                                                            <button type="submit"
                                                                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                                                Update Menu Item
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div x-data="{ deleteOpen: false }" class="inline">
                                            <button type="button"
                                                @click="deleteOpen = true" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <div x-cloak x-show="deleteOpen"
                                                class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                                                <div class="bg-white rounded-lg shadow-lg w-96 p-6 mx-4">
                                                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Delete</h2>
                                                    <p class="text-sm text-gray-600 mb-6">Are you sure you want to
                                                        delete "{{ $item->name }}"?</p>
                                                    <div class="flex justify-end space-x-3">
                                                        <button type="button"
                                                            @click="deleteOpen = false"
                                                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                                            Cancel
                                                        </button>
                                                        <form action="{{ route('menu-items.destroy', $item) }}"
                                                            method="POST" class="inline">
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
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="text-sm text-gray-500 mb-6">No items in this category.</p>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
        
       
        
     
    </style>
</x-app-layout>