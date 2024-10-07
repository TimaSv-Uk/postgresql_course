
<x-app-layout>
    <h1>Optimal Values</h1>
    <ul>
        @foreach($optimalValues as $value)
            <li>Category ID: {{ $value->id_category }}</li>
            <li>Measured Unit ID: {{ $value->id_measured_unit }}</li>
            <li>Optimal Range: {{ $value->optimal_range }}</li>
        @endforeach
    </ul>
</x-app-layout>
