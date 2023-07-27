<template>
  <section>
    <div class="home" style="margin: 10px">
      <FullCalendar :options="calendarOptions" />
    </div>
  </section>
</template>

<script>
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";
import timeGridPlugin from "@fullcalendar/timegrid";
import multiMonthPlugin from "@fullcalendar/multimonth";
export default {
  name: "CustomCalendar",
  components: {
    FullCalendar, // make the <FullCalendar> tag available
  },
  props: {},
  emits: ["updateCalendar"],
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
          const teacher = info.event.extendedProps.teacherName;
          const roomName = info.event.extendedProps.roomName;
          const className = info.event.extendedProps.className;
          info.el.querySelector(
            ".fc-event-title"
          ).innerHTML += `<br>${teacher}<br>${className}<br>${roomName}`;
        },
        // eventDataTransform: function( eventData ) {
        //   console.log(eventData);
        // },
        // Get calendar event form parent
        eventClick: this.editEventCalendar,
        events: [
        ],
        // Toolbar
        titleFormat: { year: "numeric", month: "long", day: "numeric" },
        headerToolbar: {
          left: "prev,next today",
          // start: "",
          end: "timeGridWeek,dayGridMonth,multiMonthYear",
          center: "title",
        },
        views: {
          timeGridWeek: { buttonText: "week" },
          //   dayGridMonth: { buttonText: "Month" },
          //   dayGridWeek: { buttonText: "Week" },
          // listMonth: { buttonText: "all event" },
        },
      },
    };
  },
  methods: {
    handleDateClick(){
      // console.log('ff', info);
    },
    editEventCalendar(info){
      this.$emit('updateCalendar', info.event._def)
    },

    addEvents(
      eventsData = [
        {
          title: "",
          start: "",
          end: "",
          extendedProps: {
            className: "",
            teacherName: "",
            roomName: "",
          },
        },
      ]
    ) {
      this.calendarOptions.events = eventsData;
    },
  },
  created() {
    this.addEvents();
  },
};
</script>
<style>
/* .fc-toolbar-title {
} */
.fc-event-time {
  display: none;
}
.fc-col-header-cell-cushion {
  color: #000;
  text-decoration: none;
}
.fc-event-title {
  color: #000;
  line-height: 18px;
}
#teachers {
  width: 50%;
  margin: 10px auto;
  padding: 8px;
  border: 1px solid #000;
  border-radius: 5px;
}
</style>
