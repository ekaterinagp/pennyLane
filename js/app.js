mapboxgl.accessToken =
  "pk.eyJ1IjoiZWthdGVyaW5hZ3AiLCJhIjoiY2swYzVlZzN5MDRwejNlbXUwaWJjYnhzMSJ9.ad2I9a9Kg_1J78hh4WA9rA";
var map = new mapboxgl.Map({
  container: "map",
  center: [12.55505, 55.704001], // starting position
  zoom: 12, // starting zoom
  style: "mapbox://styles/ekaterinagp/ck0c6kwbx02us1cqe0vcj6zti"
});
map.addControl(new mapboxgl.NavigationControl());
