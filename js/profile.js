const url = "api/api-upload-one-image.php";
const formToUpload = document.querySelector("#uploadImg");

formToUpload.addEventListener("submit", e => {
  e.preventDefault();

  const file = document.querySelector("[type=file]").files[0];
  const formData = new FormData();
  formData.append("img", file);

  fetch(url, {
    method: "POST",
    body: formData
  })
    .then(res => res.json())
    .then(response => {
      console.log(response);
      changeImage(response);
    });
});

function changeImage(userObject) {
  let img = document.querySelector("#imgProfile");
  img.setAttribute("src", "img/" + userObject.img);
}

const sendEmailbtn = document.querySelector("#sendEmail");

sendEmailbtn.addEventListener("click", () => {
  fetch("api/api-send-email.php", {
    method: "POST",
    headers: {
      "content-type": "application/x-www-form-urlencoded"
    }
  })
    .then(res => res.json())
    .then(response => {
      console.log(response);
      // changeImage(response);
    });
});
