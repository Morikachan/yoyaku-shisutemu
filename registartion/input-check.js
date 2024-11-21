// ログイン情報
const mail = document.getElementById('mail');
const password = document.getElementById('password');
const checkPassword = document.getElementById('passwordCheck');

// 個人情報
const lastName = document.getElementById('lastName');
const firstName = document.getElementById('firstName');
const lastNameKana = document.getElementById('lastNameKana');
const firstNameKana = document.getElementById('firstNameKana');

// const genderMan = document.getElementById('genderMan');
// const genderWoman = document.getElementById('genderWoman');
const date = document.getElementById('date');
const course = document.getElementById('course');
const occupation = document.getElementById('occupation');
const school = document.getElementById('school');
const tel = document.getElementById('tel');
const zipcode = document.getElementById('zipcode');
const address2 = document.getElementById('address2');

const approve = document.getElementById('approved');


mail.addEventListener('focusout', () => {
    const mailError = document.getElementById('mailError');
    if (mail.value === "") {
        console.log(mail.value);
        mailError.style.display = 'inline-block';
        mailError.textContent = 'メールを入力してください';
        mail.style.backgroundColor = '#FF8989';
    } else {
        mailError.style.display = 'none';
        mail.style.backgroundColor = '#FFFFFF';
    }
})

password.addEventListener('focusout', () => {
    const passwordError = document.getElementById('passwordError');
    if (password.value === "") {
        passwordError.style.display = 'inline-block';
        passwordError.style.marginBottom = '20px';
        passwordError.textContent = 'パスワードを入力してください';
        password.style.backgroundColor = '#FF8989';
    } else {
        passwordError.style.display = 'none';
        password.style.backgroundColor = '#FFFFFF';
    }
})

checkPassword.addEventListener('focusout', () => {
    const passwordCheckError = document.getElementById('passwordCheckError');
    if (checkPassword.value === "") {
        passwordCheckError.style.display = 'inline-block';
        passwordCheckError.style.marginBottom = '20px';
        passwordCheckError.textContent = 'パスワード確認を入力してください';
        checkPassword.style.backgroundColor = '#FF8989';
    } else if(checkPassword.value !== password.value) {
        passwordCheckError.style.display = 'inline-block';
        passwordCheckError.style.marginBottom = '20px';
        passwordCheckError.textContent = 'パスワードとパスワード確認が違います';
        checkPassword.style.backgroundColor = '#FF8989';
    }
    else {
        passwordCheckError.style.display = 'none';
        checkPassword.style.backgroundColor = '#FFFFFF';
    }
})

lastName.addEventListener('focusout', () => {
    const nameError = document.getElementById('nameError');
    if (lastName.value === "") {
        nameError.style.display = 'inline-block';
        nameError.style.marginBottom = '20px';
        nameError.textContent = '氏名を入力してください';
        lastName.style.backgroundColor = '#FF8989';
    } else {
        nameError.style.display = 'none';
        lastName.style.backgroundColor = '#FFFFFF';
    }
})

firstName.addEventListener('focusout', () => {
    const nameError = document.getElementById('nameError');
    if (firstName.value === "") {
        nameError.style.display = 'inline-block';
        nameError.style.marginBottom = '20px';
        nameError.textContent = '氏名を入力してください';
        firstName.style.backgroundColor = '#FF8989';
    } else {
        nameError.style.display = 'none';
        firstName.style.backgroundColor = '#FFFFFF';
    }
})

lastNameKana.addEventListener('focusout', () => {
    const nameKanaError = document.getElementById('nameKanaError');
    if (lastNameKana.value === "") {
        nameKanaError.style.display = 'inline-block';
        nameKanaError.style.marginBottom = '20px';
        nameKanaError.textContent = '氏名（フリガナ）を入力してください';
        lastNameKana.style.backgroundColor = '#FF8989';
    } else {
        nameKanaError.style.display = 'none';
        lastNameKana.style.backgroundColor = '#FFFFFF';
    }
})
firstNameKana.addEventListener('focusout', () => {
    const nameKanaError = document.getElementById('nameKanaError');
    if (firstNameKana.value === "") {
        nameKanaError.style.display = 'inline-block';
        nameKanaError.style.marginBottom = '20px';
        nameKanaError.textContent = '氏名（フリガナ）を入力してください';
        firstNameKana.style.backgroundColor = '#FF8989';
    } else {
        nameKanaError.style.display = 'none';
        firstNameKana.style.backgroundColor = '#FFFFFF';
    }
})