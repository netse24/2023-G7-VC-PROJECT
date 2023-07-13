<template>
  <section class="w-10/12 m-auto">
    <div class="flex gap-2 my-2">
      <button
        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 border-blue-700 rounded w-28">Back</button>
      <button
        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 border-blue-700 rounded w-28">Update</button>
      <button
        class="btn bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 border-red-800 rounded w-28">Delete</button>
      <button class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold rounded w-28">
        <v-dialog v-if="selectedUsers.length > 1 || selectedUsers.length == 0" class="w-50" v-model="dialog">
          <template v-slot:activator="{ props }">
            <v-text v-bind="props">See more</v-text>
          </template>
          <v-card>
            <v-card-title class="border-gray-200 bg-cyan-500">Detail User</v-card-title>
            <v-card-text>
              <v-container class="d-flex justify-start">
                <p v-if="selectedUsers.length > 1">You can detail only 1 user one time</p>
                <p v-else>Please select checkbox</p>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-btn color="font-normal text-1xl font-bold" variant="text" @click="dialog = false">OK
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <div v-else>
          <router-link :to="`/admin/batch/student_detail/${selectedUsers}`">See more</router-link>
        </div>
      </button>
    </div>
    <hr class="w-full h-0.5 bg-gray-300 dark:bg-cyan-900" />
    <div class="flex justify-around mb-3 my-4 w-11/12 m-auto">
      <button class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 border rounded-full w-2/12">2020B</button>
      <button class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 border rounded-full w-2/12">2020E</button>
      <button class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 border rounded-full w-2/12">2020A</button>
      <button class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 border rounded-full w-2/12">2020C</button>
    </div>
    <table class="border-collapse border w-10/12 m-auto">
      <thead class="bg-cyan-500">
        <tr>
          <th class="px-4 py-4 w-2">ID</th>
          <th class="px-4 py-4 w-64">First Name</th>
          <th class="px-4 py-4 w-64">Last Name</th>
          <th class="px-4 py-4 w-64">Gender</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(student, index) in students" :key="index">
          <td class=" border border-slate-300 pl-4">
            <input type="checkbox" id="checkbox" v-model="selectedUsers" :value="student.id"
              class="accent-cyan-500 w-4 h-4 rounded" />
          </td>
          <td class="py-2 px-4  border border-slate-300">{{ student.user.first_name }}</td>
          <td class="py-2 px-4 ml-2 border border-slate-300">{{ student.user.last_name }}</td>
          <td class="py-2 px-4 ml-2 border border-slate-300">{{ student.user.gender }}</td>
        </tr>
      </tbody>
    </table>
  </section>
</template>

<script>
import { axiosClient } from '../../axios-http';
export default {
  data() {
    return {
      dialog: false,
      students: [],
      selectedUsers: [],
      classroom: [],
    };
  },
  methods: {
    getStudent() {
      let user_id = this.selectedUsers
      axiosClient
        .get("students/" + user_id)
        .then((Response) => {
          this.students = Response.data.data;
        })
        .catch((err) => console.log(err)
        );
    },
  },
  mounted() {
    this.getStudent();
  },
};
</script>