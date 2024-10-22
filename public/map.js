var map = L.map("map").setView([50.4501, 30.5234], 10);
L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  maxZoom: 18,
  attribution:
    '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

var markers = document.querySelectorAll(".marker");
markers.forEach(function (markerElement) {
  var lat = markerElement.getAttribute("data-lat");
  var lng = markerElement.getAttribute("data-lng");
  var sport = markerElement.getAttribute("data-sport");
  var image = markerElement.getAttribute("data-image");
  var center = markerElement.getAttribute("data-center");
  var title = "ID Station: " + markerElement.getAttribute("data-title");

  var is_select_marker = markerElement.getAttribute("data-select");

  var iconSelect = L.icon({
    iconUrl: image,
    iconSize: [38, 95],
    iconAnchor: [22, 94],
    popupAnchor: [-3, -76],
    shadowSize: [68, 95],
    shadowAnchor: [22, 94],
  });
  if (is_select_marker === "true") {
    var marker = L.marker([lat, lng], {
      icon: iconSelect,
      alt: sport,
      draggable: true,
      autoPan: true,
    })
      .addTo(map)
      .bindPopup(sport);

    map.panTo(marker.getLatLng());
  } else {
    var marker = L.marker([lat, lng], { alt: title })
      .addTo(map)
      .bindPopup(title);
  }

  if (center === "true") {
    map.panTo(marker.getLatLng());
  }
  marker.on("click", function (ev) {
    map.panTo(marker.getLatLng());
  });

  marker.on("drag", function (event) {
    var lat = marker.getLatLng().lat;
    var lng = marker.getLatLng().lng;

    // Update form fields
    if (is_select_marker === "true") {
      document.getElementById("lat").value = lat;
      document.getElementById("lng").value = lng;
      var form_selected_position = document.getElementById("is_selected");
      form_selected_position.classList.remove("bg-error");

      // Add the new class
      form_selected_position.classList.add("bg-blue-500");
    }
  });
});

var point_cards = document.querySelectorAll("#point-card");

point_cards.forEach(function (point_card) {
  point_card.addEventListener("click", function () {
    var lat = point_card.getAttribute("data-lat");
    var lng = point_card.getAttribute("data-lng");
    map.setView([lat, lng], 18); // Change the map center
  });
});

