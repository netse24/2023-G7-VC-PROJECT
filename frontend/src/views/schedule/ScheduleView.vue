// Reference from FullCalendar library => https://fullcalendar.io/ //
<template>
  <section>
    <form class="w-75 m-auto mt-3">
      <div class="mb-3">
        <select
          id="disabledSelect"
          class="form-select"
          v-model="filterValue"
          @change="filterOption"
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
    <ScheduleForm @createSchedule="listSchedules()" />
    <CustomCalendar ref="toCallCalendar" />
  </section>
</template>
<script>
import ScheduleForm from "./ScheduleForm.vue";
// import FilterSchedule from "./FilterSchedule.vue";
import CustomCalendar from "../../components/schedule/CustomCalendar.vue";
import { axiosClient } from "../../axios-http";
import { storeManageCookie } from "../../store/cookie";
import { AES, enc } from 'crypto-js';

export default {
  setup() {
    const getRole = storeManageCookie();
    return {getRole};
  },
  name: "HomeView",
  components: {
    ScheduleForm,
    CustomCalendar,
  },
  data() {
    return {
      selectOption: [],
      teachers: [],
      filterValue: "WEP A",
      user: "",
    };
  },
  methods: {
    filterOption() {
      let role = AES.decrypt(this.getRole.getCookie("user_role"), "Secret role").toString(enc.Utf8);
      const path = (role === 'student') ? 'classes' : 'teachers';
      axiosClient
        .get(path)
        .then((response) => {
          if(path == 'classes') {
            this.selectOption = response.data.data;
          } else if (path == 'teachers') {
            this.selectOption = [];
            this.teachers = response.data.data;
            this.teachers.forEach(teacher => {
              this.teachers = [];
              this.selectOption.push({name:`${teacher.first_name} ${teacher.last_name}`});
            });
          }
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
          if (response.data && response.data.data) {
            response.data.data.forEach((calenndar) => {
              // Add each event to array calendarEvents
              if(this.filterValue == calenndar.className || this.filterValue == `${calenndar.first_name} ${calenndar.last_name}`) {
                calendarEvents.push({
                  title: calenndar.course,
                  start: `${calenndar.start_date}T${calenndar.start_time}`,
                  end: `${calenndar.end_date}T${calenndar.end_time}`,
                  extendedProps: {
                    className: `${calenndar.className}`,
                    teacherName: `${calenndar.first_name} ${calenndar.last_name}`,
                    roomName: `${calenndar.roomName}`,
                  },
                });

              }
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
.fc-col-header-cell-cushion, .fc-sticky {
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
