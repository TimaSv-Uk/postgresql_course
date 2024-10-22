  @push('leaflet-style')
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  @endpush
  @push('leaflet-script')
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script type="text/javascript" src="{{ asset('map.js') }}"></script>
  @endpush
