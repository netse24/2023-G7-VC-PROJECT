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
          <router-link :to="`/admin/students/term/${this.$router.currentRoute.value.query.user_id}?generation_id=${this.$router.currentRoute.value.query.generation_id}`">Back</router-link>
        </button>
      </div>
    </div>
    <!-- part table transcript -->
    <div class="container-transcript w-[60%] m-auto" v-if="studentList != null">
      <div class="head-transcript transcript mt-3">
        <h1 class="text-xl font-bold d-flex justify-center uppercase">
          Student Transcript
        </h1>
        <div class="user-transcript-info">
          <div class="name font-bold d-flex justify-between mt-3">
            <div class="first-name-batch">
              <p>
                First Name:
                <span class="ml-2">{{ studentList.user.first_name }}</span>
              </p>
              <p class="mt-3">
                Batch: <span class="ml-2">{{ studentList.generation }}</span>
              </p>
            </div>
            <div class="last-name-class">
              <p>
                Last Name:
                <span class="ml-2">{{ studentList.user.last_name }}</span>
              </p>
              <p class="mt-3">
                Class: <span class="ml-2">{{ studentList.class }}</span>
              </p>
            </div>
          </div>
          <div class="name font-bold d-flex justify-between mt-3">
            <div class="first-name-batch">
              <p>
                Term:
                <span class="ml-2">{{ this.termName }}</span>
              </p>
            </div>
          </div>
          <hr class="mt-2" />
          <div class="term d-flex justify-between items-center mt-5">
            <div class="d-flex items-center">
              <span class="font-bold pr-3">Course: </span>
              <select
                name="subject"
                v-model="selectedCourse"
                class="form-control inputstl border-1 border-zinc-500 w-52 text-black"
              >
                <option value="" disabled>Select Subject</option>
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
                v-model="score"
                class="form-control inputstl border-1 border-zinc-500 w-52"
              />
            </div>
            <button
              @click="createScore"
              class="bg-cyan-500 hover cursor-pointer hover:bg-cyan-600 font-bold py-2 px-4 rounded"
            >
              Add Score
            </button>
          </div>
        </div>
        <div class="table-transcript mt-5 mb-10">
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
                    Action
                  </th>
                </tr>
              </thead>
              <tbody v-for="(score, index) in scoreSubjects" :key="index">
                <tr v-if="score.term.id == term_id && score.student.id == studentList.id">
                  <td class="border-x border-y border-gray-500 py-2 px-4">
                    {{ score.course }}
                  </td>
                  <td
                    class="border-x border-y border-gray-500 py-2 px-4"
                    :class="{ red: score.score < 50 }"
                  >
                    {{ score.score }}
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4">
                    <button
                      type="button"
                      data-bs-target="#editModal"
                      data-bs-toggle="modal"
                      @click="editScore(score.id)"
                      class="text-cyan-500 hover cursor-pointer hover:underline"
                    >
                      Edit
                    </button>
                    |
                    <button
                      type="button"
                      @click="score_id = score.id"
                      class="text-red-600 hover cursor-pointer hover:underline"
                      data-bs-target="#deleteModal"
                      data-bs-toggle="modal"
                    >
                      Delete
                    </button>
                    <!-- Edit Score dialog -->
                    <div class="modal fade" id="editModal">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header bg-cyan-600 text-white">
                            <h5 class="modal-title" id="exampleModalLabel">
                              EDIT STUDENT SCORE
                            </h5>
                          </div>
                          <div
                            class="modal-body d-flex flex-col justify-around items-start h-auto"
                          >
                            <div class="d-flex items-center m-2">
                              <span class="font-bold pr-3">Course: </span>
                              <select
                                name="subject"
                                v-model="scoreList.course"
                                class="form-control inputstl border-1 border-zinc-500 w-80 text-black"
                              >
                                <option value="" disabled>
                                  Select Subject
                                </option>
                                <option
                                  v-for="(courses, index) in courseList"
                                  :key="index"
                                  :value="courses.course"
                                >
                                  {{ courses.course }}
                                </option>
                              </select>
                            </div>
                            <div class="d-flex items-center m-2">
                              <span class="font-bold pr-3">Score: </span>
                              <input
                                type="number"
                                v-model="scoreList.score"
                                class="form-control inputstl border-1 border-zinc-500 w-80 ml-3"
                              />
                            </div>
                          </div>
                          <div class="modal-footer d-flex justify-between">
                            <button
                              type="button"
                              class="bg-gray-500 text-white hover cursor-pointer hover:bg-gray-600 font-bold py-2 px-4 rounded"
                              data-bs-dismiss="modal"
                            >
                              Cancel
                            </button>
                            <button
                              type="button"
                              @click="updateScore"
                              class="bg-cyan-600 text-white hover cursor-pointer hover:bg-cyan-700 font-bold py-2 px-4 rounded"
                              data-bs-dismiss="modal"
                            >
                              Edit
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Delete Score -->
                    <div class="modal fade" id="deleteModal">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header bg-red-500 text-white">
                            <h5 class="modal-title" id="exampleModalLabel">
                              DELETE STUDENT SCORE
                            </h5>
                          </div>
                          <div
                            class="modal-body d-flex justify-start items-center h-20"
                          >
                            <p>Are you sure you want to delete score?</p>
                          </div>
                          <div class="modal-footer d-flex justify-between">
                            <button
                              type="button"
                              class="bg-gray-500 text-white hover cursor-pointer hover:bg-gray-600 font-bold py-2 px-4 rounded"
                              data-bs-dismiss="modal"
                            >
                              No
                            </button>
                            <button
                              type="button"
                              @click="deleteScore"
                              class="bg-red-500 text-white hover cursor-pointer hover:bg-red-600 font-bold py-2 px-4 rounded"
                              data-bs-dismiss="modal"
                            >
                              Yes
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            
              <tfoot v-if="!isNaN(checkTotalScore(scoreSubjects))">
                <tr>
                  <th class="border-x border-y border-gray-500 py-2 px-4">
                    Total
                  </th>
                  <th class="border-x border-y border-gray-500 py-2 px-4">
                    {{checkTotalScore(scoreSubjects) }}
                  </th>
                  <th class="border-x border-y border-gray-500 py-2 px-4"></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { axiosClient } from "@/axios-http";
