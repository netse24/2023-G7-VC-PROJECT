<template>
  <section>
    <Navbar/>
    <v-breadcrumbs :items="breadCrumb"></v-breadcrumbs>
    <div class="mt-5 w-100 ">
      <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2 w-75 m-auto px-1 d-flex justify-content-center gap-10">
        <!-- <div class="card text-center mb-3" style="width: 18rem" v-for="schoolItem in schoolItems" :key="schoolItem"> -->
        <div
          class="card text-center mb-3"
          style="width: 18rem"
          v-for="(schoolItem,  index) in schoolItems"
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
import Navbar from "./../../components/navbar/NavigationBar.vue";
export default {
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
  components:{
    Navbar
  },
  methods: {
    onClickCategory(index) {
      this.breadCrumb = [];
      this.breadCrumb.push({ title: 'Home', href:'/admin'}, { title: `${this.schoolItems[index].title}`, href: `/admin/${this.schoolItems[index].title.toLowerCase()}`});
    }
  },
};
</script>
<style>
.card:hover {
  cursor: pointer;
  transition: ease-in-out 0.1s;
  border: 2px solid #48b8f4;
}
/* h5 {
  background: #48b8f4;
} */
</style>