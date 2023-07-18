<template>
  <section>
    <nav-bar></nav-bar>
    <div class="w-11/12 m-auto">
      <div class="flex justify-between my-2 mt-5">
        <div class="flex gap-2">
          <!-- Back button -->
          <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <router-link to="/admin/students">Back</router-link>
          </button>
          <!--Delete button -->
          <button
            class="bg-red-700 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
            <v-dialog
              v-if="selectedUsers.length >= 1 || selectedUsers.length == 0"
              class="w-50"
              v-model="dialogDelete">
              <template v-slot:activator="{ props }">
                <v-text v-bind="props">Delete</v-text>
              </template>
              <v-card>
                <v-card-title class="border-gray-200 bg-red-500"
                  >Delete date of student</v-card-title
                >
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
                    <v-btn
                      class="bg-blue"
                      color="font-normal font-bold"
                      variant="text"
                      @click="dialogDelete = false">Cancel
                    </v-btn>
                    <v-btn
                      v-if="selectedUsers.length > 0"
                      @click="deleteStudent((dialogDelete = false))"
                      class="bg-red text-white w-20"
                      color="font-normal text-1xl  font-bold">Delete
                    </v-btn>
                  </div>
                  <v-btn
                    v-else
                    @click="dialogDelete = false"
                    class="bg-blue text-white w-20"
                    color="font-normal text-1xl  font-bold">Ok
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </button>
          <!-- update button-->
          <button class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-4 rounded"> 
            Update
          </button>
          <!-- add transcript button -->
          <button class="bg-teal-800 hover:bg-teal-900 text-white font-bold px-2 rounded">
            <router-link to="">
              Add Transcript
            </router-link>
          </button>
          <!--See detail button -->
          <button class="bg-orange-700 hover:bg-orange-800 text-white font-bold px-2 rounded">
            <router-link :to="`/admin/batch/student_detail/${selectedUsers}`">
              See Detail
            </router-link>
          </button>
        </div>
        <!-- search button-->
        <div class="search-controll mt-2">
          <v-btn class="search-bar">
            <input
              v-model="searchByQuery"
              placeholder="search student..."
              class="input-search outline outline-0 px-3"/>
            <v-icon>mdi-magnify</v-icon>
          </v-btn>
        </div>
      </div>
      <hr />
      <!-- Previous, next and class -->
      <div class="d-flex mt-5 justify-between">
        <div>
          <button
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 border-blue-700 rounded w-auto mr-2"
            @click="showPreviousClasses"
          >
            Previous
          </button>
        </div>
        <div class="w-full">
          <button
            v-for="className in displayedClasses"
            :key="className"
            @click="selectedClass = className"
            :class="buttonClass(className)"
            class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 border-blue-700 rounded w-auto ml-5"
          >
            CLASS-{{ className }}
          </button>
        </div>
        <div>
          <button
            :disabled="canShowMore"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 border-blue-700 rounded w-auto mr-12"
            @click="showMore">
            Next
          </button>
        </div>
      </div>
      <!-- table  -->
      <div class="d-flex mt-8 mr-12">
        <table class="border-collapse border w-14/12" v-if="selectedClass">
          <thead class="bg-cyan-500">
            <tr>
              <th class="px-4 py-4 w-2">ID</th>
              <th class="px-4 py-4 w-64">First Name</th>
              <th class="px-4 py-4 w-64">Last Name</th>
              <th class="px-4 py-4 w-64">Gender</th>
              <th class="px-4 py-4 w-64">Email</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="student in studentsByClass[selectedClass]"
              :key="student"
              v-show="matchesSearch(student)">
              <td class="border border-slate-300 pl-4">
                <input
                  type="checkbox"
                  id="checkbox"
                  v-model="selectedUsers"
                  :value="student.id"
                  class="accent-cyan-500 w-4 h-4 rounded"
                />
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
              <td class="py-2 px-4 ml-2 border border-slate-300">
                {{ student.user.email }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</template>
<script>
import { axiosClient } from "../../axios-http";

export default {
  props: ["id"],
  data() {
    return {
      dialogDelete: false,
      dialogUpdate: false,
      showPrevious: false,
      students: [],
      selectedUsers: [],
      classroom: [],
      selectedClass: null,
      classesToShow: 5,
      startIndex: 0,
      searchByQuery:"",
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

    buttonClass(className) {
      return {
        selected: className === this.selectedClass,
      };
    },

    showMore() {
      this.startIndex += this.classesToShow;
      if (this.startIndex > 5) {
        this.showPrevious = true;
      }
      if (this.startIndex >= this.classList) {
        this.showNext = false;
      }
    },

    showPreviousClasses() {
      this.startIndex -= this.classesToShow;
      if (this.startIndex < 0) {
        this.startIndex = 0;
      }
      if (this.startIndex === 0) {
        this.showPrevious = false;
      }
    },
    // function search name //Got from chatGPT
    matchesSearch(student){
      const nameFilter = this.searchByQuery.toLowerCase();
      return !nameFilter || student.user.first_name.toLowerCase().includes(nameFilter);
    }
  },

  mounted() {
    this.getStudent();
  },

  computed: {
    //Search in chatGPT//
    //Key words: How to manage student in each classes the class//
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
    }
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
