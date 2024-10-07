<x-app-layout>
    <h1>Measured Units</h1>
    <ul>
        @foreach($measuredUnits as $unit)
            <li>ID: {{ $unit->id_measured_unit }}</li>
            <li>Unit: {{ $unit->unit }}</li>
        @endforeach
    </ul>
</x-app-layout>
