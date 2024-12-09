const body = document.querySelector("body");
const modal = document.querySelector("#modal");
const button = document.querySelector("#modalBtn");

button.addEventListener("click", insertConfirm);

function insertConfirm() {
  fetch("registration-db-log.php", {
    method: "POST",
  })
    .then((response) => response.json())
    .then((responseData) => {
      if (responseData.status === true) {
        body.style.overflow = 'hidden';
        modal.style.display = 'block';
      } else {
        alert("失敗発生");
      }
    });
    

}
