<template>
  <section>
    <nav-bar></nav-bar>
    <div class="w-10/12 m-auto">
      <div class="flex justify-between mb-1 mt-4">
        <div class="flex gap-2 my-2">
          <!-- btn back to generation -->
          <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 border-blue-700 rounded w-28">
            <router-link to="/admin/students">Back</router-link> 
          </button>
          <!-- dialog for update of the sutdnet -->
          <button class="btn bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-28">
            <v-dialog
              v-if="selectedUsers.length > 1 || selectedUsers.length == 0"
              class="w-50"
              v-model="dialogUpdate">
              <template v-slot:activator="{ props }">
                <v-text v-bind="props">Update</v-text>
              </template>
              <v-card>
                <v-card-title class="border-gray-200 bg-green-500">
                  Update Student
                </v-card-title>
                <v-card-text>
                  <v-container>
                    <p v-if="selectedUsers.length > 1">
                      You can update only 1 student one time 
                    </p>
                    <p v-else>Please select checkbox</p>
                  </v-container>
                </v-card-text>
                <v-card-actions class="flex justify-end">
                  <v-btn
                    class="bg-green"
                    color="flex justify-center font-normal text-1xl font-bold"
                    variant="text"
                    @click="dialogUpdate = false"
                    >OK
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
            <div v-else>
              <router-link to="#">Update</router-link>
            </div>
          </button>
          <!-- dialog for delete student -->
          <button class="btn bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 border-red-800 rounded w-28">
            <v-dialog v-if="selectedUsers.length >= 1 || selectedUsers.length == 0" class="w-50" v-model="dialogDelete">
              <template v-slot:activator="{ props }">
                <v-text v-bind="props">Delete</v-text>
              </template>
              <v-card>
                <v-card-title class="border-gray-200 bg-red-500">Delete Student info</v-card-title>
                <v-card-text>
                  <v-container class="d-flex justify-start">
                    <p v-if="selectedUsers.length >= 1">
                      Do you want to delete {{ selectedUsers.length }} row
                    </p>
                    <p v-else>Please select checkbox</p>
                  </v-container>
                </v-card-text>
                <v-card-actions class="d-flex justify-end gap-5">
                  <div v-if="selectedUsers.length >= 1">
                    <v-btn class="bg-cyan" color="font-normal font-bold" variant="text" @click="dialogDelete = false">
                      Cancel
                    </v-btn>
                    <v-btn v-if="selectedUsers.length > 0" @click="deleteStudent((dialogDelete = false))"
                      class="bg-red text-white w-20" color="font-normal text-1xl  font-bold">
                      Delete
                    </v-btn>
                  </div>
                  <v-btn v-else @click="dialogDelete = false" class="bg-cyan text-white w-20"
                    color="font-normal text-1xl  font-bold">
                    Ok
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </button>
          <!-- dialog for see more of student -->
          <button class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold rounded w-28">
            <v-dialog v-if="selectedUsers.length > 1 || selectedUsers.length == 0" class="w-50" v-model="dialogSeeMore">
              <template v-slot:activator="{ props }">
                <v-text v-bind="props">See more</v-text>
              </template>
              <v-card>
                <v-card-title class="border-gray-200 bg-cyan-500">Detail Student Background</v-card-title>
                <v-card-text>
                  <v-container class="d-flex justify-start">
                    <p v-if="selectedUsers.length > 1">
                      You can detail only 1 user one time
                    </p>
                    <p v-else>Please select checkbox</p>
                  </v-container>
                </v-card-text>
                <v-card-actions class="d-flex justify-end gap-5">
                  <v-btn class="bg-cyan" color="font-normal text-1xl font-bold" variant="text"
                    @click="dialogSeeMore = false">OK
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
            <div v-else>
              <router-link :to="`/admin/batch/student_detail/${selectedUsers}`">See more</router-link>
            </div>
          </button>
        </div>
        <!-- btn search for the student -->
        <div class="search-controll mt-2">
          <v-btn class="search-bar">
            <input v-model="searchByQuery" placeholder="search generation..." class="input-search outline outline-0 px-3"/>
            <v-icon>mdi-magnify</v-icon>
          </v-btn>
        </div>
      </div>
      <!-- table store data of the studnet -->
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
          <tr v-for="(student, index) of filterStudentList" :key="index">
            <td class="border border-slate-300 pl-4">
              <input type="checkbox" id="checkbox" v-model="selectedUsers" :value="student.id"
                class="accent-cyan-500 w-4 h-4 rounded" />
            </td>
            <td class="py-2 px-4 border border-slate-300">
              {{ student.user.first_name }}
            </td>
            <td class="py-2 px-4 ml-2 border border-slate-300">
              {{ student.user.last_name }}
            </td>
            <td class="py-2 px-4 ml-2 border border-slate-300">
              {{ student.user.gender }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>
<script>
import { axiosClient } from "../../axios-http";

export default {
  props: ["id"],
  data() {
    return {
      searchByQuery:"",
      dialogSeeMore: false,
      dialogDelete: false,
      dialogUpdate: false,
      students: [],
      selectedUsers: [],
      classroom: [],
      selectedClass: null,
      classesToShow: 5,
      startIndex: 0,
      showPrevious: false,
    };
  },

  methods: {
    getStudent() {
      axiosClient
        .get("generations/" + this.id)
        .then((Response) => {
          this.students = Response.data.data;
          for (let i = 0; i < this.students.length; i++) {
            if (!this.classroom.includes(this.students[i].class)) {
              this.classroom.push(this.students[i].class);
            }
          }
          console.log(this.classroom);
        })
        .catch((err) => console.log(err));
    },
    deleteStudent() {
      this.selectedUsers.forEach((userId) => {
        axiosClient
          .delete(`students/${userId}`)
          .then((res) => {
            console.log(res.data);
            this.getStudent();
            location.reload();
          })
          .catch((err) => console.error(err));
      });
    },

    updateStudent(){
      // alert(200)
    }
  },

  //Search in chatGPT//
  //Key words: How to manage student in each classes the class//
  computed: {
    classList() {
      return Array.from(new Set(this.students.map((student) => student.class)));
    },
    studentsByClass() {
      return this.students.reduce(function (acc, student) {
        if (!acc[student.class]) {
          acc[student.class] = [];
        }
        acc[student.class].push(student);
        return acc;
      }, {});
    },
    displayedClasses() {
      return this.classList.slice(
        this.startIndex,
        this.startIndex + this.classesToShow
      );
    },
    hasHiddenClasses() {
      return this.classList.length > this.classesToShow;
    },
    canShowMore() {
      return this.displayedClasses.length < 5;
    },

    filterStudentList() {
      if (this.searchByQuery === "") {
        return this.students;
      } else {
        const filtered = this.students.filter((student) =>
          student.user.first_name.toLowerCase().includes(this.searchByQuery.trim().toLowerCase()) ||
          student.user.last_name.toLowerCase().includes(this.searchByQuery.trim().toLowerCase())
        );
        if (filtered.length === 0) {
          return [
            // {
            //   user: { first_name: "null", last_name: "null", gender: "null" }
            // }
          ];
        } else {
          return filtered;
        }
      }
    }
  },
    
  mounted() {
    this.getStudent();
  },
  created() {
    this.selectedClass =
      localStorage.getItem("selectedClass");
  },
  watch: {
    selectedClass(value) {
      localStorage.setItem("selectedClass", value);
    },
  },
};
</script>
<style scoped>
button.selected {
  background-color: rgb(217, 142, 2);
}
</style>
