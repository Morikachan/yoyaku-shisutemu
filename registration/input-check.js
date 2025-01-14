// ログイン情報
const mail = document.getElementById("mail");
const password = document.getElementById("password");
const passwordCheck = document.getElementById("passwordCheck");

// 個人情報
const lastName = document.getElementById("lastName");
const firstName = document.getElementById("firstName");
const lastNameKana = document.getElementById("lastNameKana");
const firstNameKana = document.getElementById("firstNameKana");

const genders = document.querySelectorAll("input[type=radio]");
const date = document.getElementById("date");
const course = document.getElementById("course");
const occupation = document.getElementById("occupation");
const school = document.getElementById("school");
const tel = document.getElementById("tel");
const zipcode = document.getElementById("zipcode");
const address1 = document.getElementById("address1");
const address2 = document.getElementById("address2");

const approved = document.getElementById("approved");
const button = document.querySelector("button");

const registrationInfo = {
  mail: {
    element: mail,
    elementError: document.getElementById("mailError"),
    elementErrorText: "メールを入力してください",
  },
  password: {
    element: password,
    elementError: document.getElementById("passwordError"),
    elementErrorText: "パスワードを入力してください",
  },
  lastName: {
    element: lastName,
    elementError: document.getElementById("nameError"),
    elementErrorText: "氏名を入力してください",
  },
  firstName: {
    element: firstName,
    elementError: document.getElementById("nameError"),
    elementErrorText: "氏名を入力してください",
  },
  lastNameKana: {
    element: lastNameKana,
    elementError: document.getElementById("nameKanaError"),
    elementErrorText: "氏名（フリガナ）を入力してください",
  },
  firstNameKana: {
    element: firstNameKana,
    elementError: document.getElementById("nameKanaError"),
    elementErrorText: "氏名（フリガナ）を入力してください",
  },
  date: {
    element: date,
    elementError: document.getElementById("dateError"),
    elementErrorText: "誕生日を入力してください",
  },
  course: {
    element: course,
    elementError: document.getElementById("courseError"),
    elementErrorText: "学科を選んでください",
  },
  occupation: {
    element: occupation,
    elementError: document.getElementById("occupationError"),
    elementErrorText: "職業を選んでください",
  },
  school: {
    element: school,
    elementError: document.getElementById("schoolError"),
    elementErrorText: "出身学校を入れてください",
  },
  tel: {
    element: tel,
    elementError: document.getElementById("telError"),
    elementErrorText: "電話番号を入れてください",
  },
  zipcode: {
    element: zipcode,
    elementError: document.getElementById("addressError"),
    elementErrorText: "郵便番号を入れてください",
  },
  address1: {
    element: address1,
  },
  address2: {
    element: address2,
    elementError: document.getElementById("addressError"),
    elementErrorText: "住所情報を入れてください",
  },
};

const userInfo = {
  mail: null,
  password: null,
  passwordCheck: null,
  lastName: null,
  firstName: null,
  lastNameKana: null,
  firstNameKana: null,
  gender: null,
  date: null,
  course: null,
  occupation: null,
  school: null,
  tel: null,
  zipcode: null,
  address1: null,
  address2: null,
};

for (let registrationKey in registrationInfo) {
  registrationInfo[registrationKey].element.addEventListener("change", () => {
    userInfo[registrationKey] = null;
    approved.checked = false;
    button.disabled = true;
    button.textContent = "新規登録の情報を入力してください";
    if (registrationInfo[registrationKey].element.value === "") {
      registrationInfo[registrationKey].elementError.style.display =
        "inline-block";
      registrationInfo[registrationKey].elementError.textContent =
        registrationInfo[registrationKey].elementErrorText;
      registrationInfo[registrationKey].element.style.backgroundColor =
        "#FF8989";
    } else {
      userInfo[registrationKey] =
        registrationInfo[registrationKey].element.value;
      registrationInfo[registrationKey].elementError.style.display = "none";
      registrationInfo[registrationKey].element.style.backgroundColor =
        "#FFFFFF";
      inputInfoToLocalStorage();
    }
  });
}

passwordCheck.addEventListener("change", () => {
  const passwordCheckError = document.getElementById("passwordCheckError");
  if (passwordCheck.value !== password.value) {
    passwordCheckError.style.display = "inline-block";
    passwordCheckError.textContent = "パスワードとパスワード確認が違います";
    passwordCheck.style.backgroundColor = "#FF8989";
    button.disabled = true;
    button.textContent = "新規登録の情報を入力してください";
  } else {
    passwordCheckError.style.display = "none";
    passwordCheck.style.backgroundColor = "#FFFFFF";
    userInfo.passwordCheck = passwordCheck.value;
    inputInfoToLocalStorage();
  }
});

genders[0].addEventListener("change", () => {
  genderError.style.display = "none";
  userInfo.gender = true;
  localStorage.setItem('gender', true);
});
genders[1].addEventListener("change", () => {
  userInfo.gender = true;
  genderError.style.display = "none";
  localStorage.setItem('gender', true);
});

const inputInfoToLocalStorage = () => {
  for (let field in userInfo) {
    localStorage.setItem(field, userInfo[field]);
  }
}

const checkLocalStorage = () => {
  for (let registrationKey in registrationInfo) {
    if(localStorage.getItem(registrationKey) != "null") {
      registrationInfo[registrationKey].element.value = localStorage.getItem(registrationKey);
    }
    password.value = localStorage.getItem(password);
    passwordCheck.value = localStorage.getItem(password);
    userInfo.gender = localStorage.getItem('gender');
    userInfo[registrationKey] = localStorage.getItem(registrationKey);
  }
}
// checkboxの処理
approved.addEventListener("change", () => {
  console.log(userInfo);

  if (approved.checked) {
    if (!genders[0].checked || !genders[1].checked) {
      const genderError = document.getElementById("genderError");
      genderError.style.display = "inline-block";
      genderError.style.margin = "6px 0";
      genderError.textContent = "性別を入力してください";
    }
    button.disabled = false;
    button.textContent = "確認画面へ";
    for (let key in userInfo) {
      if (userInfo[key] === null || userInfo[key] === "") {
        button.disabled = true;
        button.textContent = "新規登録の情報を入力してください";
      }
    }
  } else {
    button.disabled = true;
    button.textContent = "新規登録の情報を入力してください";
  }
});

checkLocalStorage();