<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Coordinates</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-3 px-4 border-b">ID Coordinate</th>
                    <th class="py-3 px-4 border-b">ID Station</th>
                    <th class="py-3 px-4 border-b">Longitude/Latitude</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coordinates as $coordinate)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-4 border-b">{{ $coordinate->id_coordinate }}</td>
                        <td class="py-3 px-4 border-b">{{ trim($coordinate->id_station) }}</td>
                        <td class="py-3 px-4 border-b">{{ trim($coordinate->lonlat) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
