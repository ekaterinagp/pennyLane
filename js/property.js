// let detailsLink = document.querySelector("#detailsBtn");

// detailsLink.addEventListener("click", () => {});

// let url = window.location.href;
// console.log({ url });
// var lastChar = url[url.length - 13];
// console.log({ lastChar });
// function fetchData() {
//   fetch(url)
//     .then(function(response) {
//       return response.json();
//     })
//     .then(function(response) {
//       console.log({ response });
//       // fillInMarkers(response);
//     });
// }

// fetchData();

let urlParams = new URLSearchParams(window.location.search);

let id = urlParams.get("id");
console.log("i want to get property with id: " + id);

function fetchData() {
  fetch("data/properties.json")
    .then(function(response) {
      return response.json();
    })
    .then(function(response) {
      console.log({ response });
      fillInData(response);
    });
}

fetchData();

function fillInData(data) {
  data.forEach(property => {
    if (id == property.id) {
      console.log({ property });
      let address = document.querySelector("#addressProperty");
      address.textContent =
        "Address" + " " + property.street + " " + property.number;
      let zip = document.querySelector("#zipProperty");
      zip.textContent = "Zipcode" + " " + property.zip;
      let price = document.querySelector("#priceProperty");
      price.textContent = "Price" + " " + property.price + "" + "dkk";
      let size = document.querySelectorAll("#sizeProperty");
      size.textContent = property.size + " " + "m2";
      let beds = document.querySelector("#bedsProperty");
      beds.textContent = property.bed + " beds";
      let baths = document.querySelector("#bathsProperty");
      baths.textContent = property.bath + " bath(s)";

      if (property.img.length > 1) {
        console.log(property.img);
        for (let i = 1; i < property.img.length; i++) {
          let imgTag = document.createElement("img");

          imgTag.setAttribute("src", "img/" + property.img[i]);
          document.querySelector("#otherImages").append(imgTag);
        }
      }
      let img = document.querySelector(".mainImage");
      img.setAttribute("src", "img/" + property.img[0]);
    }
  });
}
