const reset_pass = document.getElementById('reset_pass');
const repeat_pass = document.getElementById('repeat_pass');
const alert_message =document.querySelector('.alert_message');
const button = document.getElementById('sendButton');
button.style.backgroundColor = '#888888';
button.style.color = '#000000';

reset_pass.addEventListener('change', function pass(event) {
    newPass();
});
repeat_pass.addEventListener('change', function pass(event){
    newPass();
});
function newPass(){

    const repeatValue = repeat_pass.value;
    const resetValue = reset_pass.value;
    if(resetValue && repeatValue){
        if(resetValue !== repeatValue){
            //不一致の場合
            alert_message.classList.add('active');
            button.style.backgroundColor = '#888888';
            button.style.color = '#000000';
            button.disabled = true;
        } else {
            //一致した場合
            alert_message.classList.remove('active');
            button.style.backgroundColor = '#CF220E';
            button.style.color = '#ffffff';
            button.disabled = false;
        }
    } else  {
        //例外処理
        button.style.backgroundColor = '#888888';
        button.style.color = '#000000';
        button.disabled = true;
    }
    
}
