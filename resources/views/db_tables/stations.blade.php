<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Stations</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-3 px-4 border-b">ID Station</th>
                    <th class="py-3 px-4 border-b">City</th>
                    <th class="py-3 px-4 border-b">Name</th>
                    <th class="py-3 px-4 border-b">Status</th>
                    <th class="py-3 px-4 border-b">ID Server</th>
                    <th class="py-3 px-4 border-b">ID Saveecobot</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stations as $station)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-4 border-b">{{ $station->id_station }}</td>
                        <td class="py-3 px-4 border-b">{{ $station->city }}</td>
                        <td class="py-3 px-4 border-b">{{ $station->name }}</td>
                        <td class="py-3 px-4 border-b">{{ $station->status }}</td>
                        <td class="py-3 px-4 border-b">{{ $station->id_server ?? 'N/A' }}</td>
                        <td class="py-3 px-4 border-b">{{ trim($station->id_saveecobot) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
