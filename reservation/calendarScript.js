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
const message = document.querySelector("#message");

const date = new Date();
let activeDay;
let currentMonth = date.getMonth();
let currentYear = date.getFullYear();
let dateAndTime = {
  date: '',
  time: '',
  message: '',
}
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
    let prevDay = prevLastDayDate - i + 1;
    if (
      currentMonth === new Date().getMonth() &&
      currentYear === new Date().getFullYear()
    ) {
      days += `<div class="day current-prev">${prevDay}</div>`;
    } else {
      days += `<div class="day prev" data-day="${currentYear}-${currentMonth}-${i}">${prevDay}</div>`;
    }
  }

  for (let i = 1; i <= lastDayDate; i++) {
    if (
      i === today &&
      currentMonth === new Date().getMonth() &&
      currentYear === new Date().getFullYear()
    ) {
      days += `<div class="day today active" data-day="${currentYear}-${currentMonth + 1}-${i}">${i}</div>`;
    } else if (
      i <= today &&
      currentMonth === new Date().getMonth() &&
      currentYear === new Date().getFullYear()
    ) {
      days += `<div class="day current-prev">${i}</div>`;
    } else {
      days += `<div class="day" data-day="${currentYear}-${currentMonth + 1}-${i}">${i}</div>`;
    }
  }

  for (let i = 1; i <= nextDays; i++) {
    days += `<div class="day next" data-day="${currentYear}-${currentMonth + 1}-${i}">${i}</div>`;
  }

  daysContainer.innerHTML = days;
  PrevBtnDisabled();
  addListner();
  createTimetable(`${new Date().getFullYear()}-${(new Date().getMonth() + 1).toString().padStart(2, '0')}-${(new Date().getDate()).toString().padStart(2, '0')}`);
  dateAndTime.date = `${new Date().getFullYear()}-${(new Date().getMonth() + 1).toString().padStart(2, '0')}-${(new Date().getDate()).toString().padStart(2, '0')}`;
  console.log(dateAndTime);
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
          //add active to clicked day after month is changed
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
          dateAndTime.date = e.target.dataset.day;
          // after picking a new date make time clear
          dateAndTime.time = "";
          console.log(dateAndTime);

        setTimeout(() => {
          createTimetable(e.target.dataset.day);
          const timeOptions = document.querySelectorAll(".time");
          timeOptions.forEach((time) => {
            time.addEventListener("click", (e) => {
                //remove active
                timeOptions.forEach((time) => {
                  time.classList.remove("active");
                });
                e.target.classList.add("active");
                dateAndTime.time = e.target.textContent.split(':')[0];
                console.log(dateAndTime);
            })
          })
        }, 100);
      });
    }
  });
}

const createTimetable = (date) => {
  const timeContainer = document.querySelector(".timetable");
  let timeInfo = "";
  let reservedTime = [];
  const data = { date: date};

  fetch('checkDate.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: new URLSearchParams(data),
  })
  .then((response) =>  response.json())
  .then((responseData) => {
    if (responseData.status === true) {
      reservedTime = responseData.timeArray;
    } else {
      alert("失敗発生");
    }
  });

  for(let i = 9; i <= 16; i++) {
    reservedTime.includes(i) ? timeInfo += `<li class="time">${i}:00</li>` : timeInfo += `<li class="time reserved">${i}:00</li>`;
  }
  timeContainer.innerHTML = timeInfo;
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

message.addEventListener("change", () => {
  dateAndTime.message = message.value;
  console.log(dateAndTime);
});

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
