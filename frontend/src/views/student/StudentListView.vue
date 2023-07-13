<template>
  <section>
    <div class="d-flex gap-5 mb-5 w-75 p-14">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded w-28">
        Back
      </button>
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded w-28">
        Update
      </button>
      <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded w-28">
        Delete
      </button>
      <button
        class="bg-orange-800 hover:bg-orange-700 text-white font-bold py-2 px-4 border border-orange-700 rounded w-28">
        See More
      </button>
    </div>
    <hr />
    <div class="d-flex gap-9 mb-3 my-4 justify-center">
      <button v-for="(student, index) in students" :key="index" click="showStudentList"
        class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 border border-orange-700 rounded-full w-2/12">
        {{ student.class }}
      </button>

      <div class="d-flex gap-5 mb-3 my-4 justify-center">
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          fill="none" viewBox="0 0 14 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 5H1m0 0 4 4M1 5l4-4" />
        </svg>
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          fill="none" viewBox="0 0 14 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M1 5h12m0 0L9 1m4 4L9 9" />
        </svg>
      </div>
    </div>
    <div class="d-flex justify-center">
      <table class="border w-10/12 border-collapse">
        <thead class="bg-teal-600 text-left text-xl text-white">
          <tr>
            <th></th>
            <th>First name</th>
            <th>Last name</th>
            <th>Gender</th>
          </tr>
        </thead>
        <tbody v-for="(student, index) in classes" :key="index">
          <tr>
            <td><input id="default-checkbox" type="checkbox" value="{{student.id}}" /></td>
            <td>{{ student.first_name }}</td>
            <td>{{ student.last_name }}</td>
            <td>{{ student.gender }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>
<script>
export default {
  data() {
    return {
      classes: [],
      students: [],
    };
  },
  // methods: {
  //   getClass() {
  //     axios.get("http://127.0.0.1:8000/api/user").then((res) => {
  //       this.classes = res.data.data
  //       console.log(this.classes);
  //     })
  //   },
  //   getStudent() {
  //     axios.get("http://127.0.0.1:8000/api/student").then((res) => {
  //       this.students = res.data.data;
  //       console.log(this.students);
  //     });
  //   },
  //   showStudentList() {

  //   }
  // },
  // mounted() {
  //   this.getClass()
  //   this.getStudent();
  // },
};
</script>

<style></style>
