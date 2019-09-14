<nav>
  <form action="" id="frmSearch">
    <input id="txtSearch" type="text" placeholder="search" name="search" maxlength="5" />
  </form>
  <div id="results"></div>
  <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="signup.php">Signup</a>
  <a href="profile.php">Profile</a>
</nav>

<script>
  const txtSearch = document.querySelector("#txtSearch");
  const theResults = document.querySelector("#results");

  txtSearch.addEventListener("input", function() {
    if (txtSearch.value.length == 0) {
      theResults.style.display = "none";
    } else {
      theResults.style.display = "block";
    }
  });

  // txtSearch.addEventListener("input", function() {
  //   if (txtSearch.value.length == 0) {
  //     document.querySelector("#txtSearch").classList.remove("error");
  //     document.querySelector("#results").style.display = "none";
  //     return;
  //   }
  //   if (txtSearch.value.length < 2) {
  //     document.querySelector("#txtSearch").classList.add("error");
  //     return;
  //   }
  // });

  txtSearch.addEventListener("input", () => {
    console.log("input event on");
    fetchDataForSearch();
  })

  function formToJson() {
    var formElement = document.querySelector("#frmSearch")[0],
      inputElements = formElement.getElementsByTagName("input"),
      jsonObject = {};
    for (var i = 0; i < inputElements.length; i++) {
      var inputElement = inputElements[i];
      jsonObject[inputElement.name] = inputElement.value;
    }
    return JSON.stringify(jsonObject);
  }

  let serializedForm = formToJson();




  function fetchDataForSearch() {
    fetch("api/api-search.php?search=" + txtSearch.value
        // ,
        //  {
        //     data: serializedForm
        //   }
      )
      .then(function(response) {
        return response.json();
      })
      .then(function(matches) {
        console.log({
          matches
        });
        theResults.textContent = "";
        matches.forEach(match => {
          let a = document.createElement("a");
          a.href = "property.php?id=" + match.id;
          a.textContent = match.zip + " " + match.address;
          let span = document.createElement("br");
          theResults.append(a, span);
        });
      });
  }

  function checkSearch() {
    if (document.querySelector("#txtSearch").value.length < 2) {
      document.querySelector("#txtSearch").classList.add("error");
    }
    // console.log("checking search");
  }
</script>