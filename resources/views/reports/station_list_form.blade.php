<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">

        <p class="mb-4">
            Список підключених станцій. У списку вказати назву станції, з якої дати вона була підключена, які параметри повітря надає. Врахувати, що у різних станціях можуть бути різні параметри.
        </p>

        <h2 class="text-lg font-bold mb-4">Генерація звіту</h2>
        <form action="{{ route('report.report1') }}" method="POST" class="space-y-4">
            @csrf

            <div class="mb-4">
                <label for="station" class="block text-sm font-medium text-gray-700">Виберіть станцію:</label>
                <select name="id_station" id="station" class="form-select mt-1 block w-full" required>
                    <option value="" disabled selected>Оберіть станцію</option>
                    @foreach($stations as $station)
                        <option value="{{ $station->id_station }}">{{ $station->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="format" class="block text-sm font-medium text-gray-700">Формат експорту:</label>
                <select name="export_format" id="format" class="form-select mt-1 block w-full" required>
                    <option value="" disabled selected>Оберіть формат</option>
                    <option value="xlsx">XLSX</option>
                    <option value="csv">CSV</option>
                    <option value="pdf">PDF</option>
                </select>
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Згенерувати звіт
                </button>
            </div>
        </form>

        <div class="container">
            <h2 class="text-lg font-bold mb-4">Звіт вимірювань станції за часовий період</h2>

            <form action="{{ route('report.results_from_station_by_tyme') }}" method="POST" class="space-y-4">
                @csrf

                <div class="mb-4">
                    <label for="station" class="block text-sm font-medium text-gray-700">Виберіть станцію:</label>
                    <select name="id_station" id="station" class="form-select mt-1 block w-full" required>
                        <option value="" disabled selected>Оберіть станцію</option>
                        @foreach($stations as $station)
                            <option value="{{ $station->id_station }}">{{ $station->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="start_time" class="block text-sm font-medium text-gray-700">Початкова дата та час:</label>
                    <input type="datetime-local" name="start_time" id="start_time" class="form-input mt-1 block w-full" required value="{{ old('start_time', '2022-08-02T16:04') }}">
                </div>

                <div class="mb-4">
                    <label for="end_time" class="block text-sm font-medium text-gray-700">Кінцева дата та час:</label>
                    <input type="datetime-local" name="end_time" id="end_time" class="form-input mt-1 block w-full" required value="{{ old('end_time', '2022-08-02T16:32') }}">
                </div>

                <div class="mb-4">
                    <label for="format" class="block text-sm font-medium text-gray-700">Формат експорту:</label>
                    <select name="export_format" id="format" class="form-select mt-1 block w-full" required>
                        <option value="" disabled selected>Оберіть формат</option>
                        <option value="xlsx">XLSX</option>
                        <option value="csv">CSV</option>
                        <option value="pdf">PDF</option>
                    </select>
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Згенерувати звіт
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
