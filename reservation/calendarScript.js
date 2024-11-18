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
const todayBtn = document.querySelector(".today");
const month = document.querySelector(".month");

const date = new Date();
let currentMonth = date.getMonth();
let currentYear = date.getFullYear();

const renderCalendar = () => {
  date.setDate(1);

  const firstDay = new Date(currentYear, currentMonth, 1); // 今月の初日のデータ
  const lastDay = new Date(currentYear, currentMonth + 1, 0); //  今月の最終日のデータ
  const lastDayIndex = lastDay.getDay(); // 今月の最終日の曜日
  const lastDayDate = lastDay.getDate(); // 今月の最終日

  const prevLastDay = new Date(currentYear, currentMonth, 0); // 先月の最終日のデータ
  const prevLastDayDate = prevLastDay.getDate(); // 先月の最終日
  const nextDays = 7 - lastDayIndex - 1; // 来月の初日の曜日

  month.innerHTML = `${months[currentMonth]} ${currentYear}`;

  let days = "";
  for (let i = firstDay.getDay(); i > 0; i--) {
    days += `<div class="day prev">${prevLastDayDate - x + 1}</div>`;
  }
};
