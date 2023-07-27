// Reference from FullCalendar library => https://fullcalendar.io/ //
<template>
  <section>
    <navigationBar/>
    <form class="w-75 m-auto mt-3">
      <div class="mb-3">
        <select
          id="disabledSelect"
          class="form-select"
          v-model="filterValue"
          @change="filterOption"
        >
          <option v-for="(option, index) in selectOption" :key="index" :value="option">
            {{ option.name }}
          </option>
        </select>
      </div>
    </form>
    <ScheduleForm
      @createSchedule="listSchedules()"
      ref="refToChildScheduleForm"
    />
    <CustomCalendar ref="toCallCalendar" @updateCalendar="updateCalendar" />
  </section>
</template>
<script>
import ScheduleForm from "./ScheduleForm.vue";
import CustomCalendar from "../../components/schedule/CustomCalendar.vue";
import { axiosClient } from "../../axios-http";
import { storeManageCookie } from "../../store/cookie";
import { AES, enc } from "crypto-js";

export default {
  setup() {
    const getRole = storeManageCookie();
    return { getRole };
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
      filterValue: "",
      role: AES.decrypt(this.getRole.getCookie("user_role"), "Secret role").toString(
        enc.Utf8
      ),
    };
  },
  methods: {
    addEventsToCalendar(data) {
      const calendarEvents = [];
      data.forEach((calenndar) => {
        // Add each event to array calendarEvents
        calendarEvents.push({
          title: calenndar.course,
          start: `${calenndar.start_date}T${calenndar.start_time}`,
          end: `${calenndar.end_date}T${calenndar.end_time}`,
          extendedProps: {
            className: `${calenndar.className}`,
            teacherName: `${calenndar.first_name} ${calenndar.last_name}`,
            roomName: `${calenndar.roomName}`,
            dataCalenndar: calenndar,
          },
        });
        // }
      });
      this.$refs.toCallCalendar.addEvents(calendarEvents);
    },
    filterOption() {
      const path = this.role === "student" ? "classes" : "teachers";
      axiosClient
        .get(path)
        .then((response) => {
          this.selectOption = [];
          let query = "";
          if (path === "classes") {
            this.selectOption = response.data.data;
            query = `class_id=${this.filterValue.id}`;
          } else if (path === "teachers") {
            if (response.data.data.length > 0) {
              this.selectOption = response.data.data.map((teacher) => {
                teacher.name = `${teacher.first_name} ${teacher.last_name}`;
                return teacher;
              });
              query = `teacher_id=${this.filterValue.id}`;
            }
          }
          if (query && this.filterValue && Object.keys(this.filterValue).length> 0) {
            axiosClient.get(`schedule?${query}`).then((res) => {
              this.addEventsToCalendar(res.data.data);
            });
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
    updateCalendar(event) {
      if(this.role === "admin") {
        this.$refs.refToChildScheduleForm.updateSchedule(event);
        this.$refs.refToChildScheduleForm.openDialog();
      }
    },
    listSchedules() {
      axiosClient
        .get("/schedule")
        .then((response) => {
          // Declare calendar event
          if (response.data && response.data.data) {
            this.addEventsToCalendar(response.data.data);
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
.fc-event-time {
  display: none;
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
