// Reference: FullCalendar library => https://fullcalendar.io/

<template>
  <section>
    <ScheduleForm />
    <div class="home" style="margin: 10px">
      <!-- <img alt="Vue logo" src="../assets/logo.png"> -->
      <!-- <select name="schedule" id="teachers">
        <option value="" selected disabled>Choose teacher</option>
        <option value="him">Him</option>
        <option value="rady">Rady</option>
        <option value="narin">Narin</option>
        <option value="yon">Yon</option>
      </select> -->
      <FullCalendar :options="calendarOptions" />
    </div>
  </section>
</template>

<script>
import ScheduleForm from "./ScheduleForm.vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";
import timeGridPlugin from "@fullcalendar/timegrid";
import multiMonthPlugin from "@fullcalendar/multimonth";
export default {
  name: "HomeView",
  components: {
    ScheduleForm,
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
        slotMinTime: "07:00:00",
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
        eventDidMount: function (info) {
          let teacher = info.event.extendedProps.teacherName;
          let room = info.event.extendedProps.roomName;
          info.el.querySelector(
            ".fc-event-title"
          ).innerHTML += `<br>${teacher}<br>${room}<br>`;
          // {description: "Lecture", department: "BioChemistry"}
        },
        // eventDataTransform: function( eventData ) {
        //   console.log(eventData);
        // },
        events: [
          {
            title: "VC 2",
            start: "2023-07-10T07:30:00",
            end: "2023-07-10T09:00:00",
            name: "",
            extendedProps: {
              teacherName: "Rady",
              roomName: "B32",
            },
          },
          {
            title: "Professional Life",
            start: "2023-07-10T10:00:00",
            end: "2023-07-10T11:30:00",
            name: "",
            extendedProps: {
              teacherName: "Him",
              roomName: "B31",
            },
          },
          {
            title: "Vue Js",
            start: "2023-07-11T07:30:00",
            end: "2023-07-11T09:00:00",
            name: "",
            extendedProps: {
              teacherName: "Him",
              roomName: "B31",
            },
          },
          {
            title: "Vue Js",
            start: "2023-08-11T10:00:00",
            end: "2023-08-11T11:30:00",
            name: "",
            extendedProps: {
              teacherName: "Him",
              roomName: "B31",
            },
          },
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
/* .fc-toolbar-title {
} */
.fc-event-time {
  display: none;
}
#teachers {
  width: 50%;
  margin: 10px auto;
  padding: 8px;
  border: 1px solid #000;
  border-radius: 5px;
}
</style>
