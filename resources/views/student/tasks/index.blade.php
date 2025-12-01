<x-app-layout>
    <h1 class="text-xl font-bold mb-4">Dostupni radovi</h1>

    @if(session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="text-red-600 mb-4">{{ session('error') }}</div>
    @endif

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-2 py-1">Naziv rada (HR)</th>
                <th class="border px-2 py-1">Naziv rada (EN)</th>
                <th class="border px-2 py-1">Opis</th>
                <th class="border px-2 py-1">Tip studija</th>
                <th class="border px-2 py-1">Nastavnik</th>
                <th class="border px-2 py-1">Akcija</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td class="border px-2 py-1">{{ $task->title_hr }}</td>
                <td class="border px-2 py-1">{{ $task->title_en }}</td>
                <td class="border px-2 py-1">{{ $task->description }}</td>
                <td class="border px-2 py-1">{{ $task->study_type }}</td>
                <td class="border px-2 py-1">{{ $task->user->name }}</td>
                <td class="border px-2 py-1">
                    <form action="{{ route('tasks.apply', $task) }}" method="POST">
                        @csrf
                        <button class="bg-blue-500 text-white px-3 py-1 rounded">Prijavi</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
