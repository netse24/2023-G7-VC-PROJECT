<template>
  <section>
    <nav-bar />
    <div class="mt-5 w-100 px-2">
      <div class="w-100 m-auto row row-cols-1 row-cols-md-4 row-cols-sm-2 d-flex justify-content-center gap-6">
        <div class="card text-center mb-3" style="width: 15rem" @click="onClickCategory(schoolItem)"
          v-for="(schoolItem, index) in schoolItems" :key="index">
          <div class="card-body">
            <h5 class="card-title">{{ schoolItem.title }}</h5>
            <div class="d-flex justify-content-center">
              <img :src="schoolItem.image" alt="" />
            </div>
          </div>
        </div>
      </div>
      <div class="feedback w-75 m-auto" v-if="feedbacks.length > 0">
        <h5 class="text-xl font-semibold">Latest Feedback</h5>
        <div class="over-flow" style="overflow: scroll; height: 40vh;">
          <div class="card-info p-2 my-2 d-flex" v-for="(feedback, index) of feedbacks" :key="index">
            <div class="img w-25 h-25 d-flex">
              <img class="w-25 h-25" :src="require('../../assets/AdminSeeTeacherDeatil.png')" alt="" />
              <div class="user-info ml-2 d-flex flex-column justify-content-start">
                <h5 class="font-semibold">{{ feedback.teachers.user.first_name + ' ' + feedback.teachers.user.last_name }}
                </h5>
                <p class="w-[63rem] pt-2 d-flex justify-content-between items-center" v-if="index == 0"><span>{{
                  feedback.feedback }}</span> <span class="bg-orange-500 p-1 rounded text-white">newest</span> </p>

                <p class="pt-2" v-if="index > 0">{{ feedback.feedback }}</p>
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
import { axiosClient } from "@/axios-http";
export default {
  setup() {
    const userCookie = storeManageCookie()
    return {
      userCookie
    }
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
          image: require("../../assets/schedule.png")
        },
        { title: "Transcript", image: require("../../assets/transcript.png") },
      ],
      feedbacks: [],
    };
  },
  methods: {
    onClickCategory(action) {
      if (action.title == 'Background') {
        this.$router.push(`/students/background/${AES.decrypt(this.userCookie.getCookie("user_id"), "Secret id").toString(enc.Utf8)}`);
      }
      else if (action.title == 'Schedule') {
        this.$router.push('/students/schedule')
      }
      else if (action.title == 'Transcript') {
        this.$router.push(`/students/transcript/${AES.decrypt(this.userCookie.getCookie("user_id"), "Secret id").toString(enc.Utf8)}`);
      }
    },
    async getFeedback() {
      const response = await axiosClient.get('feedback/' + AES.decrypt(this.userCookie.getCookie("user_id"), "Secret id").toString(enc.Utf8));
      if (response.status == 200) {
        this.feedbacks = response.data.data.feedbacks.slice().reverse();
      }
    }
  },
  mounted() {
    this.getFeedback();
    localStorage.setItem("selectedTerm", '01');
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

.card h5 {
  padding: 5px;
  background: #48b8f4;
}

.card-info {
  border-radius: 7px;
  background: #d0cfcfda;
}

img {
  border-radius: 50%;
}
</style>