<template>
  <div class="mt-5 w-100 px-2">
    <div
      class="w-100 m-auto row row-cols-1 row-cols-md-4 row-cols-sm-2 d-flex justify-content-center gap-6"
    >
      <div
        class="card text-center mb-3"
        style="width: 15rem"
        v-for="schoolItem in schoolItems"
        :key="schoolItem"
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
</template>
<script>
export default {
  data() {
    return {
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
  created() {
    console.log(`Here is data ${this.schoolItems}`);
  },
};
</script>
<style>
.card {
  box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
  border: 5px solid #000;
  background: #000;
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
