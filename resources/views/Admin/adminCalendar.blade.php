<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PeopleHub - Calendar</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <style>
    body { font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, sans-serif; transition: margin-left 0.3s ease; }
    main { transition: margin-left 0.3s ease; }
    aside ~ main { margin-left: 16rem; }
  </style>
</head>
<body class="bg-slate-100">

<div class="flex min-h-screen">
  @include('components.adminSideBar')

  <main class="flex-1 ml-16 transition-all duration-300">
    @include('components.adminHeader.calenderHeader')

    <div class="p-4 md:p-8 pt-20">
      <div class="bg-white rounded-xl border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
          <button id="calendarPrevBtn" type="button" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            <i class="fa-solid fa-chevron-left"></i>
            Previous
          </button>
          <h3 id="calendarMonthLabel" class="text-xl font-semibold text-gray-800"></h3>
          <button id="calendarNextBtn" type="button" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            Next
            <i class="fa-solid fa-chevron-right"></i>
          </button>
        </div>

        <div class="mb-4 flex items-center justify-between rounded-lg border border-slate-200 bg-slate-50 px-4 py-3">
          <p id="selectedDateLabel" class="text-sm text-slate-700">Select a date to add a custom event or holiday.</p>
          <div class="flex items-center gap-2">
            <button
              id="addCustomEventBtn"
              type="button"
              class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-50"
              disabled
            >
              <i class="fa-solid fa-plus"></i>
              Add Event
            </button>
            <button
              id="removeCustomEventBtn"
              type="button"
              class="inline-flex items-center gap-2 rounded-lg bg-rose-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-rose-700 disabled:cursor-not-allowed disabled:opacity-50"
              disabled
            >
              <i class="fa-solid fa-trash"></i>
              Remove Event
            </button>
            <button
              id="addCustomHolidayBtn"
              type="button"
              class="inline-flex items-center gap-2 rounded-lg bg-rose-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-rose-700 disabled:cursor-not-allowed disabled:opacity-50"
              disabled
            >
              <i class="fa-solid fa-plus"></i>
              Add Holiday
            </button>
            <button
              id="removeCustomHolidayBtn"
              type="button"
              class="inline-flex items-center gap-2 rounded-lg bg-rose-800 px-3 py-2 text-xs font-semibold text-white transition hover:bg-rose-900 disabled:cursor-not-allowed disabled:opacity-50"
              disabled
            >
              <i class="fa-solid fa-trash"></i>
              Remove Holiday
            </button>
          </div>
        </div>

        <div class="grid grid-cols-7 text-center text-xs md:text-sm font-semibold text-slate-600 border-b border-slate-200 pb-2 mb-2">
          <div>Sun</div>
          <div>Mon</div>
          <div>Tue</div>
          <div>Wed</div>
          <div>Thu</div>
          <div>Fri</div>
          <div>Sat</div>
        </div>

        <div id="calendarGrid" class="grid grid-cols-7 gap-2"></div>
        <div class="mt-4 flex flex-wrap items-center gap-4 text-xs text-slate-600">
          <span class="inline-flex items-center gap-2">
            <span class="inline-block h-2.5 w-2.5 rounded-full bg-rose-500"></span>
            <span>Employee Holiday</span>
          </span>
          <span class="inline-flex items-center gap-2">
            <span class="inline-block h-2.5 w-2.5 rounded-full bg-red-500"></span>
            <span>No Classes</span>
          </span>
          <span class="inline-flex items-center gap-2">
            <span class="inline-block h-2.5 w-2.5 rounded-full bg-violet-500"></span>
            <span>Special Events</span>
          </span>
          <span class="inline-flex items-center gap-2">
            <span class="inline-block h-2.5 w-2.5 rounded-full bg-yellow-500"></span>
            <span>School Events</span>
          </span>
          <span id="holidayStatus" class="ml-auto text-slate-500"></span>
        </div>
      </div>
    </div>
  </main>
</div>

