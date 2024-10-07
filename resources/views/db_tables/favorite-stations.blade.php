<x-app-layout>
    <h1>Favorite Stations</h1>
    <ul>
        @foreach($favoriteStations as $station)
            <li>User ID: {{ $station->id_user }}</li>
            <li>Station ID: {{ $station->id_station }}</li>
        @endforeach
    </ul>
</x-app-layout>
