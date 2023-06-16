function search() {
    var continent = document.getElementById('continent').value;
    var site = document.getElementById('site').value;
    var pays = document.getElementById('pays').value;
    var ville = document.getElementById('ville').value;
  
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'search.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Update the page content with the response
        document.getElementById('search-results').innerHTML = xhr.responseText;
      }
    };
    xhr.send('continent=' + continent + '&site=' + site + '&pays=' + pays + '&ville=' + ville);
  }