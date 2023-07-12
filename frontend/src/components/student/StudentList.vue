<template>
  <section>
    <div class="d-flex gap-5 mb-5 w-75">
      <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded w-28"
      >
        Back
      </button>
      <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded w-28"
      >
        Update
      </button>
      <button
        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded w-28"
      >
        Delete
      </button>
      <button
        @click="getDetail"
        class="bg-orange-800 hover:bg-orange-700 text-white font-bold py-2 px-4 border border-orange-700 rounded w-28">
        See More
      </button>
    </div>
    <hr />
    <div class="d-flex gap-9 mb-3 my-4 justify-center">
      <button
        class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 border border-orange-700 rounded-full w-2/12"
      >
        Class
      </button>
      <button
        class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 border border-orange-700 rounded-full w-2/12"
      >
        Class
      </button>
      <button
        class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 border border-orange-700 rounded-full w-2/12"
      >
        Class
      </button>
      <div class="d-flex gap-5 mb-3 my-4 justify-center">
        <svg
          class="w-6 h-6 text-gray-800 dark:text-white"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 14 10"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M13 5H1m0 0 4 4M1 5l4-4"
          />
        </svg>
        <svg
          class="w-6 h-6 text-gray-800 dark:text-white"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 14 10"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M1 5h12m0 0L9 1m4 4L9 9"
          />
        </svg>
      </div>
    </div>
    <table class="border-collapse border w-10/12 m-auto">
      <thead class="bg-teal-600">
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Gender</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(student, index) in students" :key="index">
          <td class="border border-slate-300 py-2 px-4 ml-2">
            <input
              id="default-checkbox"
              type="checkbox"
              v-model="selectedUsers"
              :value="student.id"
              class="accent-emerald-500/25 w-4 h-4 rounded text-center"
            />{{ student.user.first_name }}
          </td>
          <td class="border border-slate-300 ...">
            {{ student.user.last_name }}
          </td>
          <td class="border border-slate-300...">{{ student.user.gender }}</td>
        </tr>
      </tbody>
    </table>
  </section>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      classes: [],
      students: [],
      selectedUsers: [],
      isSelected: false,
    };
  },
  methods: {
    getStudent() {
      axios.get("http://127.0.0.1:8000/api/student").then((res) => {
        this.students = res.data.data;
        
      });
    },
    getDetail() {
      if (this.selectedUsers.length > 1) {
        confirm('can not detail');
      } else {
        let user_id = this.selectedUsers
        axios.get("http://127.0.0.1:8000/api/student/"+ user_id).then((res) => {
            console.log(res.data);
        }).catch(err=> console.error(err))
      }
    },
  },
  mounted() {
    this.getStudent();
  },
};
</script>

<style>
</style>