<script>
  const sidebar = document.querySelector('aside');
  const main = document.querySelector('main');
  if (sidebar && main) {
    sidebar.addEventListener('mouseenter', function () {
      main.classList.remove('ml-16');
      main.classList.add('ml-64');
    });
    sidebar.addEventListener('mouseleave', function () {
      main.classList.remove('ml-64');
      main.classList.add('ml-16');
    });
  }

  const monthLabel = document.getElementById('calendarMonthLabel');
  const grid = document.getElementById('calendarGrid');
  const prevBtn = document.getElementById('calendarPrevBtn');
  const nextBtn = document.getElementById('calendarNextBtn');
  const holidayStatus = document.getElementById('holidayStatus');
  const selectedDateLabel = document.getElementById('selectedDateLabel');
  const addCustomEventBtn = document.getElementById('addCustomEventBtn');
  const removeCustomEventBtn = document.getElementById('removeCustomEventBtn');
  const addCustomHolidayBtn = document.getElementById('addCustomHolidayBtn');
  const removeCustomHolidayBtn = document.getElementById('removeCustomHolidayBtn');

  const HOLIDAY_COUNTRY = 'US';
  const CUSTOM_EVENT_STORAGE_KEY = 'school_custom_events_v1';
  const CUSTOM_HOLIDAY_STORAGE_KEY = 'school_custom_holidays_v1';
  const HIDDEN_OFFICIAL_HOLIDAY_STORAGE_KEY = 'hidden_official_holidays_v1';
  const holidayCache = {};
  const specialEventCache = {};
  let customEvents = loadCustomEvents();
  let customHolidays = loadCustomHolidays();
  let hiddenOfficialHolidays = loadHiddenOfficialHolidays();
  let currentHolidayEntriesByDate = {};
  let selectedDateForCustomEvent = null;
  let calendarDate = new Date();

  function loadCustomEvents() {
    try {
      const raw = localStorage.getItem(CUSTOM_EVENT_STORAGE_KEY);
      if (!raw) return {};
      const parsed = JSON.parse(raw);
      return parsed && typeof parsed === 'object' ? parsed : {};
    } catch (error) {
      return {};
    }
  }

  function saveCustomEvents() {
    localStorage.setItem(CUSTOM_EVENT_STORAGE_KEY, JSON.stringify(customEvents));
  }

  function loadCustomHolidays() {
    try {
      const raw = localStorage.getItem(CUSTOM_HOLIDAY_STORAGE_KEY);
      if (!raw) return {};
      const parsed = JSON.parse(raw);
      return parsed && typeof parsed === 'object' ? parsed : {};
    } catch (error) {
      return {};
    }
  }

  function saveCustomHolidays() {
    localStorage.setItem(CUSTOM_HOLIDAY_STORAGE_KEY, JSON.stringify(customHolidays));
  }

  function loadHiddenOfficialHolidays() {
    try {
      const raw = localStorage.getItem(HIDDEN_OFFICIAL_HOLIDAY_STORAGE_KEY);
      if (!raw) return {};
      const parsed = JSON.parse(raw);
      return parsed && typeof parsed === 'object' ? parsed : {};
    } catch (error) {
      return {};
    }
  }

  function saveHiddenOfficialHolidays() {
    localStorage.setItem(HIDDEN_OFFICIAL_HOLIDAY_STORAGE_KEY, JSON.stringify(hiddenOfficialHolidays));
  }

  function getCustomEventNamesForDate(isoDate) {
    const events = customEvents[isoDate];
    return Array.isArray(events) ? events : [];
  }

  function getCustomHolidayNamesForDate(isoDate) {
    const holidays = customHolidays[isoDate];
    return Array.isArray(holidays) ? holidays : [];
  }

  function setSelectedDate(isoDate) {
    selectedDateForCustomEvent = isoDate;
    const parsedDate = new Date(`${isoDate}T00:00:00`);
    const readable = parsedDate.toLocaleDateString('en-US', {
      weekday: 'long',
      month: 'long',
      day: 'numeric',
      year: 'numeric',
    });
    selectedDateLabel.textContent = `Selected: ${readable}`;
    addCustomEventBtn.disabled = false;
    removeCustomEventBtn.disabled = getCustomEventNamesForDate(isoDate).length === 0;
    addCustomHolidayBtn.disabled = false;
    removeCustomHolidayBtn.disabled = (currentHolidayEntriesByDate[isoDate] || []).length === 0;
  }

  async function getHolidaysForYear(year) {
    if (holidayCache[year]) {
      return holidayCache[year];
    }

    if (holidayStatus) {
      holidayStatus.textContent = 'Loading holidays...';
    }

    try {
      const response = await fetch(`https://date.nager.at/api/v3/PublicHolidays/${year}/${HOLIDAY_COUNTRY}`);
      if (!response.ok) {
        throw new Error('Failed to load holidays');
      }

      const holidays = await response.json();
      const normalized = {};
      holidays.forEach((holiday) => {
        if (!holiday?.date) return;
        normalized[holiday.date] = holiday.localName || holiday.name || 'Holiday';
      });

      holidayCache[year] = normalized;
      if (holidayStatus) {
        holidayStatus.textContent = `${Object.keys(normalized).length} holidays loaded`;
      }
      return normalized;
    } catch (error) {
      holidayCache[year] = {};
      if (holidayStatus) {
        holidayStatus.textContent = 'Unable to load holidays';
      }
      return {};
    }
  }

  async function renderCalendar() {
    const year = calendarDate.getFullYear();
    const month = calendarDate.getMonth();
    const holidays = await getHolidaysForYear(year);
    const specialEvents = getSpecialEventsForYear(year);
    currentHolidayEntriesByDate = {};

    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const daysInPrevMonth = new Date(year, month, 0).getDate();
    const today = new Date();

    monthLabel.textContent = calendarDate.toLocaleDateString('en-US', {
      month: 'long',
      year: 'numeric',
    });

    grid.innerHTML = '';

    for (let i = firstDay - 1; i >= 0; i--) {
      const cell = document.createElement('div');
      cell.className = 'rounded-lg border border-slate-100 bg-slate-50 p-3 text-xs md:text-sm text-slate-400 min-h-[84px]';
      cell.textContent = String(daysInPrevMonth - i);
      grid.appendChild(cell);
    }

    for (let day = 1; day <= daysInMonth; day++) {
      const isToday =
        day === today.getDate() &&
        month === today.getMonth() &&
        year === today.getFullYear();
      const isoDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
      const holidayEntries = [];
      const officialHolidayName = holidays[isoDate] || null;
      const hiddenOfficialForDate = Array.isArray(hiddenOfficialHolidays[isoDate]) ? hiddenOfficialHolidays[isoDate] : [];
      if (officialHolidayName && !hiddenOfficialForDate.includes(officialHolidayName)) {
        holidayEntries.push({ name: officialHolidayName, type: 'official' });
      }
      getCustomHolidayNamesForDate(isoDate).forEach((name) => {
        holidayEntries.push({ name, type: 'custom' });
      });

      const dayOfWeek = new Date(year, month, day).getDay();
      const isHoliday = holidayEntries.length > 0;
      const isNoClassSunday = dayOfWeek === 0;
      const noClassLabel = isHoliday ? 'No Classes (Holiday)' : (isNoClassSunday ? 'No Classes (Sunday)' : null);
      const events = specialEvents[isoDate] || [];
      const hasSpecialEvent = events.length > 0;
      const customEventNames = getCustomEventNamesForDate(isoDate);
      const hasCustomEvent = customEventNames.length > 0;

      const cell = document.createElement('div');
      cell.className = [
        'rounded-lg border p-3 min-h-[84px] text-xs md:text-sm flex flex-col',
        isToday
          ? 'border-blue-300 bg-blue-50 text-blue-700 font-semibold'
          : 'border-slate-200 bg-white text-slate-700',
        isHoliday ? 'ring-1 ring-rose-300 bg-rose-50/60' : '',
        !isHoliday && isNoClassSunday ? 'ring-1 ring-red-300 bg-red-50/60' : '',
        !isHoliday && !isNoClassSunday && hasSpecialEvent ? 'ring-1 ring-violet-300 bg-violet-50/60' : '',
        hasCustomEvent ? 'ring-2 ring-yellow-400 bg-yellow-50/60' : '',
        'cursor-pointer hover:border-indigo-300',
      ].join(' ');
      cell.innerHTML = `<span>${day}</span>`;
      cell.addEventListener('click', function () {
        setSelectedDate(isoDate);
      });

      holidayEntries.forEach((holidayEntry) => {
        const employeeHolidayEl = document.createElement('span');
        employeeHolidayEl.className = 'mt-1 inline-flex items-center gap-1 text-[10px] leading-tight font-medium text-rose-700';
        employeeHolidayEl.innerHTML = `<span class="inline-block h-1.5 w-1.5 rounded-full bg-rose-500"></span>${holidayEntry.name}`;
        cell.appendChild(employeeHolidayEl);
      });

      if (noClassLabel) {
        const schoolNoClassEl = document.createElement('span');
        schoolNoClassEl.className = 'mt-1 inline-flex items-center gap-1 text-[10px] leading-tight font-medium text-red-700';
        schoolNoClassEl.innerHTML = `<span class="inline-block h-1.5 w-1.5 rounded-full bg-red-500"></span>${noClassLabel}`;
        cell.appendChild(schoolNoClassEl);
      }

      events.forEach((eventName) => {
        const eventEl = document.createElement('span');
        eventEl.className = 'mt-1 inline-flex items-center gap-1 text-[10px] leading-tight font-medium text-violet-700';
        eventEl.innerHTML = `<span class="inline-block h-1.5 w-1.5 rounded-full bg-violet-500"></span>${eventName}`;
        cell.appendChild(eventEl);
      });

      customEventNames.forEach((eventName) => {
        const customEventEl = document.createElement('span');
        customEventEl.className = 'mt-1 inline-flex items-center gap-1 text-[10px] leading-tight font-medium text-yellow-700';
        customEventEl.innerHTML = `<span class="inline-block h-1.5 w-1.5 rounded-full bg-yellow-500"></span>${eventName}`;
        cell.appendChild(customEventEl);
      });

      grid.appendChild(cell);
      currentHolidayEntriesByDate[isoDate] = holidayEntries;
    }

    const totalCells = firstDay + daysInMonth;
    const trailing = (7 - (totalCells % 7)) % 7;
    for (let day = 1; day <= trailing; day++) {
      const cell = document.createElement('div');
      cell.className = 'rounded-lg border border-slate-100 bg-slate-50 p-3 text-xs md:text-sm text-slate-400 min-h-[84px]';
      cell.textContent = String(day);
      grid.appendChild(cell);
    }
  }

  prevBtn?.addEventListener('click', function () {
    calendarDate.setMonth(calendarDate.getMonth() - 1);
    renderCalendar();
  });

  nextBtn?.addEventListener('click', function () {
    calendarDate.setMonth(calendarDate.getMonth() + 1);
    renderCalendar();
  });

  addCustomEventBtn?.addEventListener('click', function () {
    if (!selectedDateForCustomEvent) return;

    const eventTitle = window.prompt('Enter custom school event title:');
    if (eventTitle === null) return;

    const trimmed = eventTitle.trim();
    if (!trimmed) return;

    const current = getCustomEventNamesForDate(selectedDateForCustomEvent);
    customEvents[selectedDateForCustomEvent] = [...current, trimmed];
    saveCustomEvents();
    renderCalendar();
    removeCustomEventBtn.disabled = false;
  });

  removeCustomEventBtn?.addEventListener('click', function () {
    if (!selectedDateForCustomEvent) return;

    const events = getCustomEventNamesForDate(selectedDateForCustomEvent);
    if (!events.length) return;

    const optionsText = events.map((eventName, index) => `${index + 1}. ${eventName}`).join('\n');
    const selected = window.prompt(`Select event number to remove:\n${optionsText}`);
    if (selected === null) return;

    const selectedIndex = parseInt(selected, 10) - 1;
    if (Number.isNaN(selectedIndex) || selectedIndex < 0 || selectedIndex >= events.length) return;

    const nextEvents = events.filter((_, index) => index !== selectedIndex);
    if (nextEvents.length > 0) {
      customEvents[selectedDateForCustomEvent] = nextEvents;
    } else {
      delete customEvents[selectedDateForCustomEvent];
    }

    saveCustomEvents();
    renderCalendar();
    removeCustomEventBtn.disabled = getCustomEventNamesForDate(selectedDateForCustomEvent).length === 0;
  });

  addCustomHolidayBtn?.addEventListener('click', function () {
    if (!selectedDateForCustomEvent) return;

    const holidayTitle = window.prompt('Enter custom holiday title:');
    if (holidayTitle === null) return;

    const trimmed = holidayTitle.trim();
    if (!trimmed) return;

    const current = getCustomHolidayNamesForDate(selectedDateForCustomEvent);
    customHolidays[selectedDateForCustomEvent] = [...current, trimmed];
    saveCustomHolidays();
    renderCalendar();
    removeCustomHolidayBtn.disabled = false;
  });

  removeCustomHolidayBtn?.addEventListener('click', function () {
    if (!selectedDateForCustomEvent) return;

    const holidayEntries = currentHolidayEntriesByDate[selectedDateForCustomEvent] || [];
    if (!holidayEntries.length) return;

    const optionsText = holidayEntries
      .map((holidayEntry, index) => `${index + 1}. ${holidayEntry.name} (${holidayEntry.type === 'official' ? 'Official' : 'Custom'})`)
      .join('\n');
    const selected = window.prompt(`Select holiday number to remove:\n${optionsText}`);
    if (selected === null) return;

    const selectedIndex = parseInt(selected, 10) - 1;
    if (Number.isNaN(selectedIndex) || selectedIndex < 0 || selectedIndex >= holidayEntries.length) return;

    const target = holidayEntries[selectedIndex];
    if (target.type === 'custom') {
      const customList = getCustomHolidayNamesForDate(selectedDateForCustomEvent);
      const nextHolidays = customList.filter((holidayName) => holidayName !== target.name);
      if (nextHolidays.length > 0) {
        customHolidays[selectedDateForCustomEvent] = nextHolidays;
      } else {
        delete customHolidays[selectedDateForCustomEvent];
      }
      saveCustomHolidays();
    } else {
      const hiddenList = Array.isArray(hiddenOfficialHolidays[selectedDateForCustomEvent])
        ? hiddenOfficialHolidays[selectedDateForCustomEvent]
        : [];
      hiddenOfficialHolidays[selectedDateForCustomEvent] = [...new Set([...hiddenList, target.name])];
      saveHiddenOfficialHolidays();
    }

    renderCalendar();
    removeCustomHolidayBtn.disabled = (currentHolidayEntriesByDate[selectedDateForCustomEvent] || []).length === 0;
  });

  function getSpecialEventsForYear(year) {
    if (specialEventCache[year]) {
      return specialEventCache[year];
    }

    const events = {};
    const add = (date, label) => {
      if (!events[date]) events[date] = [];
      events[date].push(label);
    };

    // Fixed-date observances
    add(`${year}-02-14`, "Valentine's Day");
    add(`${year}-03-08`, "International Women's Day");
    add(`${year}-04-22`, "Earth Day");
    add(`${year}-10-31`, "Halloween");
    add(`${year}-11-01`, "All Saints' Day");
    add(`${year}-11-02`, "All Souls' Day");
    add(`${year}-12-24`, "Christmas Eve");
    add(`${year}-12-31`, "New Year's Eve");

    // Chinese New Year (mapped dates)
    const chineseNewYearByYear = {
      2024: '2024-02-10',
      2025: '2025-01-29',
      2026: '2026-02-17',
      2027: '2027-02-06',
      2028: '2028-01-26',
      2029: '2029-02-13',
      2030: '2030-02-03',
      2031: '2031-01-23',
      2032: '2032-02-11',
      2033: '2033-01-31',
      2034: '2034-02-19',
      2035: '2035-02-08',
    };
    if (chineseNewYearByYear[year]) {
      add(chineseNewYearByYear[year], 'Chinese New Year');
    }

    specialEventCache[year] = events;
    return events;
  }

  renderCalendar();
</script>

</body>
</html>
