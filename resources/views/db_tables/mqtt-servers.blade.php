
<x-app-layout>
    <h1>MQTT Servers</h1>
    <ul>
        @foreach($mqttServers as $server)
            <li>ID: {{ $server->id_server }}</li>
            <li>Address: {{ $server->address }}</li>
        @endforeach
    </ul>
</x-app-layout>
