<template>
  <section>
    <nav-bar />
    <div class="m-3"
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
      aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" v-if="breadCrumb.length > 0">
          <a href="/admin">Home</a>
        </li>
        <li
          class="breadcrumb-item"
          aria-current="page"
          v-for="(item, index) in breadCrumb"
          :key="index"
        >
          <a :href="item.href"> {{ item.title }}</a>
        </li>
      </ol>
    </div>
    <form-create-user @teacher-emit="createUser" @student-emit="createUser" />
    <div class="mt-5 w-100">
      <div
        class="row row-cols-1 row-cols-md-4 row-cols-sm-2 w-75 m-auto px-1 d-flex justify-content-center gap-10"
      >
        <div
          class="card text-center mb-3"
          style="width: 18rem"
          v-for="(schoolItem, index) in schoolItems"
          :key="index"
          @click="onClickCategory(index)"
        >
          <div class="card-body">
            <h5 class="card-title">{{ schoolItem.title }}</h5>
            <div class="d-flex justify-content-center">
              <img :src="schoolItem.image" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- </div> -->
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
      userInfo,
    };
  },
  data() {
    return {
      breadCrumb: [],
      schoolItems: [
        { title: "Teachers", image: require("../../assets/teacher.png") },
        { title: "Students", image: require("../../assets/student.png") },
        { title: "Schedule", image: require("../../assets/schedule.png") },
      ],
    };
  },
  methods: {
    onClickCategory(index) {
      this.breadCrumb = [];
      this.breadCrumb.push({
        title: `${this.schoolItems[index].title}`,
        href: `/admin/${this.schoolItems[index].title.toLowerCase()}`,
      });
      this.breadCrumb.forEach((path) => {
        if (path) {
          this.$router.push(`/admin/${path.title.toLowerCase()}`);
        } else {
          this.$router.push("/404");
        }
      });
    },
    async createUser(userInfo) {
      await axiosClient
        .post("users", userInfo)
        .then((response) => {
          console.log(response.data);
          if (response.status == 201) {
            // console.log("User created")
            Swal.fire({
              position: "center",
              icon: "success",
              title: "User created succressfully",
              showConfirmButton: false,
              timer: 2000,
            });
          }
         
        })
        .catch((error) => {
          console.error(error.message);
        });
    },
  },
};
</script>
<style>
.card:hover {
  cursor: pointer;
  transition: ease-in-out 0.1s;
  border: 2px solid #48b8f4;
}
</style>
