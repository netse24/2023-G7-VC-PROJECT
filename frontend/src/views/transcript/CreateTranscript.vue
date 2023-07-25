<template>
  <section>
    <nav-bar />
    <div class="container-btn-term">
      <div class="group-btn ml-5">
        <button
          class="bg-cyan-500 hover:bg-cyan-600 font-bold py-2 px-4 rounded m-2"
        >
          <router-link to="/admin">Home</router-link>
        </button>
        <button
          class="bg-cyan-500 hover:bg-cyan-600 font-bold py-2 px-4 rounded m-2"
        >
          <router-link to="/admin">Back</router-link>
        </button>
      </div>
    </div>
    <!-- part table transcript -->
    <div class="container-transcript w-[60%] m-auto" v-if="students != null">
      <div class="head-transcript transcript mt-3">
        <h1 class="text-xl font-bold d-flex justify-center uppercase">
          Student Transcript
        </h1>
        <div class="user-transcript-info">
          <div class="name font-bold d-flex justify-between mt-3">
            <div class="first-name-batch">
              <p>First Name: <span class="ml-2">{{students.user.first_name }}</span></p>
              <p class="mt-3">Batch: <span class="ml-2">{{students.generation }}</span></p>
            </div>
            <div class="last-name-class">
              <p>Last Name: <span class="ml-2">{{students.user.last_name}}</span></p>
              <p class="mt-3">Class: <span class="ml-2">{{students.class}}</span></p>
            </div>
          </div>
          <hr class="mt-2" />

          <div class="term d-flex justify-between items-center mt-5">
            <div class="d-flex items-center">
              <span class="font-bold pr-3">Subject: </span>
              <select
                name="subject"
                id=""
                v-model="selectedCourse"
                class="form-control inputstl border-1 border-zinc-500 w-52"
              >
                <option value="" disabled>Choose subject</option>
                <option
                  v-for="(courses, index) in courseList"
                  :key="index"
                  :value="courses.course"
                >
                  {{ courses.course }}
                </option>
              </select>
            </div>
            <div class="d-flex items-center">
              <span class="font-bold pr-3">Score: </span>
              <input
                type="number"
                class="form-control inputstl border-1 border-zinc-500 w-52"
              />
            </div>
            <button
              class="bg-cyan-500 hover cursor-pointer hover:bg-cyan-600 font-bold py-2 px-4 rounded"
            >
              Add Score
            </button>
          </div>
        </div>
        <div class="table-transcript mt-5">
          <div class="mt-3">
            <table class="min-w-full text-center">
              <thead>
                <tr>
                  <th class="border-x border-y border-gray-500 py-2 px-4">
                    Course title
                  </th>
                  <th class="border-x border-y border-gray-500 py-2 px-4">
                    Score
                  </th>
                  <th class="border-x border-y border-gray-500 py-2 px-4">
                    Grade
                  </th>
                  <th class="border-x border-y border-gray-500 py-2 px-4">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="border-x border-y border-gray-500 py-2 px-4">
                    HTML
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4">
                    50
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4">E</td>
                  <td class="border-x border-y border-gray-500 py-2 px-4">
                    <button
                      class="text-cyan-500 hover cursor-pointer hover:underline"
                    >
                      Edit
                    </button>
                    |
                    <button
                      class="text-red-600 hover cursor-pointer hover:underline"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th class="border-x border-y border-gray-500 py-2 px-4">
                    Total
                  </th>
                  <th class="border-x border-y border-gray-500 py-2 px-4"></th>
                  <th class="border-x border-y border-gray-500 py-2 px-4"></th>
                  <th class="border-x border-y border-gray-500 py-2 px-4"></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <div class="d-flex justify-end">
        <button
          class="bg-cyan-500 hover:bg-cyan-600 font-bold py-2 px-4 border border-blue-700 rounded mt-5"
          @click="showDialog"
          :disabled="scoreSubjects.length == 0"
          :style="
            scoreSubjects.length > 1 || scoreSubjects.length == 0
              ? 'background-color: gray'
              : 'background-color: bg-blue-700'
          "
        >
          <p>Add Transcript</p>
          <v-dialog class="w-50" v-model="dialog">
            <h1 class="d-flex justify-center text-h5 bg-cyan pa-5">
              Create Transcript
            </h1>
            <v-sheet width="auto" class="pa-5 pb-7">
              <v-form>
                <v-row class="d-flex">
                  <v-col>
                    <v-text-field
                      required
                      density="compact"
                      v-model="title"
                      label="Enter Transcript title"
                      :rules="titleRules"
                      prepend-inner-icon="mdi mdi-file-document"
                    >
                    </v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col>
                    <v-text-field
                      density="compact"
                      v-model="term"
                      label="Enter Term"
                      :rules="termRules"
                      prepend-inner-icon="mdi mdi-calendar-text"
                    >
                    </v-text-field>
                  </v-col>
                </v-row>
                <v-list class="d-flex justify-space-between mt-2">
                  <v-btn
                    type="button"
                    class="bg-grey-lighten-1"
                    @click="this.dialog = false"
                    >CANCEL</v-btn
                  >
                  <v-btn
                    type="submit"
                    class="bg-cyan"
                    @click="this.dialog = false"
                    >Add</v-btn
                  >
                </v-list>
              </v-form>
            </v-sheet>
          </v-dialog>
        </button>
      </div>
    </div>
  </section>
</template>
<script>
import { axiosClient } from "@/axios-http";
export default {
  props: ["student_id"],
  data() {
    return {
      scoreSubjects: [],
      courseList: [],
      selectedCourse: "",
      dialog: false,
      students: null,
      titleRules: [
        (value) => {
          if (value) return true;
          return "Transcript title must be filled out";
        },
      ],

      termRules: [
        (value) => {
          if (value) return true;
          return "Term must be filled out";
        }
      ],
    };
  },
  methods: {
    getCourse() {
      axiosClient
        .get("courses")
        .then((response) => {
          this.courseList = response.data.data;
          console.log(this.courseList);
        })
        .catch((err) => console.log(err));
    },
    showDialog() {
      this.dialog = true;
    },
    getStudent() {
      axiosClient
        .get("students/" + this.student_id)
        .then((res) => {
          this.students = res.data.data;
          console.log(this.students);
        })
    },
  },
  mounted() {
    this.getCourse();
    this.getStudent();
  },
};
</script>
