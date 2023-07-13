<template>
  <section>
    <nav-bar />
    <div class="d-flex gap-5 mt-3  w-75 p-3">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold border border-blue-700 rounded w-20">
        <router-link to="/admin/students">back</router-link>
      </button>
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold border border-blue-700 rounded w-28">
        Update
      </button>
      <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded w-28">
        Delete
      </button>
      <button
        class="bg-orange-800 hover:bg-orange-700 text-white font-bold py-2 px-4 border border-orange-700 rounded w-30">
        See More
      </button>
    </div>
    <hr />
    <div class="d-flex gap-9 mb-3 my-3 justify-center">
      <button v-for="(student, index) in students" :key="index"
        class="bg-teal-600 hover:bg-teal-700 text-white font-bold border border-orange-700 rounded-full w-1/12 p-2">
        {{ student.class }}
      </button>
    </div>
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8 w-100 flex justify-center">
          <div class="overflow-hidden w-[90%]">
            <table class="min-w-full text-center text-sm font-dark">
              <thead class="border-b font-medium dark:border-neutral-500">
                <tr class="bg-cyan ">
                  <th scope="col" class="px-4 py-4">First Name</th>
                  <th scope="col" class="px-4 py-4">Last Name</th>
                  <th scope="col" class="px-4 py-4">Email</th>
                  <th scope="col" class="px-4 py-4">Gender</th>
                  <th scope="col" class="px-4 py-4">Birthday</th>
                  <th scope="col" class="px-4 py-4">Address</th>
                </tr>
              </thead>
              <tbody v-for="(student, index) in students" :key="index">
                <tr
                  class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-300">
                  <td class="whitespace-nowrap px-4 py-4">{{ student.user.first_name }}</td>
                  <td class="whitespace-nowrap px-4 py-4">{{ student.user.last_name }}</td>
                  <td class="whitespace-nowrap px-4 py-4">{{ student.user.email }}</td>
                  <td class="whitespace-nowrap px-4 py-4">{{ student.user.gender }}</td>
                  <td class="whitespace-nowrap px-4 py-4">{{ student.user.date_of_birth }}</td>
                  <td class="whitespace-nowrap px-4 py-4">{{ student.user.address }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { axiosClient } from '../../axios-http'
export default {
  props: ['id'],
  data() {
    return {
      classes: [],
      students: [],
    };
  },
  methods: {
    getStudentData() {
      axiosClient.get('generations/' + this.id).then((res) => {
        this.students = res.data.data
        console.log(res.data.data);
      }).catch(err => console.log(err))
    }
  },
  mounted() {
    this.getStudentData()
  },
};
</script>

<style></style>
