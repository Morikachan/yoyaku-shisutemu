let modal = window.document.getElementById("modal");
let h1 = document.getElementById("h1");
let button = document.getElementById("modalBtn");

button.addEventListener("click", insertConfirm);

function insertConfirm() {
  fetch("registration-db-log.php", {
    method: "POST",
  })
    .then((response) => response.json())
    .then((responseData) => {
      if (responseData.status === true) {       
        modalDisplay = window.getComputedStyle(modal, null).getPropertyValue('display');
        alert(modal);
        modal.style.display = 'block';
      } else {
        alert("失敗発生");
      }
    });
    

}
