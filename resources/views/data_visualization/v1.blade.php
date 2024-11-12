<x-app-layout>

    <div class="flex flex-col gap-4 p-6 m-6 border border-gray-300 rounded-lg shadow-md bg-white">

        <h1 class="text-2xl font-semibold mb-4">Розробити візуалізацію у табличному та графічному виглядах
максимальних значень шкідливих частинок PM2.5, PM10 в розрізі
областей за {{$start_time}} - {{$end_time}}</h1>

        <div class="w-[800px]">
        <canvas id="myChart"></canvas>
        </div>
        <h1 class="text-xl font-semibold mb-4">Change time period:</h1>

            <form action="{{ route('data_visualization.1') }}" method="GET" class="space-y-4">
                @csrf

                <div class="mb-4">
                    <label for="start_time" class="block text-sm font-medium text-gray-700">Початкова дата та час:</label>
                    <input type="datetime-local" name="start_time" id="start_time" class="form-input mt-1 block w-full" required value="{{ old('start_time', '2021-08-02T16:04') }}">
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
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');
  const station_max = @json($station_max);
  console.log(station_max)
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: station_max.map((st)=>st.name),
      datasets: [{
        label: 'Max particull speed',
        data: station_max.map((st)=>st.max_value),
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
</x-app-layout>
