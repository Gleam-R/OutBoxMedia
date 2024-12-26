@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Activity Logs</h1>

        @if(session('success'))
            <div class="mb-4 text-green-600 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">No</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">User</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Activity</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Timestamp</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $log->user->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $log->activity }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                <form action="{{ route('admin.deleteLog', $log->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white py-1 px-4 rounded-md hover:bg-red-700 transition-colors duration-200">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $logs->links() }} <!-- Pagination links -->
            </div>
        </div>
    </div>
@endsection
