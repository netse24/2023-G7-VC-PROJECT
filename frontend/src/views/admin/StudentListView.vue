<template>
  <section>
    <nav-bar></nav-bar>
    <div class="w-11/12 m-auto">
      <div class="flex justify-between my-2 mt-5">
        <div class="flex gap-2">
          <!-- Back button -->
          <button
            class="bg-cyan-500 hover:bg-cyan-600 font-bold py-2 px-4 rounded"
            :disabled="selectedUsers.length > 0"
            :style="selectedUsers.length > 0
                ? 'background-color:gray'
                : 'background-color:blue-600'
            "
          >
            <p class="text-white" v-if="selectedUsers.length > 0">Back</p>
            <p v-if="selectedUsers.length == 0">
              <router-link to="/admin/students">Back</router-link>
            </p>
          </button>
          <!--Delete button -->
          <button
            class="bg-red-600 hover cursor-pointer hover:bg-red-700  font-bold py-2 px-4 rounded"
            :disabled="selectedUsers.length >= 0"
            :style="
              selectedUsers.length == 0
                ? 'background-color:gray'
                : 'background-color:red-700'
            "
          >
            <p class="text-white" v-if="selectedUsers.length == 0">Delete</p>
            <v-dialog
              class="w-5/12"
              v-model="dialogDelete"
              v-if="selectedUsers.length >= 1"
            >
              <template v-slot:activator="{ props }">
                <v-text v-bind="props" v-if="selectedUsers.length >= 1"
                  >Delete</v-text
                >
              </template>
              <v-card>
                <v-card-title class="border-gray-200 bg-blue-500"
                  >Delete date of Teacher</v-card-title
                >
                <v-card-text>
                  <v-container class="d-flex justify-start">
                    <p v-if="selectedUsers.length >= 1">
                      Do you want to delete {{ selectedUsers.length }} row
                    </p>
                  </v-container>
                </v-card-text>
                <v-card-actions class="d-flex justify-end gap-5">
                  <div v-if="selectedUsers.length >= 1">
                    <v-btn
                      class="bg-blue"
                      color="font-normal font-bold"
                      variant="text"
                      @click="dialogDelete = false"
                      >Cancel
                    </v-btn>
                    <v-btn
                      v-if="selectedUsers.length > 0"
                      @click="deleteStudent((dialogDelete = false))"
                      class="bg-red text-white w-20"
                      color="font-normal text-1xl font-bold"
                      >Delete
                    </v-btn>
                  </div>
                  <v-btn
                    v-else
                    @click="dialogDelete = false"
                    class="bg-blue text-white w-20"
                    color="font-normal text-1xl  font-bold"
                    >Ok
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </button>
          <!-- update button-->
          <button
            class="bg-cyan-500 hover:bg-cyan-600  font-bold py-2 px-4 border border-blue-700 rounded w-28"
            :disabled="selectedUsers.length > 1 || selectedUsers.length == 0"
            :style="
              selectedUsers.length > 1 || selectedUsers.length == 0
                ? 'background-color: gray'
                : 'background-color: bg-blue-700'
            "
          >
            <p class="text-white" v-if="selectedUsers.length == 0 || selectedUsers.length > 1">
              Update
            </p>
            <v-dialog
              class="w-50"
              v-if="selectedUsers.length == 1"
              v-model="dialogUpdate"
            >
              <template v-slot:activator="{ props }">
                <v-text v-bind="props" @click="editStudent">Update</v-text>
              </template>
              <h1 class="d-flex justify-center text-h5 bg-cyan pa-5">
                Update form info
              </h1>
              <v-sheet width="auto" class="pa-5 pb-7" v-if="model != null">
                <v-form @submit.prevent="updateStudent">
                  <v-row class="d-flex">
                    <v-col>
                      <v-text-field
                        required
                        density="compact"
                        v-model="model.first_name"
                        label="Enter Firstname"
                        :value="model.first_name"
                        :rules="firstNameRules"
                        prepend-inner-icon="mdi-account-box"
                      >
                      </v-text-field>
                    </v-col>
                    <v-col>
                      <v-text-field
                        density="compact"
                        v-model="model.last_name"
                        label="Enter Lastname"
                        :rules="lastNameRules"
                        prepend-inner-icon="mdi-account-box"
                      >
                      </v-text-field>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col>
                      <v-text-field
                        density="compact"
                        v-model="model.email"
                        label="Enter Email"
                        :rules="emailRules"
                        prepend-inner-icon="mdi-email"
                      >
                      </v-text-field>
                    </v-col>
                    <v-col>
                      <v-select
                        prepend-inner-icon="mdi-account-box"
                        density="compact"
                        label="Choose Gender"
                        v-model="model.gender"
                        :rules="genderRules"
                        :items="['Female', 'Male']"
                      >
                      </v-select>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col>
                      <v-text-field
                        prepend-inner-icon="mdi mdi-calendar-clock"
                        density="compact"
                        type="date"
                        label="Date Of Birth"
                        v-model="model.date_of_birth"
                        :rules="dateRules"
                      >
                      </v-text-field>
                    </v-col>
                    <v-col>
                      <v-text-field
                        density="compact"
                        v-model="model.address"
                        label="Enter Address"
                        :rules="addressRules"
                        prepend-inner-icon="mdi-map-marker-radius"
                      >
                      </v-text-field>
                    </v-col>
                  </v-row>
                  <v-list class="d-flex justify-space-between">
                    <v-btn
                      type="button"
                      class="bg-grey-lighten-1"
                      @click="dialogUpdate = false"
                      >CANCEL</v-btn
                    >
                    <v-btn
                      type="submit"
                      class="bg-cyan"
                      @click="dialogUpdate = false"
                      >Save</v-btn
                    >
                  </v-list>
                </v-form>
              </v-sheet>
            </v-dialog>
          </button>
          <!-- add transcript button -->
          <button
            class="bg-cyan-500 hover:bg-cyan-600  font-bold px-2 rounded"
            :disabled="selectedUsers.length > 1 || selectedUsers.length == 0"
            :style="
              selectedUsers.length > 1 || selectedUsers.length == 0
                ? 'background-color:gray'
                : 'background-color:orange-700'
            "
          >
            <p class="text-white" v-if="selectedUsers.length > 1 || selectedUsers.length == 0">
              Add Transcript
            </p>
            <p v-if="selectedUsers.length == 1">
                Add Transcript
            </p>
          </button>
          <!--See detail button -->
          <button
            class="bg-cyan-500 hover:bg-cyan-600  font-bold px-2 rounded"
            :disabled="selectedUsers.length > 1 || selectedUsers.length == 0"
            :style="
              selectedUsers.length > 1 || selectedUsers.length == 0
                ? 'background-color:gray'
                : 'background-color:orange-700'
            "
          >
            <p class="text-white" v-if="selectedUsers.length > 1 || selectedUsers.length == 0">
              See Detail
            </p>
            <p v-if="selectedUsers.length == 1">
              <router-link :to="`/admin/students/detail/${selectedUsers}`">
                See Detail
              </router-link>
            </p>
          </button>
        </div>
        <!-- search button-->
        <div class="search-controll mt-2">
          <v-btn class="search-bar">
            <input
              v-model="searchByQuery"
              placeholder="search student..."
              class="input-search outline outline-0 px-3"
            />
            <v-icon>mdi-magnify</v-icon>
          </v-btn>
        </div>
      </div>
      <hr />
      <!-- Previous, next and class -->
      <div class="d-flex mt-5 justify-between">
        <div>
          <button
            class="bg-cyan-500 hover:bg-cyan-600  font-bold py-2 px-4 border-blue-700 rounded w-auto mr-2"
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
            class="bg-cyan-500 hover:bg-cyan-600 font-bold py-2 px-4 border-blue-700 rounded w-auto ml-5"
          >
            CLASS-{{ className }}
          </button>
        </div>
        <div>
          <button
            :disabled="canShowMore"
            class="bg-cyan-500 hover:bg-cyan-600 font-bold py-2 px-4 border-blue-700 rounded w-auto mr-12"
            @click="showMore"
          >
            Next
          </button>
        </div>
      </div>
      <!-- table  -->
      <div class="d-flex mt-8">
        <table class="border-collapse border w-100 m-auto" v-if="selectedClass">
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
              v-show="matchesSearch(student)"
            >
              <td class="border border-slate-300 pl-4">
                <input
                  type="checkbox"
                  id="checkbox"
                  v-model="selectedUsers"
                  :value="student.user.id"
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
      searchByQuery: "",
      user_id: null,
      model: [],
    };
  },

  methods: {
    getStudent() {
      axiosClient
        .get("generations/" + this.id)
        .then((response) => {
          this.students = response.data.data;
          for (let i = 0; i < this.students.length; i++) {
            if (!this.classroom.includes(this.students[i].class)) {
              this.classroom.push(this.students[i].class);
            }
          }
          console.log(this.classroom);
        })
        .catch((err) => console.log(err));
    },

    async editStudent() {
      try {
        if (this.selectedUsers.length == 1) {
          const res = await axiosClient.get(
            "/getStudentByUserId/" + this.selectedUsers
          );
          this.model = res.data.data;
          console.log(this.model);
        } else {
          alert("You cannot more than one record!");
        }
      } catch (err) {
        console.log(err);
      }
    },
    async updateStudent() {
      try {
        if (this.selectedUsers.length == 1 && this.model != null) {
          const res = await axiosClient.put(
            "users/" + this.selectedUsers,
            this.model
          );
          this.getStudent();
          location.reload();
          console.log(res.data.user);
        }
      } catch (err) {
        console.log(err);
      }
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
    matchesSearch(student) {
      const nameFilter = this.searchByQuery.toLowerCase();
      return (
        !nameFilter ||
        student.user.first_name.toLowerCase().includes(nameFilter)
      );
    },
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
    },
  },

  created() {
    this.selectedClass = localStorage.getItem("selectedClass");
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
