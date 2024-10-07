<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">MQTT Units</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-3 px-4 border-b">ID Station</th>
                    <th class="py-3 px-4 border-b">ID Measured Unit</th>
                    <th class="py-3 px-4 border-b">Message</th>
                    <th class="py-3 px-4 border-b">Order</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mqttUnits as $unit)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-4 border-b">{{ trim($unit->id_station) }}</td>
                        <td class="py-3 px-4 border-b">{{ $unit->id_measured_unit }}</td>
                        <td class="py-3 px-4 border-b">{{ $unit->message }}</td>
                        <td class="py-3 px-4 border-b">{{ $unit->Order }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

