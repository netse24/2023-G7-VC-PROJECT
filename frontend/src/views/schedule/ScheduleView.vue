// Reference from FullCalendar library => https://fullcalendar.io/ //
<template>
  <section>
    <form class="w-75 m-auto mt-3">
      <div class="mb-3">
        <select
          id="disabledSelect"
          class="form-select"
          v-model="filterValue"
          @input="filterOption"
          @click="listSchedules"
        >
          <option
            v-for="(option, index) in selectOption"
            :key="index"
            :value="option.name"
          >
            {{ option.name }}
          </option>
        </select>
      </div>
    </form>
    <!-- <FilterSchedule/> -->
    <ScheduleForm @createSchedule="listSchedules()" />
    <CustomCalendar ref="toCallCalendar" />
  </section>
</template>
<script>
import ScheduleForm from "./ScheduleForm.vue";
// import FilterSchedule from "./FilterSchedule.vue";
import CustomCalendar from "../../components/schedule/CustomCalendar.vue";
import { axiosClient } from "../../axios-http";
export default {
  name: "HomeView",
  components: {
    ScheduleForm,
    CustomCalendar,
  },
  data() {
    return {
      selectOption: [],
      filterValue: "WEP A",
    };
  },
  methods: {
    filterOption() {
      axiosClient
        .get("classes")
        .then((response) => {
          this.selectOption = response.data.data;
          console.log(this.filterValue);
        })
        .catch((error) => {
          console.error(error);
        });
    },
    listSchedules() {
      axiosClient
        .get("/schedule")
        .then((response) => {
          // Declare calendar event
          const calendarEvents = [];
          console.log(response.data.data.className);
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
  mounted() {
    this.filterOption();
  },
};
</script>
<style scoped>
/* .fc-toolbar-title {
} */
.fc-event-time {
  display: none;
}
.fc-event-title {
  color: #000;
}
.fc-col-header-cell-cushion,
.fc-sticky {
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
