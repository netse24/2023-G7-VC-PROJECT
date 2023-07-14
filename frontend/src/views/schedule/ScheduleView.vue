<template>
  <section>
    <ScheduleForm @createSchedule="listSchedules()"/>
    <CustomCalendar ref="toCallCalendar" />
  </section>
</template>
<script>
import ScheduleForm from "./ScheduleForm.vue";
import CustomCalendar from "../../components/schedule/CustomCalendar.vue";
import axiosClient from "axios";
axiosClient.defaults.baseURL = "http://127.0.0.1:8000/api";
export default {
  name: "HomeView",
  components: {
    ScheduleForm, CustomCalendar
  },
  data() {
    return {
    };
  },
  methods: {
    listSchedules() {
      axiosClient
        .get("/schedule")
        .then((response) => {
          // Declar calendar event
          const calendarEvents = [];
          if (response.data && response.data.data) {
            response.data.data.forEach((calenndar) => {
              // Add each event to array calendarEvents
              calendarEvents.push({
                title: calenndar.course,
                start: `${calenndar.start_date}T${calenndar.start_time}`,
                end: `${calenndar.end_date}T${calenndar.end_time}`,
                extendedProps: {
                  className: `${calenndar.className}`,
                  teacherName: `${calenndar.last_name} ${calenndar.first_name}`,
                  roomName: `${calenndar.roomName}`,
                },
              });
            });
            // Add event to fullCalendar and view
            this.$refs.toCallCalendar.addEvents(calendarEvents);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.listSchedules();
  },
};
</script>
<style scoped>
/* .fc-toolbar-title {
} */
.fc-event-time {
  display: none;
}
.fc-col-header-cell-cushion {
  color: #000;
  text-decoration: none;
}
#teachers {
  width: 50%;
  margin: 10px auto;
  padding: 8px;
  border: 1px solid #000;
  border-radius: 5px;
}
</style>
