<template>
  <section>
    <NavBar />
    <v-breadcrumbs :items="breadCrumb"></v-breadcrumbs>
    <div class="mt-5 w-100 px-2">
      <div
        class="w-100 m-auto row row-cols-1 row-cols-md-4 row-cols-sm-2 d-flex justify-content-center gap-6"
      >
        <div
          class="card text-center mb-3"
          style="width: 15rem"
          @click="onClickCategory(index)"
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
import NavBar from "./../../components/navbar/NavigationBar.vue";
export default {
  data() {
    return {
      breadCrumb: [],
      schoolItems: [
        {
          title: "Background",
          image: require("../../assets/user-background.png"),
        },
        { title: "Schedule", image: require("../../assets/schedule.png") },
        { title: "Assignment", image: require("../../assets/assignment.png") },
        { title: "Transcript", image: require("../../assets/transcript.png") },
        { title: "Curriculum", image: require("../../assets/curriculum.png") },
      ],
    };
  },
  components: {
    NavBar,
  },
  methods: {
    onClickCategory(index) {
      console.log(this.schoolItems[index]);
      this.breadCrumb = [];
      this.breadCrumb.push({ title: 'Home', href:'/teachers'}, { title: `${this.schoolItems[index].title}`, href: `/teachers/${this.schoolItems[index].title.toLowerCase()}` });
    }
  }
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
