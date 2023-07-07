// Reference: FullCalendar library => https://fullcalendar.io/

<template>
  <div class="home" style="margin: 10px">
    <!-- <img alt="Vue logo" src="../assets/logo.png"> -->
    <FullCalendar :options="calendarOptions" />
  </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";
import timeGridPlugin from "@fullcalendar/timegrid";
import multiMonthPlugin from "@fullcalendar/multimonth";
export default {
  name: "HomeView",
  components: {
    FullCalendar, // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarOptions: {
        plugins: [
          dayGridPlugin,
          interactionPlugin,
          timeGridPlugin,
          multiMonthPlugin,
          listPlugin,
        ],
        // Fuction
        // dateClick: this.handleDateClick,
        // Time
        timeZone: "Asia/Phnom_Penh", // Set the timezone to Cambodia
        slotMinTime: "00:00:00",
        slotMaxTime: "24:00:00",
        // View
        initialView: "timeGridWeek",
        // Other
        expandRows: true,
        height: 650,
        handleWindowResize: true,
        // navLinks: true, // can click day/week names to navigate views
        // weekNumbers:true,
        editable: true,
        selectable: true,
        nowIndicator: true,
        dayMaxEvents: true, // allow "more" link when too many events
        allDaySlot: false, // Disable the all-day slot

        // Events
        events: [
          {
            title: "Vue js",
            start: "2023-06-09T07:30:00",
            end: "2023-06-09T09:00:00",
          },
          {
            title: "event 1",
            date: "2023-06-10",
          },
          { title: "event 2", start: "2023-06-14T07:30:00" },
          {
            title: "Birthday Party",
            start: "2023-06-11T00:00:00",
            end: "2023-06-11T24:00:00",
            backgroundColor: "green",
          },
        ],

        // Toolbar
        titleFormat: { year: "numeric", month: "long", day: "numeric" },
        headerToolbar: {
          left: "prev,next today",
          // start: "",
          end: "timeGridWeek,dayGridMonth,multiMonthYear,listMonth",
          center: "title",
        },
        views: {
          timeGridWeek: { buttonText: "week" },
          //   dayGridMonth: { buttonText: "Month" },
          //   dayGridWeek: { buttonText: "Week" },
          listMonth: { buttonText: "all event" },
        },
      },
    };
  },
};
</script>
<style>
.fc-toolbar-title {
  color: red;
}
</style>
