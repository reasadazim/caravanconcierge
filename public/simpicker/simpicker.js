function simpicker(selector, options = {}) {
  const input = document.querySelector(selector);
  if (!input) return;

  const {
    enableTime = true,
    dateFormat = "d-m-Y h:i K",
    time_24hr = false,
    defaultDate = null,
    rtl = false
  } = options;

  const wrapper = document.createElement('div');
  wrapper.className = 'simpicker-wrapper';
  if (rtl) wrapper.setAttribute("dir", "rtl");

  input.parentNode.insertBefore(wrapper, input);
  wrapper.appendChild(input);
  input.classList.add('simpicker-input');

  const popup = document.createElement('div');
  popup.className = 'simpicker-popup';
  wrapper.appendChild(popup);

  popup.innerHTML = `
    <div class="simpicker-header">
      <div class="prevMonth">&#8592;</div>
      <select class="monthSelect"></select>
      <select class="yearSelect"></select>
      <div class="nextMonth">&#8594;</div>
    </div>
    <div class="simpicker-calendar"></div>
    ${enableTime ? `
    <div class="simpicker-time">
      <select class="hourSelect"></select>
      <select class="minuteSelect"></select>
      ${!time_24hr ? `<select class="ampmSelect"><option>AM</option><option>PM</option></select>` : ''}
    </div>` : ''}
    <div class="simpicker-set">Set</div>
  `;

  const calendarGrid = popup.querySelector('.simpicker-calendar');
  const monthSelect = popup.querySelector('.monthSelect');
  const yearSelect = popup.querySelector('.yearSelect');
  const hourSelect = popup.querySelector('.hourSelect');
  const minuteSelect = popup.querySelector('.minuteSelect');
  const ampmSelect = popup.querySelector('.ampmSelect');
  const setBtn = popup.querySelector('.simpicker-set');
  const prevMonthBtn = popup.querySelector('.prevMonth');
  const nextMonthBtn = popup.querySelector('.nextMonth');

  const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  let selectedDate;

  if (defaultDate) {
    const parsed = parseCustomDate(defaultDate);
    if (isNaN(parsed.getTime())) {
      console.error("Invalid defaultDate format or value");
      return;
    }
    selectedDate = parsed;
  } else {
    selectedDate = new Date();
  }

  months.forEach((month, i) => {
    monthSelect.innerHTML += `<option value="${i}">${month}</option>`;
  });

  for (let y = 1970; y <= 2100; y++) {
    yearSelect.innerHTML += `<option value="${y}">${y}</option>`;
  }

  if (enableTime) {
    const hourRange = time_24hr ? 24 : 12;
    for (let h = 0; h < hourRange; h++) {
      let display = time_24hr ? String(h).padStart(2, '0') : String(h === 0 ? 12 : h).padStart(2, '0');
      hourSelect.innerHTML += `<option value="${h}">${display}</option>`;
    }

    for (let m = 0; m < 60; m++) {
      minuteSelect.innerHTML += `<option value="${m}">${String(m).padStart(2, '0')}</option>`;
    }
  }

  function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const firstDay = new Date(year, month, 1).getDay();
    const today = new Date();

    calendarGrid.innerHTML = '';
    const weekdays = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
    weekdays.forEach(d => calendarGrid.innerHTML += `<div class="weekday">${d}</div>`);

    for (let i = 0; i < firstDay; i++) calendarGrid.innerHTML += `<div></div>`;

    for (let day = 1; day <= daysInMonth; day++) {
      const div = document.createElement('div');
      div.className = 'day';
      div.textContent = day;

      const isSelected =
        year === selectedDate.getFullYear() &&
        month === selectedDate.getMonth() &&
        day === selectedDate.getDate();

      const isToday =
        year === today.getFullYear() &&
        month === today.getMonth() &&
        day === today.getDate();

      if (isSelected) div.classList.add('selected');
      if (isToday) div.classList.add('today');

      div.addEventListener('click', function () {
        selectedDate.setFullYear(year);
        selectedDate.setMonth(month);
        selectedDate.setDate(day);
        [...calendarGrid.querySelectorAll('.day.selected')].forEach(el => el.classList.remove('selected'));
        div.classList.add('selected');
      });

      calendarGrid.appendChild(div);
    }

    monthSelect.value = month;
    yearSelect.value = year;
  }

  function parseCustomDate(str) {
    const parts = str.match(/(\d{2})-(\d{2})-(\d{4}) (\d{1,2}):(\d{2})\s*(AM|PM)?/);
    if (!parts) return new Date();
    let [_, d, m, y, hh, mm, ap] = parts;
    let h = parseInt(hh, 10);
    if (!time_24hr) {
      if (ap === 'PM' && h < 12) h += 12;
      if (ap === 'AM' && h === 12) h = 0;
    }
    return new Date(+y, +m - 1, +d, h, +mm);
  }

  input.addEventListener('click', () => {
    popup.style.display = 'block';
    renderCalendar(selectedDate);
  });

  setBtn.addEventListener('click', () => {
    if (enableTime) {
      let h = parseInt(hourSelect.value, 10);
      const m = parseInt(minuteSelect.value, 10);
      let ampm = ampmSelect ? ampmSelect.value : null;

      if (!time_24hr) {
        if (ampm === 'PM' && h !== 12) h += 12;
        if (ampm === 'AM' && h === 12) h = 0;
      }

      selectedDate.setHours(h, m, 0);
    }

    const day = String(selectedDate.getDate()).padStart(2, '0');
    const mon = String(selectedDate.getMonth() + 1).padStart(2, '0');
    const year = selectedDate.getFullYear();

    let h = selectedDate.getHours();
    let hr = enableTime ? String(h).padStart(2, '0') : '';
    let min = enableTime ? String(selectedDate.getMinutes()).padStart(2, '0') : '';
    let ampm = '';

    if (!time_24hr && enableTime) {
      ampm = h >= 12 ? ' PM' : ' AM';
      hr = String(h % 12 || 12).padStart(2, '0');
    }

    input.value = enableTime ? `${day}-${mon}-${year} ${hr}:${min}${ampm}` : `${day}-${mon}-${year}`;
    popup.style.display = 'none';
  });

  monthSelect.addEventListener('change', () => {
    selectedDate.setMonth(parseInt(monthSelect.value));
    renderCalendar(selectedDate);
  });

  yearSelect.addEventListener('change', () => {
    selectedDate.setFullYear(parseInt(yearSelect.value));
    renderCalendar(selectedDate);
  });

  prevMonthBtn.addEventListener('click', () => {
    selectedDate.setMonth(selectedDate.getMonth() - 1);
    renderCalendar(selectedDate);
  });

  nextMonthBtn.addEventListener('click', () => {
    selectedDate.setMonth(selectedDate.getMonth() + 1);
    renderCalendar(selectedDate);
  });

  document.addEventListener('click', (e) => {
    if (!popup.contains(e.target) && e.target !== input) {
      popup.style.display = 'none';
    }
  });
}
