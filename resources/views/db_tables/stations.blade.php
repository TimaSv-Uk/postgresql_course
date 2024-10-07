
<x-app-layout>
    <h1>Stations</h1>
    <ul>
        @foreach($stations as $station)
            <li>ID: {{ $station->id_station }}</li>
            <li>Name: {{ $station->name }}</li>
        @endforeach
    </ul>
</x-app-layout>
