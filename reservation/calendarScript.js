const months = [
  "1月",
  "2月",
  "3月",
  "4月",
  "5月",
  "6月",
  "7月",
  "8月",
  "9月",
  "10月",
  "11月",
  "12月",
];

const days = ["日", "月", "火", "水", "木", "金", "土"];

const daysContainer = document.querySelector(".days");
const nextBtn = document.querySelector(".next");
const prevBtn = document.querySelector(".prev");
const month = document.querySelector(".month");
const time = document.querySelector("#day-time");

const date = new Date();
let activeDay;
let currentMonth = date.getMonth();
let currentYear = date.getFullYear();

const renderCalendar = () => {
  date.setDate(1);

  const today = new Date().getDate();
  const firstDay = new Date(currentYear, currentMonth, 1); // 今月の初日のデータ
  const lastDay = new Date(currentYear, currentMonth + 1, 0); //  今月の最終日のデータ
  const lastDayIndex = lastDay.getDay(); // 今月の最終日の曜日
  const lastDayDate = lastDay.getDate(); // 今月の最終日

  const prevLastDay = new Date(currentYear, currentMonth, 0); // 先月の最終日のデータ
  const prevLastDayDate = prevLastDay.getDate(); // 先月の最終日
  const nextDays = 7 - lastDayIndex - 1; // 来月の初日の曜日

  month.innerHTML = `${months[currentMonth]} ${currentYear}`;

  const info = {
    firstDay: firstDay,
    lastDay: lastDay,
    lastDayIndex: lastDayIndex,
    lastDayDate: lastDayDate,
    prevLastDay: prevLastDay,
    prevLastDayDate: prevLastDayDate,
    nextDays: nextDays,
  };

  let days = "";
  for (let i = firstDay.getDay(); i > 0; i--) {
    if (
      currentMonth === new Date().getMonth() &&
      currentYear === new Date().getFullYear()
    ) {
      days += `<div class="day current-prev">${prevLastDayDate - i + 1}</div>`;
    } else {
      days += `<div class="day prev">${prevLastDayDate - i + 1}</div>`;
    }
  }

  for (let i = 1; i <= lastDayDate; i++) {
    if (
      i === today &&
      currentMonth === new Date().getMonth() &&
      currentYear === new Date().getFullYear()
    ) {
      days += `<div class="day today active">${i}</div>`;
    } else if (
      i <= today &&
      currentMonth === new Date().getMonth() &&
      currentYear === new Date().getFullYear()
    ) {
      days += `<div class="day current-prev">${i}</div>`;
    } else {
      days += `<div class="day">${i}</div>`;
    }
  }

  for (let i = 1; i <= nextDays; i++) {
    days += `<div class="day next">${i}</div>`;
  }

  daysContainer.innerHTML = days;
  PrevBtnDisabled();
  addListner();
};

function addListner() {
  const days = document.querySelectorAll(".day");
  days.forEach((day) => {
    if (!day.classList.contains("current-prev")) {
      day.addEventListener("click", (e) => {
        //remove active
        days.forEach((day) => {
          day.classList.remove("active");
        });
        //if clicked prev-date or next-date switch to that month
        if (e.target.classList.contains("prev")) {
          prevMonth();
          //add active to clicked day afte month is change
          setTimeout(() => {
            //add active where no prev-date or next-date
            const days = document.querySelectorAll(".day");
            days.forEach((day) => {
              if (
                !day.classList.contains("prev") &&
                day.innerHTML === e.target.innerHTML
              ) {
                day.classList.add("active");
              }
            });
          }, 100);
        } else if (e.target.classList.contains("next")) {
          nextMonth();
          //add active to clicked day afte month is changed
          setTimeout(() => {
            const days = document.querySelectorAll(".day");
            days.forEach((day) => {
              if (
                !day.classList.contains("next") &&
                day.innerHTML === e.target.innerHTML
              ) {
                day.classList.add("active");
              }
            });
          }, 100);
        } else {
          e.target.classList.add("active");
        }
      });
    }
  });
}

const prevMonth = () => {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  renderCalendar();
};

const nextMonth = () => {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  renderCalendar();
};

prevBtn.addEventListener("click", prevMonth);
nextBtn.addEventListener("click", nextMonth);

renderCalendar();

function PrevBtnDisabled() {
  if (
    currentMonth === new Date().getMonth() &&
    currentYear === new Date().getFullYear()
  ) {
    prevBtn.disabled = true;
  } else {
    prevBtn.disabled = false;
  }
}
