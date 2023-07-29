<template>
  <section>
    <nav-bar />
    <form-create-user @teacher-emit="createUser" @student-emit="createUser" />
    <div class="mt-5 w-100 ">
      <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2 w-75 m-auto px-1 d-flex justify-content-center gap-10">
        <div class="card text-center mb-3" style="width: 18rem" v-for="(schoolItem, index) in schoolItems" :key="index"
          @click="onClickCategory(index)">
          <div class="card-body">
            <h5 class="card-title">{{ schoolItem.title }}</h5>
            <div class="d-flex justify-content-center">
              <img :src="schoolItem.image" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <header class="w-full d-flex justify-center">
      <h1 class="text-2xl uppercase pt-3 font-bold">Amount of users</h1>
    </header>
    <div class="mt-3 w-full" v-if="students.length > 0 || teachers.length > 0">
      <div class="col col-rows-1 row-cols-md-4 row-cols-sm-2 w-50 m-auto d-flex justify-center gap-10">
        <div class="card text-center mb-3" style="width: 18rem" v-for="(list) in 2" :key="list">
          <div class="card-body d-flex " v-if="list == 1">
            <div class="img mr-2">
              <img :src="require('../../assets/teacher_profile.png')" class="w-[3.5rem] p-1 rounded-full bg-cyan-500"
                alt="">
            </div>
            <div class="text-container">
              <h5 class="card-title">TEACHERS</h5>
              <div class="d-flex justify-content-center">
                TOTAL : {{ teachers.length }}
              </div>
            </div>
          </div>
          <div class="card-body d-flex " v-else>
            <div class="img mr-2">
              <img :src="require('../../assets/student_profile.png')" class="w-[4.5rem] rounded-full" alt="">
            </div>
            <div class="text-container">
              <h5 class="card-title">STUDENTS</h5>
              <div class="d-flex justify-content-center">
                TOTAL : {{ students.length }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>

import { axiosClient } from "@/axios-http";
import { userInformations } from "@/store/userStore";
import Swal from "sweetalert2";

export default {
  setup() {
    const userInfo = userInformations();
    return {
      userInfo
    }
  },
  data() {
    return {
      students: [],
      teachers: [],
      breadCrumb: [],
      schoolItems: [
        {
          title: "Teachers",
          image: require("../../assets/teacher.png")
        },
        {
          title: "Students",
          image: require("../../assets/student.png")
        },
        {
          title: "Schedule",
          image: require("../../assets/schedule.png")
        },
      ],
    };
  },
  methods: {
    onClickCategory(index) {
      this.breadCrumb = [];
      this.breadCrumb.push({ title: `${this.schoolItems[index].title}`, href: `/admin/${this.schoolItems[index].title.toLowerCase()}` });
      this.breadCrumb.forEach(path => {
        if (path) {
          this.$router.push(`/admin/${path.title.toLowerCase()}`);
        } else {
          this.$router.push('/404');
        }
      });
    },
    async createUser(userInfo) {
      await axiosClient.post("users", userInfo)
        .then((response) => {
          if (response.status == 201) {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'User created succressfully',
              showConfirmButton: false,
              timer: 2000
            })
          }
        })
        .catch((error) => {
          console.error(error.message);
        });
    },
    async getAllTeachersAndStudents() {
      const responseteachers = await axiosClient.get('teachers');
      this.teachers = responseteachers.data.data;

      const responseStudents = await axiosClient.get('students');
      this.students = responseStudents.data.data;
    },
  },
  mounted() {
    this.getAllTeachersAndStudents();
  }
};
</script>
<style scoped>
.card {
  box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
}

.card:hover {
  cursor: pointer;
  transition: ease-in-out 0.1s;
  border: 2px solid #48b8f4;
}
</style>
