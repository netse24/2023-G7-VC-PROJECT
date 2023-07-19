<template>
  <section>
    <NavBar />
    <button
      type="button"
      class="add-schedule btn btn-primary m-2"
      data-bs-toggle="modal"
      data-bs-target="#exampleModal"
      data-bs-whatever="@mdo"
      v-if="role == 'admin'"
    >
      Add Schedule
    </button>
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">
              Creat Schedule
            </h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <!-- mock  -->
            <form class="">
              <div class="time d-flex gap-5">
                <div class="mb-2 w-50 d-flex flex-column">
                  <label for="recipient-name" class="col-form-label"
                    >Subject:</label
                  >
                  <select
                    name="subject"
                    id="subject"
                    class="form-select"
                    v-model="subjectsItem"
                    @change="changeCourse"
                  >
                    <option value="" disabled selected>Choose A Subject</option>
                    <option
                      v-for="(subject, index) in schedultItems"
                      :key="index"
                      :value="subject"
                    >
                      {{ subject ? subject.course : "" }}
                    </option>
                  </select>
                </div>
                <div class="mb-2 w-50 d-flex flex-column">
                  <label for="recipient-name" class="col-form-label"
                    >Teacher:</label
                  >
                  <select
                    name="teacher"
                    id="teacher"
                    class="form-select"
                    v-model="teachersItem"
                  >
                    <option value="" disabled selected>Choose A Teacher</option>
                    <option
                      v-for="(teacher, index) in schedultItems"
                      :key="index"
                      :value="teacher"
                    >
                      {{ teacher ? teacher.first_name : "" }}
                      {{ teacher ? teacher.last_name : "" }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="time d-flex gap-5">
                <div class="mb-2 w-50 d-flex flex-column">
                  <label for="recipient-name" class="col-form-label"
                    >Class:</label
                  >
                  <select
                    name="room"
                    id="room"
                    class="form-select"
                    v-model="classesItem"
                    @change="changeClass"
                  >
                    <option value="" disabled selected>Choose A Class</option>
                    <option
                      v-for="(classItem, index) in schedultItems"
                      :key="index"
                      :value="classItem"
                    >
                      {{ classItem ? classItem.name : "No class" }}
                    </option>
                  </select>
                </div>
                <div class="mb-2 w-50 d-flex flex-column">
                  <label for="recipient-name" class="col-form-label"
                    >Room:</label
                  >
                  <select
                    name="room"
                    id="room"
                    class="form-select"
                    v-model="roomsItem"
                  >
                    <option value="" disabled selected>Choose A Room</option>
                    <option
                      v-for="(room, index) in rooms"
                      :key="index"
                      :value="room"
                    >
                      {{ room ? room.roomName : "" }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="time d-flex gap-5">
                <div class="mb-2 w-50">
                  <label for="message-text" class="col-form-label"
                    >Start Date:</label
                  >
                  <input
                    type="date"
                    id="date"
                    class="form-control"
                    v-model="startDate"
                  />
                </div>
                <div class="mb-2 w-50">
                  <label for="message-text" class="col-form-label"
                    >End Date:</label
                  >
                  <input
                    type="date"
                    id="date"
                    class="form-control"
                    v-model="endDate"
                  />
                </div>
              </div>
              <div class="time d-flex gap-5">
                <div class="mb-2 w-50">
                  <label for="message-text" class="col-form-label"
                    >Start-Time:</label
                  >
                  <input
                    type="time"
                    id="date"
                    class="form-control"
                    v-model="startTime"
                  />
                </div>
                <div class="mb-2 w-50">
                  <label for="message-text" class="col-form-label"
                    >End-time:</label
                  >
                  <input
                    type="time"
                    id="date"
                    min="00:00"
                    max="23:59"
                    required
                    class="form-control"
                    v-model="endTime"
                  />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              ref="closeDialog"
              class="close btn btn-secondary"
              id="closeDialog"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button
              type="button"
              class="add btn btn-primary m-2"
              @click="createSchedule"
            >
              Add
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { axiosClient } from "../../axios-http";
import NavBar from "../../components/navbar/NavigationBar.vue";
import { storeManageCookie } from "../../store/cookie";
import { AES, enc } from "crypto-js";
export default {
  components: {
    NavBar,
  },
  props: [],
  emits: ["createSchedule"],
  setup() {
    const getRole = storeManageCookie();
    return { getRole };
  },
  data() {
    return {
      subjectsItem: "",
      teachersItem: "",
      classesItem: "",
      roomsItem: "",
      startDate: "",
      endDate: "",
      startTime: "",
      endTime: "",
      teachers: [],
      rooms: [],
      course: [],
      classes: [],
      role: AES.decrypt(
        this.getRole.getCookie("user_role"),
        "Secret role"
      ).toString(enc.Utf8),
      dialog: false,
    };
  },
  watch: {},
  methods: {
    changeCourse() {
      // Call to api teacher by query course_id
      console.log("this.subjectsItem.id", this.subjectsItem.id);
      if (this.subjectsItem && this.subjectsItem.id) {
        axiosClient
          .get(`/teachers/?course_id=${this.subjectsItem.id}`)
          .then((response) => {
            this.teachers = response.data.data;
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    listItems(path) {
      axiosClient
        .get(path)
        .then((response) => {
          let data = response.data.data;
          if(path === 'courses') {
            this.course = data;
          } else if (path === 'teachers') {
            this.teachers = data;
          } else if (path === 'classes') {
            this.classes = data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    changeClass() {
      if (this.classesItem && this.classesItem.id) {
        axiosClient
          .get(`/classes/?room_id=${this.classesItem.id}`)
          .then((response) => {
            this.rooms = response.data.data;
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    listRooms() {
      axiosClient
        .get("/rooms")
        .then((response) => {
          this.rooms = response.data.data;
          if (this.rooms) {
            this.rooms.map((item) => {
              item.roomName = item.name;
              delete item.name;
              return item;
            });
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    closeDialog() {
      this.$refs.closeDialog.click();
    },
    createSchedule() {
      let schedule = {
        course_id: this.subjectsItem.id,
        teacher_id: this.teachersItem.id,
        class_id: this.classesItem.id,
        room_id: this.roomsItem.id,
        start_date: `${this.startDate}T${this.startTime}:00`,
        end_date: `${this.endDate}T${this.endTime}:00`,
        start_time: this.startTime,
        end_time: this.endTime,
      };
      axiosClient
        .post(`/schedule`, schedule)
        .then((response) => {
          console.log("res", response.data);
          this.$emit("createSchedule");
          this.closeDialog();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    // this.listCourses();
    // this.listTeachers();
    // this.listClasses();
    this.listRooms();
    this.listItems('courses');
    this.listItems('teachers');
    this.listItems('classes');
  },
};
</script>

<style>
#subject,
#teacher,
#room,
#date {
  background: #d6d6d6ab;
}

.add-schedule,
.add {
  background: #3788D8;
}

.close {
  background: gray;
}
</style>
