@include('components.map.map_script_style')
<div class="w-96 h64"></div>
<div id="map" style="height: 500px; ">
  @foreach ($coordinates as $coordinate)
  <div class="marker text-white" data-lat="{{ $coordinate->getLat(); }}" data-lng="{{ $coordinate->getLon(); }}"
    data-title="{{ $coordinate->id_station }}" data-sport="{{ $coordinate->id_station }}"></div>
  @endforeach
</div>
