<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ __('Create Staff') }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-600">Name</label>
                    <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label for="birthday" class="block text-gray-600">Birthday</label>
                    <input type="date" name="birthday" id="birthday" class="w-full border border-gray-300 rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-600">Description</label>
                    <textarea name="description" id="description" class="w-full border border-gray-300 rounded p-2" rows="4"></textarea>
                </div>

                <div class="mb-4">
                    <label for="profile_picture" class="block text-gray-600">Profile Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="w-full border border-gray-300 rounded p-2">
                    @error('profile_picture')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="bg-mal-blue text-white my-2 py-2 px-4 rounded">Create Staff</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>