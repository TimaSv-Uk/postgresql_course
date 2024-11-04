<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex flex-col gap-4 p-6 m-6 border border-gray-300 rounded-lg shadow-md bg-white ">
        <h1 class="text-2xl font-semibold mb-4">Navigate to:</h1>
        <a href="{{ url('/measured-units') }}" class="text-blue-500 hover:text-blue-700 transition duration-200">Visit Measured Units</a>
        <a href="{{ url('/stations') }}" class="text-blue-500 hover:text-blue-700 transition duration-200">Visit Stations</a>
        <a href="{{ url('/mqtt-servers') }}" class="text-blue-500 hover:text-blue-700 transition duration-200">Visit MQTT Servers</a>
        <a href="{{ url('/optimal-values') }}" class="text-blue-500 hover:text-blue-700 transition duration-200">Visit Optimal Values</a>
        <a href="{{ url('/measurements') }}" class="text-blue-500 hover:text-blue-700 transition duration-200">Visit Measurements</a>
        {{--<a href="{{ url('/categories') }}" class="text-blue-500 hover:text-blue-700 transition duration-200">Visit Categories</a>--}}
        {{--<a href="{{ url('/favorite-stations') }}" class="text-blue-500 hover:text-blue-700 transition duration-200">Visit Favorite Stations</a>--}}
        {{--<a href="{{ url('/mqtt-units') }}" class="text-blue-500 hover:text-blue-700 transition duration-200">Visit MQTT Units</a>--}}
        {{--<a href="{{ url('/coordinates') }}" class="text-blue-500 hover:text-blue-700 transition duration-200">Visit Coordinates</a>--}}
    </div>
      <div class="w-[80vw] bg-primary rounded-[10px] p-4 sm:p-6 lg:p-8 lg:sticky lg:top-0 h-screen">
        @include('components.map.map_show', ['coordinates' => $coordinates])
      </div>
</x-app-layout>
