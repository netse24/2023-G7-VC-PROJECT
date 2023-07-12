<template>
  <section >
    <NavBar/>
    <button
      type="button"
      class="btn btn-primary m-2"
      data-bs-toggle="modal"
      data-bs-target="#exampleModal"
      data-bs-whatever="@mdo"
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
            <form>
              <div class="time d-flex gap-5">
              <div class="mb-2 w-50 d-flex flex-column">
                <label for="recipient-name" class="col-form-label"
                  >Subject:</label
                >
                <select name="subject" id="subject" class="form-select" v-model="subjectName">
                  <option value="" disabled selected>Choose A Subject</option>
                  <option
                    v-for="(subject, index) in itemSubjects"
                    :key="index"
                    :value="subject"
                  >
                    {{ subject }}
                  </option>
                </select>
              </div>
              <div class="mb-2 w-50 d-flex flex-column">
                <label for="recipient-name" class="col-form-label"
                  >Teacher:</label
                >
                <select name="teacher" id="teacher" class="form-select" v-model="teacherName">
                  <option value="" disabled selected>Choose A Teacher</option>
                  <option
                    v-for="(teacher, index) in teachers"
                    :key="index"
                    :value="teacher"
                  >
                    {{ teacher }}
                  </option>
                </select>
              </div>
              </div>
              <div class="time d-flex gap-5">
              <div class="mb-2 w-50 d-flex flex-column">
                <label for="recipient-name" class="col-form-label">Class:</label>
                <select name="room" id="room" class="form-select" v-model="className">
                  <option value="" disabled selected>Choose A Class</option>
                  <option
                    v-for="(room, index) in rooms"
                    :key="index"
                    :value="room"
                  >
                    {{ room }}
                  </option>
                </select>
              </div>
              <div class="mb-2 w-50 d-flex flex-column">
                <label for="recipient-name" class="col-form-label">Room:</label>
                <select name="room" id="room" class="form-select" v-model="roomName">
                  <option value="" disabled selected>Choose A Room</option>
                  <option
                    v-for="(room, index) in rooms"
                    :key="index"
                    :value="room"
                  >
                    {{ room }}
                  </option>
                </select>
              </div>
              </div>
              <div class="time d-flex gap-5">
              <div class="mb-2 w-50">
                <label for="message-text" class="col-form-label">Start Date:</label>
                <input type="date" id="date" class="form-control" v-model="startDate" />
              </div>
              <div class="mb-2 w-50">
                <label for="message-text" class="col-form-label">End Date:</label>
                <input type="date" id="date" class="form-control" v-model="endDate" />
              </div>
              </div>
              <div class="time d-flex gap-5">
                <div class="mb-2 w-50">
                  <label for="message-text" class="col-form-label"
                    >Start-Time:</label
                  >
                  <input type="time" id="date" class="form-control" v-model="startTime" />
                </div>
                <div class="mb-2 w-50">
                  <label for="message-text" class="col-form-label"
                    >End-time:</label
                  >
                  <input type="time" id="date" class="form-control" v-model="endTime" />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary">Add Schedule</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import NavBar from "../../components/navbar/NavigationBar.vue";
export default {
  components: {
    NavBar
  },
  props: [],
  emits: [],
  data() {
    return {
      dialog: false,
      subjectName: "",
      nameRules: [
        (value) => {
          if (value) return true;
          return "Required";
        },
      ],
      selectTeacher: "",
      teachers: ["Rady", "Him", "Yon", "Mengheang"],
      selectRoom: "",
      rooms: ["B31", "B12", "B13", "B23"],
      selectSubject: "",
      itemSubjects: ["VueJs", "NodeJs", "Laravel", "PHP", "JavaScript", "HTML"],
    };
  },
  watch: {},
  methods: {},
  mounted() {},
};
</script>

<style>
#subject,
#teacher,
#room,
#date {
  background: #d6d6d6ab;
}
</style>