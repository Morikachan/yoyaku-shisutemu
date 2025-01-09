const reset_pass = document.getElementById('reset_pass');
const repeat_pass = document.getElementById('repeat_pass');
const alert_message =document.querySelector('.alert_message');
const alert_message2 =document.querySelector('.alert_message2');
const alert_message3 =document.querySelector('.alert_message3');
const body = document.querySelector("body");
const button = document.getElementById('sendButton');
const input = document.querySelector('.input');
const input2 = document.querySelector('.input2');
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
    const countPass2 = repeatValue.length;

    if(resetValue && repeatValue){
        if(((countPass >= 16) && (countPass2 >= 16)) && (resetValue === repeatValue)){
            //一致した場合
            alert_message.classList.remove('active');
            alert_message2.classList.remove('active');
            alert_message3.classList.remove('active');
            input.classList.remove('active');
            input2.classList.remove('active');
            button.style.backgroundColor = '#CF220E';
            button.style.color = '#ffffff';
            button.disabled = false;
        } else {
            //例外処理

            if((resetValue === repeatValue)){
                alert_message.classList.remove('active');
                
            } else {
                alert_message.classList.add('active');
              
            }

            if(((countPass >= 16) && (countPass2 >= 16))){
                alert_message2.classList.remove('active');
               
            } else {
                alert_message2.classList.add('active');
                
            }
            if(((countPass <= 64) && (countPass2 <= 64))){
                alert_message3.classList.remove('active');
            } else {
                alert_message3.classList.add('active');
            }
            
            input.classList.add('active');
            input2.classList.add('active');
            button.style.backgroundColor = '#888888';
            button.style.color = '#000000';
            button.disabled = true;
        }
    } else {
        //例外処理
        button.style.backgroundColor = '#888888';
        button.style.color = '#000000';
        button.disabled = true;
    }
    
}