export default {
  props: ["term_id"],
  data() {
    return {
      courseId: "",
      termName: "",
      score: "",
      courseList: [],
      termList: [],
      scoreSubjects: [],
      selectedCourse: "",
      dialog: false,
      students: [],
      studentList: null,
      score_id: null,
      scoreList: [],
    };
  },
  methods: {
    getScoreSubject() {
      console.log(this.$router)
      axiosClient.get("scores").then((res) => {
        this.scoreSubjects = res.data.data;
        console.log(this.scoreSubjects);
      });
    },
    getCourse() {
      axiosClient
        .get("courses")
        .then((response) => {
          this.courseList = response.data.data;
        })
        .catch((err) => console.log(err));
    },

    showDialog() {
      this.dialog = true;
    },
    getTerm() {
      axiosClient
        .get("term")
        .then((response) => {
          this.termList = response.data.data;
          this.termList.forEach((termId) => {
            if (termId.id == this.term_id) {
              this.termName = termId.term;
            }
          });
        })
        .catch((err) => console.log(err));
    },
    getStudentById() {
      axiosClient
        .get("students/" + this.$router.currentRoute.value.query.user_id)
        .then((res) => {
          this.studentList = res.data.data;
        });
    },
    createScore() {
      let scoreList = {
        course_id: this.courseId,
        student_id: this.studentList.id,
        score: this.score,
        term_id: this.term_id,
      };
      if (this.courseId !== "" && this.score !== "") {
        axiosClient
          .post("scores", scoreList)
          .then((response) => {
            console.log(response.data);
            location.reload();
          })
          .catch((error) => {
            console.error(error);
          });
      } else {
        alert("Input must be field out");
      }
      this.selectedCourse = "";
      this.courseId = "";
      this.score = "";
    },
    editScore(index) {
      axiosClient
        .get("getScoreById/" + index)
        .then((response) => {
          this.scoreList = response.data.data;
          console.log(this.scoreList);
        })
        .catch((error) => {
          console.error(error);
        });
    },
    updateScore() {
      this.courseList.forEach((course) => {
        if (course.course == this.scoreList.course) {
          console.log(course.id);
          let scores = {
            course_id: course.id,
            student_id: this.studentList.id,
            score: this.scoreList.score,
            term_id: this.term_id,
          };
          console.log(scores);
          if (this.scoreList != null) {
          axiosClient
            .put("scores/" + this.scoreList.id, scores)
            .then((response) => {
                console.log(response.data.data);
                 this.getScoreSubject();
            })
            .catch((error) => {
              console.error(error);
            });
        }
        }
        
      });
    },

    deleteScore() {
      axiosClient
        .delete("scores/" + this.score_id)
        .then((response) => {
          console.log(response.data.message);
          this.getScoreSubject();
        })
        .catch((error) => {
          console.error(error);
        });
    },
    checkTotalScore(scoreSubjects) {
      let scores = 0;
      scoreSubjects.forEach((score) => {
        if (score.term.id == this.term_id && score.student.id == this.studentList.id) {
          scores += score.score;
          
        }
      });
      return scores;
    },
  },
  mounted() {
    this.getCourse();
    this.getStudentById();
    this.getTerm();
    this.getScoreSubject();
  },
  computed: {
    totalScore() {
      let totalScore = null;
      this.scoreSubjects.forEach((subject) => {
        totalScore += subject.score;
      });
      return totalScore;
    },
  },
  watch: {
    selectedCourse(selectedCourse) {
      this.courseList.forEach((course) => {
        if (course.course == selectedCourse) {
          this.courseId = course.id;
        }
      });
    },
  },
};
</script>
<style scoped>
.red {
  color: red;
}
</style>
