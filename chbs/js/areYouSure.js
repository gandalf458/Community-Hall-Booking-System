(function() {
  const dfs = document.querySelectorAll(".btnDelete");
  for (let c = 0; c < dfs.length; c++) {
    dfs[c].addEventListener("click", function(e) {
      if (!confirm("Delete entry - Are you sure?"))
        e.preventDefault();
    });
  }
})();
