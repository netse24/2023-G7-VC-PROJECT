<template>
  <section>
    <nav-bar></nav-bar>
    <div class="container-btn-term d-flex items-center mt-2">
      <div class="group-btn ml-5 mr-2">
        <button class="bg-cyan-500 hover:bg-cyan-600 font-bold px-2 rounded">
          <p class="text-white py-2">Home</p>
        </button>
      </div>
      <div v-for="(term, index) of terms" :key="index" @click="selectedTerm = term.term">
        <button class="bg-cyan-500 hover:bg-cyan-600 font-bold px-2 rounded mx-2" :class="termBtn(term.term)">
          <p class="text-white py-2" :value="term.id">Term {{ term.term }}</p>
        </button>
      </div>
    </div>
    <!-- part table transcript -->
    <div class="container-transcript w-[40%] m-auto">
      <div id="My_table" class="head-transcript transcript">
        <div class="logo-tex d-flex items-end w-full h-auto">
          <div class="logo justify-start pl-2 w-[40%]">
            <img :src="require('../../assets/school-1.png')" class="w-[40%] pl-2" />
            <hr class="h-[2px] w-[44%] rounded bg-dark opacity-100" />
            <h1 class="pl-5 font-bold">SMS</h1>
          </div>
          <h1 class="text-2xl font-bold justify-center uppercase w-full pl-6 pb-3">
            official transcript
          </h1>
        </div>
        <div class="user-transcript-info" v-if="terms.length > 0 && student !== null">
          <div class="name font-bold d-flex justify-between mt-4">
            <div class="first-name-batch">
              <p>
                First Name: <span>{{ student.user.first_name }}</span>
              </p>
              <p class="mt-3">
                Last Name: <span>{{ student.user.last_name }}</span>
              </p>
            </div>
            <div class="last-name-class">
              <p>
                Class: <span>{{ student.class }}</span>
              </p>
              <p class="mt-3">
                Batch: <span>{{ student.generation }}</span>
              </p>
            </div>
          </div>
          <div class="term font-bold d-flex justify-between mt-3">
            <p>
              <span>Term {{ selectedTerm }}</span>
            </p>
          </div>
        </div>
        <div class="table-transcript">
          <div class="mt-3">
            <table class="min-w-full text-center" v-if="StudentCourseScores != null">
              <thead>
                <tr>
                  <th class="border-x border-y border-gray-500 py-2 px-4">
                    Courses (Subjects)
                  </th>
                  <th class="border-x border-y border-gray-500 py-2 px-4">
                    Score
                  </th>
                  <th class="border-x border-y border-gray-500 py-2 px-4">
                    Grade
                  </th>
                </tr>
              </thead>
              <tbody v-for="(data, index) of StudentCourseScores.courseScores" :key="index">
                <tr v-if="data.term == selectedTerm">
                  <td class="border-x border-y border-gray-500 py-2 px-4">
                    {{ data.course }}
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4"
                    :class="data.score < 50 ? 'text-red-500' : 'text-dark'">
                    {{ data.score }}
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4" v-if="data.score >= 90 && data.score <= 100">
                    A
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4"
                    v-else-if="data.score >= 80 && data.score <= 89">
                    B
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4"
                    v-else-if="data.score >= 70 && data.score <= 79">
                    C
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4"
                    v-else-if="data.score >= 60 && data.score <= 69">
                    D
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4"
                    v-else-if="data.score >= 50 && data.score <= 59">
                    E
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4 text-red-500" v-else-if="data.score < 50">
                    F
                  </td>
                </tr>
              </tbody>
              <tfoot v-if="!isNaN(checkTotal(StudentCourseScores.courseScores))">
                <tr>
                  <th class="border-x border-y border-gray-500 py-2 px-4">
                    Total
                  </th>

                  <th class="border-x border-y border-gray-500 py-2 px-4">
                    {{ checkTotal(StudentCourseScores.courseScores) }}
                  </th>
                  <td class="border-x border-y border-gray-500 py-2 px-4" v-if="checkTotal(StudentCourseScores.courseScores) >= 90 &&
                    checkTotal(StudentCourseScores.courseScores) <= 100
                    ">
                    A
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4" v-else-if="checkTotal(StudentCourseScores.courseScores) >= 80 &&
                    checkTotal(StudentCourseScores.courseScores) <= 89
                    ">
                    B
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4" v-else-if="checkTotal(StudentCourseScores.courseScores) >= 70 &&
                    checkTotal(StudentCourseScores.courseScores) <= 79
                    ">
                    C
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4" v-else-if="checkTotal(StudentCourseScores.courseScores) >= 60 &&
                    checkTotal(StudentCourseScores.courseScores) <= 69
                    ">
                    D
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4" v-else-if="checkTotal(StudentCourseScores.courseScores) >= 50 &&
                    checkTotal(StudentCourseScores.courseScores) <= 59
                    ">
                    E
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4 font-bold text-red-500" v-else-if="checkTotal(StudentCourseScores.courseScores) < 50
                    ">
                    F
                  </td>
                </tr>
              </tfoot>
              <tfoot v-else>
                <tr>
                  <td class="border-x border-y border-gray-500 py-2 px-4 font-bold text-red-500" colspan="3">
                    You don't have Score yet for this term!
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <div class="admin-provider font-semibold" v-if="isAdmin != null">
          <h1 class="pt-2"> Phnom Penh, {{ currentDate }}</h1>
          <h1>{{ isAdmin.first_name + ' ' + isAdmin.last_name }},</h1>
          <h1> School Principal</h1>
        </div>
      </div>
      <div class="btn-download" v-if="role != null && role == 'student'">
        <div class="download d-flex justify-end pt-4">
          <button
            class="bg-cyan-500 hover:bg-cyan-700 text-white focus:ring-1 focus:ring-cyan-300 font-semibold py-2 px-3 rounded text-sm"
            @click="downloadPDF()">
            Donwload
          </button>
        </div>
      </div>
    </div>

    <!-- part show teacher commnet to their student! -->
    <div class="teacher-permission" v-if="role != null && role == 'teacher'">
      <div class="show-comment w-[40%] m-auto mt-3" v-if="feedbacks.length > 0">
        <div
          class="comment-teacher"
          v-for="(feedback, index) in feedbacks"
          :key="index"
        >
          <div
            class="profile-and-comment w-100 bg-gray-200 mt-2 p-2 rounded"
            v-if="feedback.term.term == selectedTerm"
          >
            <div class="teacher-name-profile d-flex items-center">
              <img
                :src="require('../../assets/AdminSeeTeacherDeatil.png')"
                class="border w-[45px] h-[45px] rounded-full"
              />
              <strong class="ml-3"
                >{{ feedback.teachers.user.first_name }}
                {{ feedback.teachers.user.last_name }}</strong
              >
            </div>
            <div class="w-100 text ml-15 d-flex justify-between items-center">
              <p class="w-75">
                <strong>{{ feedback.teachers.course.course_name }}</strong> :
                {{ feedback.feedback }}
              </p>
              <div class="w-[30%]">
                <button
                  class="pr-1 font-semibold text-sm"
                  @click="updateFeedback(feedback)"
                >
                  Edit
                </button>|
                <button>
                  <v-dialog
                    class="w-5/12"
                    v-model="dialogDelete">
                    <template v-slot:activator="{ props }">
                      <v-text
                        class="pr-1 font-semibold text-sm"
                        v-bind="props"
                        @click="feedbackID = feedback.id"
                        >Delete</v-text
                      >
                    </template>
                    <v-card>
                      <v-card-title class="border-gray-200 bg-cyan-500">
                        Delete Comment of student
                      </v-card-title>
                      <v-card-text>
                        <v-container class="d-flex justify-start">
                          <p>Do you want to delete this comment</p>
                        </v-container>
                      </v-card-text>
                      <v-card-actions class="d-flex justify-end gap-5">
                        <div>
                          <v-btn class="bg-cyan" color="font-normal font-bold" variant="text" @click="dialogDelete = false">Cancel</v-btn>
                          <v-btn class="bg-red text-white w-20" color="font-normal text-1xl font-bold" @click="deleteFeedback(dialogDelete = false)">Delete</v-btn>
                        </div>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- part btn comment  -->
      <div class="comment-teacher w-[40%] m-auto mt-3">
        <div class="container-comment">
          <div class="group-comment">
            <label class="block text-gray-700 text-md font-bold mb-2" for="username">
              Comment
            </label>
            <textarea
              name="feedback"
              id="feedback"
              cols="70"
              rows="3"
              class="border rounded p-2"
              placeholder="Write a comment..."
              v-model="writeFeedback"
            ></textarea>
            <div class="group-btn d-flex justify-end">
              <div class="btn-cancel p-1">
                <button
                  class="focus:ring-1 focus:ring-neutral-300 font-semibold py-2 px-3 rounded text-sm"
                  @click="clearData"
                >
                  Cancel
                </button>
              </div>
              <div class="btn-comment p-1">
                <button class="focus:ring-1 focus:ring-cyan-300 font-semibold py-2 px-3 rounded text-sm"
                  @click="addComment">
                  Comment
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { storeManageCookie } from "@/store/cookie";
import { axiosClient } from "../../axios-http";
import { AES, enc } from "crypto-js";
import jsPDF from "jspdf";
import html2canvas from "html2canvas";
export default {
  setup() {
    const userCookie = storeManageCookie();
    return {
      userCookie,
    };
  },
  data() {
    return {
      currentDate: null,
      isAdmin: null,
      dialogDelete:false,
      getId: null,
      role: null,
      isDownloading: false,
      isDetail: false,
      pdfBaseUrl: null,
      terms: [],
      selectedTerm: null,
      student: null,
      StudentCourseScores: null,
      totalScore: 0,
      writeFeedback: "",
      feedbackID: null,
      feedbacks: [],
      getTermName: null,
    };
  },
  props: ["user_id"],
  methods: {
    async getRole() {
      this.role = AES.decrypt(
        this.userCookie.getCookie("user_role"),
        "Secret role"
      ).toString(enc.Utf8);

      this.getId = AES.decrypt(
        this.userCookie.getCookie("user_id"),
        "Secret id"
      ).toString(enc.Utf8);


      // we have only one admin. 
      const res = await axiosClient.get('users');
      res.data.data.forEach((findAdmin) => {
        if (findAdmin.role_id == 1) {
          this.isAdmin = findAdmin
        }
      })
    },

    //zzzcode.ia (key_search: How to get current date like this 03rd April 2023 in vue js)
    getCurrentData() {
      const currentDate = new Date();
      const day = currentDate.getDate();
      const month = currentDate.toLocaleString('default', { month: 'long' });
      const year = currentDate.getFullYear();
      const suffix = this.getOrdinalSuffix(day);
      this.currentDate = `${day}${suffix} ${month} ${year},`;
    },
    getOrdinalSuffix(day) {
      if (day >= 11 && day <= 13) {
        return 'th';
      }
      switch (day % 10) {
        case 1:
          return 'st';
        case 2:
          return 'nd';
        case 3:
          return 'rd';
        default:
          return 'th';
      }
    },

    //Download transcript function 
    downloadPDF() {
      this.isDetail = true;
      const element = document.getElementById("My_table");
      html2canvas(element).then((canvas) => {
        const image = canvas.toDataURL("image/png");
        const pdf = new jsPDF();
        const imgProps = pdf.getImageProperties(image);
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
        pdf.addImage(image, "JPEG", 10, 10, pdfWidth - 20, pdfHeight - 20);
        //Name of file after download
        const fileName = `transcript${this.selectedTerm}.pdf`;
        pdf.save(fileName);
        this.isDetail = false;
      });
    },

    async getTerm() {
      const response = await axiosClient.get("term");
      this.terms = response.data.data;
    },
    termBtn(term) {
      return {
        selected: term === this.selectedTerm,
      };
    },
    async getStudent() {
      const response = await axiosClient.get("students/" + this.user_id);
      this.student = response.data.data;
    },
    async getStudentCourseScore() {
      const response = await axiosClient.get("scores/" + this.user_id);
      this.StudentCourseScores = response.data.data;
    },

    checkTotal(courseScores) {
      let scores = 0;
      let length = 0;
      courseScores.forEach((score) => {
        if (score.term == this.selectedTerm) {
          scores += score.score;
          length++;
        }
      });
      return scores / length;
    },
    clearData() {
      this.writeFeedback = "";
      this.feedbackID = null;
    },
    updateFeedback(info) {
      this.writeFeedback = info.feedback;
      this.feedbackID = info.id;
      this.getTermName = info.term.term;
      console.log(info);
    },
    async addComment() {
      let newFeedback = {
        feedback: this.writeFeedback,
        student_id: this.user_id,
        teacher_id: this.getId,
        term_id: this.selectedTerm,
      };
      if (this.feedbackID != null && this.role == "teacher") {
        console.log("id ", this.feedbackID);
        await axiosClient
          .put(`feedback/${this.feedbackID}`, newFeedback)
          .then((response) => {
            this.getFeedback();
            console.log(response);
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        await axiosClient.post("feedback", newFeedback);
        this.writeFeedback = "";
      }
      this.clearData();
    },
    async deleteFeedback(){
      if(this.feedbackID !== null && this.role == 'teacher'){
        const response = await axiosClient.delete('feedback/'+ this.feedbackID);
        location.reload();
        this.getFeedback();
        console.log(response.data.message);
      }
    }
  },
  mounted() {
    this.getRole();
    this.getFeedback();
    this.getTerm();
    this.getStudent();
    this.getStudentCourseScore();
  },

  created() {
    this.selectedTerm = localStorage.getItem("selectedTerm");
  },
  watch: {
    selectedTerm(value) {
      localStorage.setItem("selectedTerm", value);
    },
  },
};
</script>

<style scoped>
button.selected {
  background-color: rgb(217, 142, 2);
}

textarea {
  resize: none;
  border: 1px solid gray;
}

textarea:focus {
  outline-color: #48b8f4;
}

#My_table {
  height: 76vh;
}
</style>
