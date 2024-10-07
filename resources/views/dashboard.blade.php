<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <a href="{{ url('/categories') }}">Visit Categories</a><br>
    <a href="{{ url('/favorite-stations') }}">Visit Favorite Stations</a><br>
    <a href="{{ url('/measured-units') }}">Visit Measured Units</a><br>
    <a href="{{ url('/stations') }}">Visit Stations</a><br>
    <a href="{{ url('/mqtt-servers') }}">Visit MQTT Servers</a><br>
    <a href="{{ url('/optimal-values') }}">Visit Optimal Values</a><br>
</x-app-layout>
