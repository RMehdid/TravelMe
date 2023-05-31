function showForm() {
    var x = document.getElementById("new-city-content");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
}

function submitForm(event) {
  event.preventDefault(); // Prevent the form from submitting normally

  // Make an AJAX request to the PHP script
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Handle the response from the PHP script
      console.log(this.responseText);
    }
  };
  xhttp.open("POST", "add_city.php", true);
  xhttp.send(new FormData(event.target));
}

function search() {
    
}