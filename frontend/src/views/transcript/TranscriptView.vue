<template>
  <section>
    <nav-bar />
    <div class="container-btn-term d-flex items-center">
      <div class="group-btn ml-5 ">
        <button class="bg-cyan-500 hover:bg-cyan-600  font-bold px-2 rounded">
          <p class="text-white py-2 ">
            Home
          </p>
        </button>
      </div>
      <div>
        <button class="bg-cyan-500 hover:bg-cyan-600  font-bold px-2 rounded m-2">
          <p class="text-white py-2 ">
            Term 01
          </p>
        </button>
      </div>
    </div>
    <!-- part table transcript -->
    <div class="container-transcript w-[40%] m-auto">
      <div class="head-transcript transcript ">
        <div class="logo-tex d-flex items-end w-ful h-auto">
          <div class="logo justify-start pl-2 w-[40%]">
            <img :src="require('../../assets/school-1.png')" class="w-[40%] pl-2" />
            <hr class=" h-[2px] w-[44%] rounded bg-dark opacity-100">
            <h1 class="pl-5 font-bold">SMS</h1>
          </div>
          <h1 class="text-2xl font-bold justify-center uppercase w-full pl-6 pb-3">official transcript</h1>
        </div>
        <div class="user-transcript-info">
          <div class="name font-bold d-flex justify-between mt-4">
            <div class="first-name-batch ">
              <p>First Name: <span>Net</span></p>
              <p class="mt-3">Last Name: <span>Se</span></p>
            </div>
            <div class="last-name-class ">
              <p>Class: <span>WEP A</span></p>
              <p class="mt-3">Batch: <span>2023</span></p>
            </div>
          </div>
          <div class="term font-bold d-flex justify-between mt-3">
            <p><span> Term 01</span></p>
          </div>
        </div>
        <div class="table-transcript">
          <div class=" mt-3">
            <table class="min-w-full text-center">
              <thead>
                <tr>
                  <th class="border-x border-y border-gray-500 py-2 px-4">Courses (Subjects)</th>
                  <th class="border-x border-y border-gray-500 py-2 px-4">Score</th>
                  <th class="border-x border-y border-gray-500 py-2 px-4">Grade</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="border-x border-y border-gray-500 py-2 px-4">HTML</td>
                  <td class="border-x border-y border-gray-500 py-2 px-4">50</td>
                  <td class="border-x border-y border-gray-500 py-2 px-4">E</td>
                </tr>
                <tr>
                  <td class="border-x border-y border-gray-500 py-2 px-4">OOP</td>
                  <td class="border-x border-y border-gray-500 py-2 px-4">50</td>
                  <td class="border-x border-y border-gray-500 py-2 px-4">E</td>
                </tr>
                <tr>
                  <td class="border-x border-y border-gray-500 py-2 px-4">PHP</td>
                  <td class="border-x border-y border-gray-500 py-2 px-4">50</td>
                  <td class="border-x border-y border-gray-500 py-2 px-4">E</td>
                </tr>
                <tr>
                  <td class="border-x border-y border-gray-500 py-2 px-4">DB</td>
                  <td class="border-x border-y border-gray-500 py-2 px-4">50</td>
                  <td class="border-x border-y border-gray-500 py-2 px-4">E</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th class="border-x border-y border-gray-500 py-2 px-4">Total</th>
                  <th class="border-x border-y border-gray-500 py-2 px-4">200</th>
                  <th class="border-x border-y border-gray-500 py-2 px-4">E</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <div class="btn-download" v-if="role != null && role == 'student'">
        <div class="download d-flex justify-end pt-4">
          <button
            class=" bg-cyan-500 hover:bg-cyan-700 text-white focus:ring-1 focus:ring-cyan-300 font-semibold py-2 px-3 rounded text-sm">
            Donwload </button>
        </div>
      </div>
    </div>

    <!-- part show teacher commnet to their student! -->
    <div class="teacher-permission" v-if="role != null && role == 'student'">
      <div class="show-comment w-[40%] m-auto mt-3">
        <div class="comment-teacher">
          <div class="profile-and-comment bg-gray-200 p-2 rounded ">
            <div class="teacher-name-profile d-flex items-center">
              <img :src="require('../../assets/AdminSeeTeacherDeatil.png')"
                class="border  w-[45px] h-[45px] rounded-full">
              <strong class="ml-3">Chan Chav</strong>
            </div>
            <div class="text ml-15 d-flex  justify-between items-center">
              <p> <strong>PHP</strong> : Good job! You did it.</p>
              <div>
                <button class="pr-1  font-semibold text-sm">Edit</button> |
                <button class="pl-1 font-semibold text-sm">Delete</button>
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
              id="username" type="text" placeholder="Write a comment...">
            <div class="group-btn d-flex justify-end">
              <div class="btn-cancel p-1">
                <button
                  class=" focus:ring-1 focus:ring-neutral-300 font-semibold py-2 px-3 rounded text-sm">Cancel</button>
              </div>
              <div class="btn-comment p-1">
                <button class="focus:ring-1 focus:ring-cyan-300 font-semibold py-2 px-3 rounded text-sm">Comment</button>
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
import { AES, enc } from "crypto-js";

export default {
  setup() {
    const userCookie = storeManageCookie()
    return {
      userCookie
    }
  },
  data() {
    return {
      role: null,
    }
  },
  props: ['student_id'],
  methods: {
    getRole() {
      this.role = AES.decrypt(this.userCookie.getCookie("user_role"), "Secret role").toString(enc.Utf8);
    }
  },
  mounted() {
    this.getRole();
  }

}

</script>