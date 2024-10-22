<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Stations</h1>

    <div class="overflow-x-auto">

      <div class="w-[80vw] bg-primary rounded-[10px] p-4 sm:p-6 lg:p-8 lg:sticky lg:top-0 h-screen">
        @include('components.map.map_show', ['coordinates' => $coordinates])
      </div>

    </div>
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-3 px-4 border-b">ID Station</th>
                    <th class="py-3 px-4 border-b">City</th>
                    <th class="py-3 px-4 border-b">Name</th>
                    <th class="py-3 px-4 border-b">Status</th>
                    <th class="py-3 px-4 border-b">Server url</th>
                    <th class="py-3 px-4 border-b">Coordinates</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stations as $station)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-4 border-b">{{ $station->id_station }}</td>
                        <td class="py-3 px-4 border-b">{{ $station->city }}</td>
                        <td class="py-3 px-4 border-b">{{ $station->name }}</td>
                        <td class="py-3 px-4 border-b">{{ $station->status }}</td>
                        <td class="py-3 px-4 border-b">{{ $station->mqtt_servers->url ?? 'N/A' }}</td>
                        <td class="py-3 px-4 border-b"><div>{{ trim($station->coordinates->getLat())  }}</div>/<div>{{ trim($station->coordinates->getLon())  }}</div></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

</x-app-layout>
