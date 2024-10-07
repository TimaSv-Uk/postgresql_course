<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Favorite Stations</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-3 px-4 border-b">User ID</th>
                    <th class="py-3 px-4 border-b">Station ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach($favoriteStations as $station)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-4 border-b">{{ $station->id_user }}</td>
                        <td class="py-3 px-4 border-b">{{ $station->id_station }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
