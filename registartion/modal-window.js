let modal = document.getElementById("modal");
let button = document.getElementById("modalBtn");

button.addEventListener("click", insertConfirm);

function insertConfirm() {
console.log("Hello!")

      fetch('registration-confirm.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(text => {
        console.log(true);
        console.log(text);
        if(text === 'true') {
          modal.style.display = "block";
        }else {
          console.log(false);
        }
      })
}