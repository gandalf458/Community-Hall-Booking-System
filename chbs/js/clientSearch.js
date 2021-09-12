const s = document.querySelector("#searchText"),
  r = document.querySelector("#search-result"),
  formData = new FormData();
s.addEventListener("keyup", function() {
  formData.append("search_name", s.value);
  fetch("getClient.php", {
    method: "POST",
    body: formData
  })
  .then (response => response.text())
  .then (text => r.innerHTML = text)
});
