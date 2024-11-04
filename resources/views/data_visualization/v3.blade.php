<x-app-layout>
    <div class="flex flex-col gap-4 p-6 m-6 border border-gray-300 rounded-lg shadow-md bg-white">
        <h1 class="text-2xl font-semibold mb-4">Розробити візуалізацію у табличному та графічному виглядах кількості
вимірювань, які відносяться до категорій оптимальних значень для
діоксиду сірки.: {{$selected_station->name}}</h1>


            <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead >
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-3 px-4 border-b">Category</th>
                    <th class="py-3 px-4 border-b">Measurement Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($optimal_value_counts as $valueCount)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-4 border-b">{{ $valueCount[0]->designation }}</td>
                        <td class="py-3 px-4 border-b">{{ $valueCount[1] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        </div>
        <div class="w-full">
        <canvas id="myChart"></canvas>
        </div>
        <form action="{{ route('data_visualization.3') }}" method="GET" class="space-y-4">

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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');
  const optimal_value_counts = @json($optimal_value_counts);
  console.log(optimal_value_counts)
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: optimal_value_counts.map((st)=>st[0].designation),
      datasets: [{
        label: 'Optimal measurement count',
        data: optimal_value_counts.map((st)=>st[1]),
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

