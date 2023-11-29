<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            Add Staff to {{ $anime->title }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <form action="{{ route('anime.staff.store', $anime) }}" method="post">
                @csrf

                <div class="mb-4">
                    <label for="staff" class="block text-sm font-medium text-gray-600">Select Staff</label>
                    <select name="staff_id" id="staff" class="mt-1 p-2 border rounded-md w-full" required>
                        @foreach($staffMembers as $staff)
                        <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-600">Role</label>
                    <input type="text" name="role" id="role" class="mt-1 p-2 border rounded-md w-full" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 mb-4 rounded-md">Add Staff</button>
            </form>
            <a href="{{ route('staff.create') }}" class="text-link-blue">
                <strong class="text-sm">Create New Staff</strong>
            </a>
        </div>
    </div>
</x-app-layout>