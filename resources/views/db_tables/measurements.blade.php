<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Measurements</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-3 px-4 border-b">ID Measurement</th>
                    <th class="py-3 px-4 border-b">Measurement Time</th>
                    <th class="py-3 px-4 border-b">Measurement Value</th>
                    <th class="py-3 px-4 border-b">Compression Level</th>
                    <th class="py-3 px-4 border-b">ID Station</th>
                    <th class="py-3 px-4 border-b">ID Measured Unit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($measurements as $measurement)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-4 border-b">{{ trim($measurement->id_measurment) }}</td>
                        <td class="py-3 px-4 border-b">{{ $measurement->measurement_time }}</td>
                        <td class="py-3 px-4 border-b">{{ $measurement->measurement_value }}</td>
                        <td class="py-3 px-4 border-b">{{ $measurement->compression_level ?? 'N/A' }}</td>
                        <td class="py-3 px-4 border-b">{{ trim($measurement->id_station) }}</td>
                        <td class="py-3 px-4 border-b">{{ $measurement->id_measured_unit }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
