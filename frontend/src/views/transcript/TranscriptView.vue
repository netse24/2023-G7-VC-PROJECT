<template>
  <section>
    <nav-bar></nav-bar>
    <div class="container-btn-term d-flex items-center">
      <div class="group-btn ml-5 ">
        <button class="bg-cyan-500 hover:bg-cyan-600  font-bold px-2 rounded">
          <p class="text-white py-2 ">
            Home
          </p>
        </button>
      </div>
      <div v-for="(term, index) of terms" :key="index" @click="selectedTerm = term.term">
        <button class="bg-cyan-500 hover:bg-cyan-600  font-bold px-2 rounded mx-2 " :class="termBtn(term.term)">
          <p class="text-white py-2 " :value="term.id">
            Term {{ term.term }}
          </p>
        </button>
      </div>
    </div>
    <!-- part table transcript -->
    <div class="container-transcript w-[40%] m-auto">
      <div id="My_table" class="head-transcript transcript">
        <div class="logo-tex d-flex items-end w-full h-auto">
          <div class="logo justify-start pl-2 w-[40%]">
            <img :src="require('../../assets/school-1.png')" class="w-[40%] pl-2" />
            <hr class=" h-[2px] w-[44%] rounded bg-dark opacity-100">
            <h1 class="pl-5 font-bold">SMS</h1>
          </div>
          <h1 class="text-2xl font-bold justify-center uppercase w-full pl-6 pb-3">official transcript</h1>
        </div>
        <div class="user-transcript-info" v-if="terms.length > 0 && student !== null">
          <div class="name font-bold d-flex justify-between mt-4">
            <div class="first-name-batch ">
              <p>First Name: <span>{{ student.user.first_name }}</span></p>
              <p class="mt-3">Last Name: <span>{{ student.user.last_name }}</span></p>
            </div>
            <div class="last-name-class ">
              <p>Class: <span>{{ student.class }}</span></p>
              <p class="mt-3">Batch: <span>{{ student.generation }}</span></p>
            </div>
          </div>
          <div class="term font-bold d-flex justify-between mt-3">
            <p><span>Term {{ selectedTerm }}</span></p>
          </div>
        </div>
        <div class="table-transcript">
          <div class=" mt-3">
            <table class="min-w-full text-center" v-if="StudentCourseScores != null">
              <thead>
                <tr>
                  <th class="border-x border-y border-gray-500 py-2 px-4">Courses (Subjects)</th>
                  <th class="border-x border-y border-gray-500 py-2 px-4">Score</th>
                  <th class="border-x border-y border-gray-500 py-2 px-4">Grade</th>
                </tr>
              </thead>
              <tbody v-for="(data, index) of StudentCourseScores.courseScores" :key="index">
                <tr v-if="data.term == selectedTerm">
                  <td class="border-x border-y border-gray-500 py-2 px-4"> {{ data.course }}</td>
                  <td class="border-x border-y border-gray-500 py-2 px-4"
                    :class="data.score < 50 ? 'text-red-500' : 'text-dark'">{{ data.score }}</td>
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
                  <th class="border-x border-y border-gray-500 py-2 px-4">Total</th>

                  <th class="border-x border-y border-gray-500 py-2 px-4">{{ checkTotal(StudentCourseScores.courseScores)
                  }}
                  </th>
                  <td class="border-x border-y border-gray-500 py-2 px-4"
                    v-if="checkTotal(StudentCourseScores.courseScores) >= 90 && checkTotal(StudentCourseScores.courseScores) <= 100">
                    A
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4"
                    v-else-if="checkTotal(StudentCourseScores.courseScores) >= 80 && checkTotal(StudentCourseScores.courseScores) <= 89">
                    B
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4"
                    v-else-if="checkTotal(StudentCourseScores.courseScores) >= 70 && checkTotal(StudentCourseScores.courseScores) <= 79">
                    C
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4"
                    v-else-if="checkTotal(StudentCourseScores.courseScores) >= 60 && checkTotal(StudentCourseScores.courseScores) <= 69">
                    D
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4"
                    v-else-if="checkTotal(StudentCourseScores.courseScores) >= 50 && checkTotal(StudentCourseScores.courseScores) <= 59">
                    E
                  </td>
                  <td class="border-x border-y border-gray-500 py-2 px-4 font-bold text-red-500"
                    v-else-if="checkTotal(StudentCourseScores.courseScores) < 50">
                    F
                  </td>
                </tr>

              </tfoot>
              <tfoot v-else>
                <tr >
                  <td class="border-x border-y border-gray-500 py-2 px-4 font-bold text-red-500" colspan="3" >
                    You don't have Score yet for this term!
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        </div>
        <div class="btn-download" v-if="role != null && role == 'student'">
          <div class="download d-flex justify-end pt-4">
            <button 
              class=" bg-cyan-500 hover:bg-cyan-700 text-white focus:ring-1 focus:ring-cyan-300 font-semibold py-2 px-3 rounded text-sm" @click="downloadPDF()">
              Donwload 
            </button>
          </div>
        </div>
      </div>

    <!-- part show teacher commnet to their student! -->
    <div class="teacher-permission" v-if="role != null && role == 'teacher'">
      <div class="show-comment w-[40%] m-auto mt-3">
        <div class="comment-teacher">
          <div class="profile-and-comment w-100 bg-gray-200 mt-2 p-2 rounded" v-for="(feedback,index) in feedbacks" :key="index">
            <div class="teacher-name-profile d-flex items-center">
              <img :src="require('../../assets/AdminSeeTeacherDeatil.png')"
                class="border  w-[45px] h-[45px] rounded-full">
              <strong class="ml-3">{{ feedback.first_name }} {{ feedback.last_name }}</strong>
            </div>
            <div class="w-100 text ml-15 d-flex  justify-between items-center">
              <p class="w-75"> <strong>{{ feedback.course }}</strong> : {{ feedback.feedback }}</p>
              <div class="w-[30%]">
                <button class="pr-1  font-semibold text-sm">Edit</button> |
                <button class="pl-1 font-semibold text-sm hover-red">Delete</button>
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
            <input class="border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none "
              id="username" type="text" placeholder="Write a comment..." v-model="writeFeedback">
            <div class="group-btn d-flex justify-end">
              <div class="btn-cancel p-1">
                <button
                  class=" focus:ring-1 focus:ring-neutral-300 font-semibold py-2 px-3 rounded text-sm">Cancel</button>
              </div>
              <div class="btn-comment p-1">
                <button class="focus:ring-1 focus:ring-cyan-300 font-semibold py-2 px-3 rounded text-sm" @click="addComment">Comment</button>
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
import { axiosClient } from "../../axios-http"
import { AES, enc } from "crypto-js";
import jsPDF from 'jspdf';
import html2canvas from 'html2canvas';
export default {
  setup() {
    const userCookie = storeManageCookie()
    return {
      userCookie,
    }
  },
  data() {
    return {
      role: null,
      isDownloading: false,
      isDetail: false,
      pdfBaseUrl:null,
      terms: [],
      selectedTerm: null,
      student: null,
      StudentCourseScores: null,
      totalScore: 0,
      writeFeedback: "",
      feedbacks: [
        {first_name: "Rady", last_name: "Y", course: "Vue.js", feedback: "Good job! improment point: Be active to volunteer to answer the question"},
        {first_name: "Lavy", last_name: "Hou", course: "PL", feedback: "Good job! improment point: Be active to volunteer to answer the question"},
        {first_name: "Narin", last_name: "Noeurn", course: "English", feedback: "Good job! improment point: Practice your English speaking"},
      ]
    }
  },
  props: ['user_id'],
  methods: {
    getRole() {
      this.role = AES.decrypt(this.userCookie.getCookie("user_role"), "Secret role").toString(enc.Utf8);
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
          const fileName = "transcript.pdf";
          pdf.save(fileName);
          this.isDetail = false;
          this.getRole();
        });
    },
  
    async getTerm() {
      const response = await axiosClient.get('term');
      this.terms = response.data.data
    },
    termBtn(term) {
      return {
        selected: term === this.selectedTerm
      }
    },
    async getStudent() {
      const response = await axiosClient.get('students/' + this.user_id);
      this.student = response.data.data
    },
    async getStudentCourseScore() {
      const response = await axiosClient.get('scores/' + this.user_id);
      this.StudentCourseScores = response.data.data;

    },

    checkTotal(courseScores) {
      let scores = 0;
      let length = 0;
      courseScores.forEach(score => {
        if (score.term == this.selectedTerm) {
          scores += score.score
          length++
        }
      });
      return scores / length
    },
  },
  mounted() {
    this.getRole();
    this.getTerm();
    this.getStudent()
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

}

</script>

<style scoped>
button.selected {
  background-color: rgb(217, 142, 2);
}
</style>
