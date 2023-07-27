<template>
  <section>
    <nav-bar />
    <div class="mt-5 w-100 px-2">
      <div
        class="w-100 m-auto row row-cols-1 row-cols-md-4 row-cols-sm-2 d-flex justify-content-center gap-6"
      >
        <div
          class="card text-center mb-3"
          style="width: 15rem"
          @click="onClickCategory(schoolItem)"
          v-for="(schoolItem, index) in schoolItems"
          :key="index"
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
  </section>
</template>
<script>
import { storeManageCookie } from "@/store/cookie";
import { AES, enc } from "crypto-js";

export default {
  setup() {
    const userCookie = storeManageCookie();
    return {
      userCookie,
    };
  },
  data() {
    return {
      user_id: null,
      breadCrumb: [],
      schoolItems: [
        {
          title: "Background",
          image: require("../../assets/user-background.png"),
        },
        {
          title: "Schedule",
          image: require("../../assets/schedule.png"),
        },
        {
          title: "Feedback",
          image: require("../../assets/assignment.png"),
        },
      ],
    };
  },

  methods: {
    onClickCategory(schoolItem) {
      if (schoolItem.title.toLowerCase() == "background") {
        this.$router.push(
          `/teachers/background/${AES.decrypt(
            this.userCookie.getCookie("user_id"),
            "Secret id"
          ).toString(enc.Utf8)}`
        );
      } else if (schoolItem.title.toLowerCase() == "schedule") {
        this.$router.push("/teacher/schedule");
      } else if (schoolItem.title.toLowerCase() == "feedback") {
        this.$router.push("/teacher/students");
      }
    },
  },
};
</script>
<style>
.card {
  box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
}

.card:hover {
  cursor: pointer;
  transition: ease-in-out 0.1s;
  border: 2px solid #48b8f4;
}

h5 {
  padding: 5px;
  background: #48b8f4;
}
</style>
