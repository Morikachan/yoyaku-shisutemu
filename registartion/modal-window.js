let modal = document.getElementById("modal");

function insertConfirm() {
      fetch('registration-confirm.php', {
        method: 'POST',
      })
      .then(response => response.text())
      .then(text => {
        if(text === 'true') {
          modal.style.display = "block";
        }else {
          alert("Error")
        }
      })
}
