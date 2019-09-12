// function addImage() {
//   let addImageBtn = document.querySelector("#uploadImg");
//   addImageBtn.addEventListener("click", () => {
//     // fetch("api/api-upload-one-image.php")
//     //   .then(function(response) {
//     //     return response.json();
//     //   })
//     //   .then(function(myJson) {
//     //     console.log(JSON.stringify(myJson));
//     //   });
//   });
// }

// fetch("api/api-upload-one-image.php")
//   .then(function(response) {
//     return response.json();
//   })
//   .then(function(myJson) {
//     console.log(myJson);
//   });

const url = "api/api-upload-one-image.php";
const formToUpload = document.querySelector("#uploadImg");

formToUpload.addEventListener("submit", e => {
  e.preventDefault();

  const files = document.querySelector("[type=file]").files;
  const formData = new FormData();

  for (let i = 0; i < files.length; i++) {
    let file = files[i];

    formData.append("files[]", file);
  }

  fetch(url, {
    method: "POST",
    body: formData
  })
    .then(function(response) {
      console.log({ response });
      let dataJ = JSON.stringify(response);
      console.log({ dataJ });
    })
    .then(function(dataJ) {
      console.log(dataJ);
    });
});
