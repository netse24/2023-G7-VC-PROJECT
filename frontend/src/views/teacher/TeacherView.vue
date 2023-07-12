<template>
  <section>
    <NavBar />
    <div
      class="m-3"
      style="
        --bs-breadcrumb-divider: url(
          &#34;data:image/svg + xml,
          %3Csvgxmlns='http://www.w3.org/2000/svg'width='8'height='8'%3E%3Cpathd='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z'fill='%236c757d'/%3E%3C/svg%3E&#34;
        );
      "
      aria-label="breadcrumb"
    >
      <ol class="breadcrumb">
        <li class="breadcrumb-item" v-if="breadCrumb.length > 0" >
          <a href="/teacher">Home</a>
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
  props: ['breadcrumbs'],
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
      this.breadCrumb = [];
      this.breadCrumb.push(
        {
          title: `${this.schoolItems[index].title}`,
          href: `/teachers/${this.schoolItems[index].title.toLowerCase()}`,
        }
      );
      this.breadCrumb.forEach(path => {
          if(path) {
            this.$router.push(`/teachers/${path.title.toLowerCase()}`);    
          }else {
            this.$router.push('/404');
          }
      });
    },
  },
};
</script>
<style>
.card {
  box-shadow: #00000029 0px 3px 6px, #0000003b 0px 3px 6px;
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
a {
  text-decoration: none;
  color: black;
}
</style>