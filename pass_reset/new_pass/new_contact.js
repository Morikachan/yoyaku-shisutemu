const reset_pass = document.getElementById('reset_pass');
const repeat_pass = document.getElementById('repeat_pass');
const alert_message =document.querySelector('.alert_message');
const alert_message2 =document.querySelector('.alert_message2');
const body = document.querySelector("body");
const button = document.getElementById('sendButton');
const input = document.querySelector('.input');
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
    const countPass = resetValue.length;
    const countPass2 = repeat_pass.length;
    console.log(repeatValue);
    console.log(resetValue);
    if(resetValue && repeatValue){
        if(resetValue === repeatValue){
            if((countPass < 8 )||(countPass2 < 8)){
                //８文字以下の場合
                alert_message2.classList.add('active');
                input.classList.add('active');
                button.style.backgroundColor = '#888888';
                button.style.color = '#000000';
                button.disabled = true;
            } else {

            //一致した場合
            alert_message.classList.remove('active');
            alert_message2.classList.remove('active');
            input.classList.remove('active');
            button.style.backgroundColor = '#CF220E';
            button.style.color = '#ffffff';
            button.disabled = false;
            }
        } else {
           
            //不一致の場合
            alert_message.classList.add('active');
            input.classList.add('active');
            button.style.backgroundColor = '#888888';
            button.style.color = '#000000';
            button.disabled = true;
        }
    } else  {
        
        //例外処理
        button.style.backgroundColor = '#888888';
        button.style.color = '#000000';
        button.disabled = true;
    }
    
}
