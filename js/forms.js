let signUpForm = document.querySelector("#signupForm");
let allInputs = signUpForm.querySelectorAll("input");

allInputs.forEach(input => {
  input.addEventListener("input", function() {
    // console.log(form.checkValidity());
    if (signUpForm.checkValidity()) {
      signUpForm.querySelector("button").removeAttribute("disabled");
    } else {
      signUpForm.querySelector("button").setAttribute("disabled", true);
    }
  });
});

function fvIsEmailAvailable(oElement) {
  console.log({ oElement });
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (re.test(String(oElement.value).toLowerCase())) {
    // oElement.classList.add('error')
    fvGet(
      "api/api-is-user-registered.php?email=" + oElement.value,
      "",
      function(sData) {
        console.log({ sData });
        var jData = JSON.parse(sData);
        console.log({ jData });
        if (jData) {
          // console.log('error')
          document.querySelector("#emailDiv").innerText =
            "email already registered";
          oElement.setCustomValidity("Invalid field.");
          oElement.classList.add("error");
          signUpForm.querySelector("button").setAttribute("disabled", true);
          return;
        }
        // console.log('ok')
        oElement.setCustomValidity("");
        document.querySelector("#emailDiv").innerText =
          "email available for registration";
        oElement.classList.remove("error");
        signUpForm.querySelector("button").removeAttribute("disabled");
      }
    );
  }
  // else {
  //   // not valid email yet
  //   document.querySelector("#emailDiv").innerText = "email";
  //   oElement.classList.remove("error");
  // }
}

function fvGet(sUrl, sHeader, fCallback) {
  var ajax = new XMLHttpRequest();
  ajax.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      fCallback(ajax.responseText);
    } else if (this.readyState == 4 && this.status != 200) {
      // console.log( this.status )
    }
  };
  ajax.open("GET", sUrl, true);
  if (sHeader == "x-partial") {
    ajax.setRequestHeader("X-PARTIAL", "YES");
  }
  ajax.send();
}
