<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">MQTT Servers</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-3 px-4 border-b">ID Server</th>
                    <th class="py-3 px-4 border-b">URL</th>
                    <th class="py-3 px-4 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mqttServers as $server)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-4 border-b">{{ trim($server->id_server) }}</td>
                        <td class="py-3 px-4 border-b">{{ $server->url }}</td>
                        <td class="py-3 px-4 border-b">{{ trim($server->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
