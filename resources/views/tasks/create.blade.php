<x-app-layout>
    <div class="p-6">

        {{-- Language switch --}}
        <div class="mb-4">
            <a href="/lang/hr" class="px-2 py-1 bg-gray-200">HR</a>
            <a href="/lang/en" class="px-2 py-1 bg-gray-200">EN</a>
        </div>

        <h1 class="text-xl font-bold mb-4">{{ __('tasks.add_task') }}</h1>

        @if(session('success'))
            <div class="text-green-600 mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label>{{ __('tasks.title_hr') }}</label>
                <input type="text" name="title_hr" class="border w-full p-2">
            </div>

            <div>
                <label>{{ __('tasks.title_en') }}</label>
                <input type="text" name="title_en" class="border w-full p-2">
            </div>

            <div>
                <label>{{ __('tasks.description') }}</label>
                <textarea name="description" class="border w-full p-2"></textarea>
            </div>

            <div>
                <label>{{ __('tasks.study_type') }}</label>
                <select name="study_type" class="border w-full p-2">
                    <option value="strucni">{{ __('tasks.strucni') }}</option>
                    <option value="preddiplomski">{{ __('tasks.preddiplomski') }}</option>
                    <option value="diplomski">{{ __('tasks.diplomski') }}</option>
                </select>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2">
                {{ __('tasks.submit') }}
            </button>

        </form>

    </div>
</x-app-layout>
