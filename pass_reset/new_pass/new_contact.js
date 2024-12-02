const reset_pass = document.getElementById('reset_pass');
const repeat_pass = document.getElementById('reset_pass');
const alert_message1 =document.querySelector('.alert_message1');
const alert_message2 =document.querySelector('.alert_message2');
reset_pass.addEventListener('input', function pass(event) {
    newPass();
});
repeat_pass.addEventListener('input', function pass(event){
    newPass();
});
function newPass(){
    if(reset_pass != '' || repeat_pass != ''){
        alert_message1.classList.remove('active');
        alert_message2.classList.remove('active');
        alert(1);
    } else if(reset_pass != repeat_pass) {
        alert_message2.classList.add('active');
        alert(2);
    } else {
        alert_message1.classList.add('active');
        alert(3);
    }
}

