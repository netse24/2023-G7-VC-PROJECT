<template>
  <div class="mt-5 w-100 ">
    <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2 w-75 m-auto px-1 d-flex justify-content-center gap-10">
      <div class="card text-center mb-3" style="width: 18rem" v-for="schoolItem in schoolItems" :key="schoolItem">
        <div class="card-body">
          <h5 class="card-title">{{ schoolItem.title }}</h5>
          <div class="d-flex justify-content-center" >
            <img
              
              :src="schoolItem.image"
              alt=""
            />
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
        {title: "Students", image: require("../../assets/student.png")},
        {title: "Teachers", image: require("../../assets/teacher.png")},
        {title: "Schedule", image: require("../../assets/schedule.png")},
      ],
    };
  },
  created() {
    console.log(`Here is data ${this.schoolItems}`);
  }
};
</script>
<style>
.card:hover {
  cursor: pointer;
  transition:ease-in-out 0.1s;
  border: 2px solid #48b8f4;
}
</style>