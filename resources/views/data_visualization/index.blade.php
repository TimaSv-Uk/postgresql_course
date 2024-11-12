<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data visualization') }}
        </h2>
    </x-slot>

    <div class="flex flex-col gap-4 p-6 m-6 border border-gray-300 rounded-lg shadow-md bg-white">
        <h1 class="text-2xl font-semibold mb-4">Navigate to:</h1>
        <h2  class="text-xl font-semibold mb-4">Розробити візуалізацію у табличному та графічному виглядах
максимальних значень шкідливих частинок PM2.5, PM10 в розрізі
областей за вказаний період часу.</h2>

            <form action="{{ route('data_visualization.1') }}" method="GET" class="space-y-4">
                @csrf

                <div class="mb-4">
                    <label for="start_time" class="block text-sm font-medium text-gray-700">Початкова дата та час:</label>
                    <input type="datetime-local" name="start_time" id="start_time" class="form-input mt-1 block w-full" required value="{{ old('start_time', '2022-08-02T16:04') }}">
                </div>

                <div class="mb-4">
                    <label for="end_time" class="block text-sm font-medium text-gray-700">Кінцева дата та час:</label>
                    <input type="datetime-local" name="end_time" id="end_time" class="form-input mt-1 block w-full" required value="{{ old('end_time', '2022-08-02T16:32') }}">
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Згенерувати звіт
                    </button>
                </div>
            </form>

        <h2  class="text-xl font-semibold mb-4">Розробити візуалізаціюу у табличному та графічному виглядах кількості
разів, коли було зафіксовано значення твердих частинок
PM2.5, значення яких відноситься до шкідливого рівню на певній станції
за весь час</h2>

        <form action="{{ route('data_visualization.2') }}" method="GET" class="space-y-4">
            @csrf

            <div class="mb-4">
                <label for="station" class="block text-sm font-medium text-gray-700">Виберіть станцію:</label>
                <select name="station" id="station" class="form-select mt-1 block w-full" required>
                    @foreach ($stations as $station)
                        <option value="{{ $station->id_station }}">{{ $station->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Згенерувати звіт
                </button>
            </div>
        </form>
        <h2  class="text-xl font-semibold mb-4">Розробити візуалізацію у табличному та графічному виглядах кількості
вимірювань, які відносяться до категорій оптимальних значень для
Якісті повітря.</h2>

        <form action="{{ route('data_visualization.3') }}" method="GET" class="space-y-4">
            @csrf

            <div class="mb-4">
                <label for="station" class="block text-sm font-medium text-gray-700">Виберіть станцію:</label>
                <select name="station" id="station" class="form-select mt-1 block w-full" required>
                    @foreach ($stations as $station)
                        <option value="{{ $station->id_station }}">{{ $station->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Згенерувати звіт
                </button>
            </div>
        </form>
        <h2  class="text-xl font-semibold mb-4">Розробити візуалізацію у табличному та графічному виглядах кількості
 середньодобових вимірювань, які відносяться  до категорій оптимальних значень для
Якісті повітря.</h2>

        <form action="{{ route('data_visualization.4') }}" method="GET" class="space-y-4">
            @csrf

            <div class="mb-4">
                <label for="station" class="block text-sm font-medium text-gray-700">Виберіть станцію:</label>
                <select name="station" id="station" class="form-select mt-1 block w-full" required>
                    @foreach ($stations as $station)
                        <option value="{{ $station->id_station }}">{{ $station->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Згенерувати звіт
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
