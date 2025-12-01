<x-app-layout>
    <h1 class="text-xl font-bold mb-4">Prijave studenata</h1>

    @if(session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    @foreach($tasks as $task)
        <h2 class="text-lg font-semibold mt-4">{{ $task->title_hr }} ({{ $task->title_en }})</h2>
        <p class="mb-2">{{ $task->description }}</p>

        @if($task->applications->count() === 0)
            <p class="text-gray-500">Nema prijava.</p>
        @else
            <table class="table-auto w-full border-collapse border border-gray-300 mb-4">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-2 py-1">Student</th>
                        <th class="border px-2 py-1">Prioritet</th>
                        <th class="border px-2 py-1">Status</th>
                        <th class="border px-2 py-1">Akcija</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($task->applications as $app)
                        <tr>
                            <td class="border px-2 py-1">{{ $app->student->name }} ({{ $app->student->email }})</td>
                            <td class="border px-2 py-1">{{ $app->priority }}</td>
                            <td class="border px-2 py-1">{{ ucfirst($app->status) }}</td>
                            <td class="border px-2 py-1">
                                @if($app->status !== 'accepted')
                                <form action="{{ route('teacher.applications.accept', $app) }}" method="POST">
                                    @csrf
                                    <button class="bg-green-500 text-white px-3 py-1">Prihvati</button>
                                </form>
                                @else
                                    <span class="text-green-600 font-semibold">Prihvaćen</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach
</x-app-layout>
