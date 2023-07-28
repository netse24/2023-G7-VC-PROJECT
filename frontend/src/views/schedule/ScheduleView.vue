<!-- // Reference from FullCalendar library => https://fullcalendar.io/ // -->
<template>
  <section>
    <nav-bar />
    <div
      class="head-container d-flex justify-content-center align-items-center m-2"
    >
      <router-link :to="backRoute" @click="backToHome"
        ><button
          class="bg-cyan-600 hover:bg-cyan-600 w-20 font-bold h-10 rounded"
        >
          Home
        </button>
      </router-link>
      <ScheduleForm
      @createSchedule="listSchedules()"
      ref="refToChildScheduleForm"
    />
      <form class="w-75 m-auto mt-3">
        <div class="mb-3">
          <select
            id="disabledSelect"
            class="form-select"
            v-model="filterValue"
            @change="filterOption"
          >
            <option
              v-for="(option, index) in selectOption"
              :key="index"
              :value="option"
              :selected="selectedFilter == option.name"
            >
              {{ option.name }}
            </option>
          </select>
        </div>
      </form>
    </div>
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
      selectedFilter: null,
      role: AES.decrypt(
        this.getRole.getCookie("user_role"),
        "Secret role"
      ).toString(enc.Utf8),
      backRoute: "",
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
      });
      this.$refs.toCallCalendar.addEvents(calendarEvents);
    },
    backToHome() {
      if (this.role === "admin") {
        this.$router.push((this.backRoute = "/admin"));
      } else if (this.role === "teacher") {
        this.$router.push((this.backRoute = "/teachers"));
      } else if (this.role === "student") {
        this.$router.push((this.backRoute = "/students"));
      }
    },
    async filterOption() {
      const path = this.role === "student" ? "classes" : "teachers";
      await axiosClient
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
                teacher.name = `${teacher.user.first_name} ${teacher.user.last_name}`;
                return teacher;
              });
              query = `teacher_id=${this.filterValue.id}`;
            }
          }
          if (
            query &&
            this.filterValue &&
            Object.keys(this.filterValue).length > 0
          ) {
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
      if (this.role === "admin") {
        this.$refs.refToChildScheduleForm.updateSchedule(event);
        this.$refs.refToChildScheduleForm.openDialog();
      }
    },
    async listSchedules() {
      await axiosClient
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
