let body = document.getElementsByTagName("body");
let modal = window.document.getElementById("modal");
let button = document.getElementById("modalBtn");

button.addEventListener("click", insertConfirm);

function insertConfirm() {
  fetch("registration-db-log.php", {
    method: "POST",
  })
    .then((response) => response.json())
    .then((responseData) => {
      if (responseData.status === true) {
        body[0].style.overflow = 'hidden';
        modal.style.display = 'block';
      } else {
        alert("失敗発生");
      }
    });
    

}
