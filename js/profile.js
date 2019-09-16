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
  console.log("we are inside change image");
  let div = document.querySelector("#imgProfile");
  div.style.backgroundImage = "url('img/" + userObject.img + "')";
}

const sendEmailbtns = document.querySelectorAll(".sendPropertyByEmail");

if (sendEmailbtns) {
  sendEmailbtns.forEach(button => {
    button.addEventListener("click", () => {
      fetch("api/api-send-email.php?id=" + button.id, {
        method: "GET",
        headers: {
          "content-type": "application/x-www-form-urlencoded"
        }
      })
        .then(res => res.json())
        .then(response => {
          console.log(response);
          showNotification(
            "Email is sent",
            "Your saved property is in your mailbox!"
          );
        });
    });
  });
}

function formToJsonUpdate() {
  var formElement = document.querySelector("#formUpdate"),
    inputElements = formElement.getElementsByTagName("input"),
    jsonObject = {};
  console.log({ formElement, inputElements });
  for (var i = 0; i < inputElements.length; i++) {
    var inputElement = inputElements[i];
    jsonObject[inputElement.name] = inputElement.value;
  }
  return JSON.stringify(jsonObject);
}

function showNotification(title, text) {
  let div = document.createElement("div");
  div.classList.add("overlay");
  let div1 = document.createElement("div");
  div1.classList.add("popup");
  let h2 = document.createElement("h2");
  h2.textContent = title;
  let closingTag = document.createElement("a");
  closingTag.classList.add("close");
  closingTag.addEventListener("click", () => {
    document.querySelector(".overlay").style.display = "none";
    document.location.reload(true);
  });
  closingTag.innerHTML = "&times;";
  let divText = document.createElement("div");
  divText.classList.add("content");
  divText.textContent = text;
  div1.append(h2, closingTag, divText);
  console.log({ div1 });
  div.append(div1);
  console.log({ div });
  let nav = document.querySelector("nav");
  console.log({ nav });
  nav.append(div);
}

let uploadBtn = document.querySelector("#uploadBtnProperty");

let urlUpload = "api/api-upload-property.php";
if (uploadBtn) {
  uploadBtn.addEventListener("click", e => {
    e.preventDefault();
    console.log("test");
    console.log("upload button clicked");
    // let serializedFormUpdate = formToJsonUpdate();
    let formUpload = document.querySelector("#formGridUpload");
    console.log({ formUpload });
    let formUploadData = new FormData(formUpload);
    console.log({ formUploadData });
    // console.log({ serializedFormUpdate });
    fetch(urlUpload, {
      method: "POST",
      body: formUploadData
    })
      .then(res => {
        console.log({ res });
        return res.json();
      })
      .then(response => {
        console.log(response);
        // response = JSON.stringify(response);

        showNotification(
          "Property is uploaded",
          "Your new listing will appear in your properties in a moment"
        );
      });
  });
}

function deleteProperty(id) {
  console.log("id i want to delete is", id);
}
