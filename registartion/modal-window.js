let modal = document.getElementById("modal");
let button = document.getElementById("modalBtn");

button.addEventListener("click", insertConfirm);

function insertConfirm() {
  fetch("registration-confirm.php", {
    method: "POST",
  })
    .then((response) => response.json())
    .then((responseData) => {
      if (responseData.status === "true") {
        modal.style.display = "block";
      } else {
        // alert("データベース接続に失敗発生");
        alert("失敗発生");
      }
    });
}
