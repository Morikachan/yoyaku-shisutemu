// ログイン情報
const mail = document.getElementById('mail');
const password = document.getElementById('password');
const passwordCheck = document.getElementById('passwordCheck');

// 個人情報
const lastName = document.getElementById('lastName');
const firstName = document.getElementById('firstName');
const lastNameKana = document.getElementById('lastNameKana');
const firstNameKana = document.getElementById('firstNameKana');

const genderMan = document.getElementById('genderMan');
const genderWoman = document.getElementById('genderWoman');
const date = document.getElementById('date');
const course = document.getElementById('course');
const occupation = document.getElementById('occupation');
const school = document.getElementById('school');
const tel = document.getElementById('tel');
const zipcode = document.getElementById('zipcode');
const address2 = document.getElementById('address2');

const approved = document.getElementById('approved');
const button = document.getElementsByTagName('button');

const registrationInfo = {
    'mail': {
        'element': mail,
        'elementError': document.getElementById('mailError'),
        'elementErrorText': 'メールを入力してください',
    },
    'password': {
        'element': password,
        'elementError': document.getElementById('passwordError'),
        'elementErrorText': 'パスワードを入力してください',
        },
    'passwordCheck': {
        'element': passwordCheck,
        'elementError': document.getElementById('passwordCheckError'),
        'elementErrorText': 'パスワード確認を入力してください',
        'pattern': {
            '': 'パスワード確認を入力してください',
            'checkWithPassword': 'パスワードとパスワード確認が違います',
        }
        },
    'lastName': {
        'element': lastName,
        'elementError': document.getElementById('nameError'),
        'elementErrorText': '氏名を入力してください',
    },
    'firstName': {
        'element': firstName,
        'elementError': document.getElementById('nameError'),
        'elementErrorText': '氏名を入力してください',
    },
    'lastNameKana': {
        'element': lastNameKana,
        'elementError': document.getElementById('nameKanaError'),
        'elementErrorText': '氏名（フリガナ）を入力してください',
    },
    'firstNameKana': {
        'element': firstNameKana,
        'elementError': document.getElementById('nameKanaError'),
        'elementErrorText': '氏名（フリガナ）を入力してください',
    },
    'date': {
        'element': date,
        'elementError': document.getElementById('dateError'),
        'elementErrorText': '誕生日を入力してください',
    },
    'school': {
        'element': school,
        'elementError': document.getElementById('schoolError'),
        'elementErrorText': '出身学校を入れてください',
    },
    'tel': {
        'element': tel,
        'elementError': document.getElementById('telError'),
        'elementErrorText': '電話番号を入れてください',
    },
    'zipcode': {
        'element': zipcode,
        'elementError': document.getElementById('addressError'),
        'elementErrorText': '郵便番号を入れてください',
    },
    'address2': {
        'element': address2,
        'elementError': document.getElementById('addressError'),
        'elementErrorText': '住所情報を入れてください',
    },
}

const userInfo = {
    'mail': null,
    'password': null,
    'passwordCheck': null,
    'lastName': null,
    'firstName': null,
    'lastNameKana': null,
    'firstNameKana': null,
    'gender': null,
    'date': null,
    'course': null,
    'occupation': null,
    'school': null,
    'tel': null,
    'zipcode': null,
    'address2': null,
}

for(let registrationKey in registrationInfo) {
    registrationInfo[registrationKey].element.addEventListener("focusout", () => {
        if (registrationInfo[registrationKey].element.value === "") {
            registrationInfo[registrationKey].elementError.style.display = 'inline-block';
            registrationInfo[registrationKey].elementError.textContent = registrationInfo[registrationKey].elementErrorText;
            registrationInfo[registrationKey].element.style.backgroundColor = '#FF8989';
        } else {
            userInfo[registrationKey] = registrationInfo[registrationKey].element.value;
            registrationInfo[registrationKey].elementError.style.display = 'none';
            registrationInfo[registrationKey].element.style.backgroundColor = '#FFFFFF';
        }
    })
}

// passwordCheck.addEventListener('focusout', () => {
//     const passwordCheckError = document.getElementById('passwordCheckError');
//     if(passwordCheck.value !== password.value) {
//         passwordCheckError.style.display = 'inline-block';
//         passwordCheckError.style.marginBottom = '20px';
//         passwordCheckError.textContent = 'パスワードとパスワード確認が違います';
//         passwordCheck.style.backgroundColor = '#FF8989';
//     }
//     // else {
//     //     passwordCheckError.style.display = 'none';
//     //     passwordCheck.style.backgroundColor = '#FFFFFF';
//     //     userInfo.passwordCheck = passwordCheck.value;
//     // }
// })

if (!genderMan.checked || !genderWoman.checked ) {
    const genderError = document.getElementById('genderError');
    genderError.style.display = 'inline-block';
    genderError.style.marginBottom = '20px';
    genderError.textContent = '性別を入力してください';
}
genderMan.addEventListener("change", () => {
    genderError.style.display = 'none';
    userInfo.gender = true;
})
genderWoman.addEventListener("change", () => {
    userInfo.gender = true;
    genderError.style.display = 'none';
})

course.addEventListener('focusout', () => {
    const courseError = document.getElementById('courseError');
    if (course.options[0].selected) {
        courseError.style.display = 'inline-block';
        courseError.style.marginBottom = '20px';
        courseError.textContent = '学科を選んでください';
        course.style.backgroundColor = '#FF8989';
    } else {
        courseError.style.display = 'none';
        course.style.backgroundColor = '#FFFFFF';
        userInfo.course = course.value;
    }
})

occupation.addEventListener('focusout', () => {
    const occupationError = document.getElementById('occupationError');
    if (occupation.options[0].selected) {
        occupationError.style.display = 'inline-block';
        occupationError.style.marginBottom = '20px';
        occupationError.textContent = '職業を選んでください';
        occupation.style.backgroundColor = '#FF8989';
    } else {
        occupationError.style.display = 'none';
        occupation.style.backgroundColor = '#FFFFFF';
        userInfo.occupation = occupation.value;
    }
})

// checkboxの処理
approved.addEventListener("change", () => {
    console.log(userInfo);
    
    if(approved.checked) {
        button[0].disabled = false;
        button[0].textContent = '確認画面へ';
        for(let key in userInfo) {
            if(userInfo[key] === null || userInfo[key] === "") {
                button[0].disabled = true;
                button[0].textContent = '新規登録の情報を入力してください';
            }
        }
    } else {
        button[0].disabled = true;
        button[0].textContent = '新規登録の情報を入力してください';
    }
});