function insertConfirm() {
      fetch('registration-confirm.php', {
        method: 'POST',
      })
      .then(response => response.text())
      .then(text => {
        if(text === 'true') {
          
        }else {
          alert("Error")
        }
      })
}

// Получить модальный
let modal = document.getElementById("modal");
// Получить кнопку, которая открывает модальный
let btn = document.getElementById("modalBtn");

btn.onclick = function() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}