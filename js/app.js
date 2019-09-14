init();

mapboxgl.accessToken =
  "pk.eyJ1IjoiZWthdGVyaW5hZ3AiLCJhIjoiY2swYzVlZzN5MDRwejNlbXUwaWJjYnhzMSJ9.ad2I9a9Kg_1J78hh4WA9rA";
var map = new mapboxgl.Map({
  container: "map",
  center: [12.55505, 55.704001], // starting position
  zoom: 10, // starting zoom
  style: "mapbox://styles/ekaterinagp/ck0c6kwbx02us1cqe0vcj6zti"
});
map.addControl(new mapboxgl.NavigationControl());

function fetchData() {
  fetch("data/properties.json")
    .then(function(response) {
      return response.json();
    })
    .then(function(response) {
      console.log({ response });
      fillInMarkers(response);
    });
}

function fillInMarkers(properties) {
  for (let i = 0; i < properties.length; i++) {
    console.log(properties[i]);
    var el = document.createElement("a");
    el.href = "#V-" + properties[i].id;
    el.className = "marker";
    // el.style.backgroundImage = "url(img/6.jpg)";
    el.style.backgroundColor = "red";
    el.style.width = "30px";
    el.style.height = "30px";
    el.id = properties[i].id;
    console.log({ properties });
    console.log(properties[i].marker.geometry.coordinates);
    new mapboxgl.Marker(el)
      .setLngLat(properties[i].marker.geometry.coordinates)
      .addTo(map);

    el.addEventListener("click", function() {
      console.log(`Highlight property with ID ${this.id} `);

      removeActive();
      document.getElementById(this.id).classList.add("active");
      document.getElementById("V-" + this.id).classList.add("active");
    });
  }
}

function removeActive() {
  document.querySelectorAll(".active").forEach(name => {
    name.classList.remove("active");
  });
}

function fetchSessionUser() {
  return new Promise((resolve, reject) => {
    let url = "api/api-get-session.php";
    fetch(url)
      .then(function(response) {
        return response.json();
      })
      .then(function(response) {
        console.log({ response });
        resolve(response);
      });
  });
}

let like = document.querySelectorAll("svg");

function addLike(user) {
  like.forEach(oneLike => {
    oneLike.addEventListener("click", () => {
      console.log(oneLike.id);
      if (user.userType == "agent") {
        let divNotification = document.createElement("div");
        divNotification.classList.add("notification");
        let p = document.createElement("p");
        p.textContent = "Only non-professionals can save items";
        divNotification.append(p);
        divNotification.style.display = "block";
        document.querySelector("#properties").append(divNotification);
        setTimeout(() => {
          divNotification.style.display = "none";
        }, 3000);
      }
      fetch("api/api-user-liked.php?id=" + oneLike.id)
        .then(function(response) {
          return response.json();
        })
        .then(function(response) {
          // console.log({ response });
          if (response.message == "Added") {
            oneLike.classList.add("forPath");
          } else {
            oneLike.classList.remove("forPath");
          }
        });
    });
  });
}

function checkIfLiked(user) {
  if (user.userType == "agent") {
    return;
  }
  let svgsForLikes = document.querySelectorAll("svg");
  let usersLikes = user.liked;
  console.log({ usersLikes });
  console.log({ svgsForLikes });
  usersLikes.forEach(like => {
    svgsForLikes.forEach(svgLike => {
      if (like == svgLike.id) {
        console.log("there is a match", like);
        svgLike.classList.add("forPath");
      }
    });
  });
}

async function init() {
  fetchData();
  userInSession = await fetchSessionUser();

  checkIfLiked(userInSession);
  addLike(userInSession);
}
