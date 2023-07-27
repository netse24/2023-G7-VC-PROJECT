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
      <div class="feedback w-75 m-auto">
        <h5>Latest Feedback</h5>
        <div class="card-info p-2 my-2 d-flex">
          <div class="img w-25 h-25 d-flex">
            <img class="w-25 h-25"
              src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRo_2n4ixhk90E0WEDNpghs_skGLtJZuMNCGfqyiBtnwoKRjd8DRZxCgLlmGYCwm9fuGAg&usqp=CAU"
              alt="" />
            <div class="user-info ml-2 d-flex flex-column justify-content-start">
              <h5>Rady</h5>
              <p>Good job A++</p>
            </div>
          </div>
        </div>
        <div class="card-info p-2 my-2 d-flex">
          <div class="img w-25 h-25 d-flex">
            <img class="w-25 h-25"
              src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRo_2n4ixhk90E0WEDNpghs_skGLtJZuMNCGfqyiBtnwoKRjd8DRZxCgLlmGYCwm9fuGAg&usqp=CAU"
              alt="" />
            <div class="user-info ml-2 d-flex flex-column justify-content-start">
              <h5>Rady</h5>
              <p>Good job A++</p>
            </div>
          </div>
        </div>
        <div class="card-info p-2 my-2 d-flex">
          <div class="img w-25 h-25 d-flex">
            <img class="w-25 h-25"
              src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRo_2n4ixhk90E0WEDNpghs_skGLtJZuMNCGfqyiBtnwoKRjd8DRZxCgLlmGYCwm9fuGAg&usqp=CAU"
              alt="" />
            <div class="user-info ml-2 d-flex flex-column justify-content-start">
              <h5>Rady</h5>
              <p>Good job A++</p>
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