<template>
  <section>
    <nav-bar />
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
        <li class="breadcrumb-item" v-if="breadCrum.length > 0">
          <a href="/admin">Home</a>
        </li>
        <li
          class="breadcrumb-item"
          aria-current="page"
          v-for="(item, index) in breadCrum"
          :key="index"
        >
          <a :href="item.href"> {{ item.title }}</a>
        </li>
      </ol>
    </div>
    <div class="w-11/12 m-auto">
      <div class="flex justify-between my-2 mt-3">
        <div class="flex gap-2">
          <!-- Back button -->
          <button
            class="bg-cyan-500 hover:bg-cyan-700 text-dark font-bold py-2 px-4 rounded"
            :disabled="selectedUsers.length > 0"
            :style="
              selectedUsers.length > 0
                ? 'background-color:gray'
                : 'background-color:cyan-500'
            "
          >
            <p v-if="selectedUsers.length > 0" class="text-white">Home</p>
            <p v-if="selectedUsers.length == 0">
              <router-link to="/admin">Home</router-link>
            </p>
          </button>
          <!--Delete button -->
          <button
            class="bg-red-700 hover:bg-red-700 text-dark font-bold py-2 px-4 rounded"
            :disabled="selectedUsers.length == 0"
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
                <v-text
                  class="text-dart"
                  v-bind="props"
                  v-if="selectedUsers.length >= 1"
                  >Delete</v-text
                >
              </template>
              <v-card>
                <v-card-title class="border-gray-200 bg-cyan-500"
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
                      class="bg-cyan"
                      color="font-normal font-bold"
                      variant="text"
                      @click="dialogDelete = false"
                      >Cancel
                    </v-btn>
                    <v-btn
                      v-if="selectedUsers.length > 0"
                      @click="deleteTeacher()"
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
            class="bg-cyan-500 hover:bg-cyan-700 text-dark font-bold py-2 px-4 rounded"
            :disabled="selectedUsers.length > 1 || selectedUsers.length == 0"
            :style="
              selectedUsers.length > 1 || selectedUsers.length == 0
                ? 'background-color:gray'
                : 'background-color:green-700'
            "
          >
            <p
              class="text-white"
              v-if="selectedUsers.length > 1 || selectedUsers.length == 0"
            >
              Update
            </p>
            <v-dialog
              class="w-50"
              v-if="selectedUsers.length == 1"
              v-model="dialogUpdate"
            >
              <template v-slot:activator="{ props }">
                <v-text v-bind="props" @click="editTeacher">Update</v-text>
              </template>
              <h1 class="d-flex justify-center text-h5 bg-cyan pa-5">
                Update form info
              </h1>
              <v-sheet width="auto" class="pa-5 pb-7" v-if="model != null">
                <v-form @submit.prevent="updateTeacher">
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
                  <v-row>
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
                      >Save
                    </v-btn>
                  </v-list>
                </v-form>
              </v-sheet>
            </v-dialog>
          </button>
          <!--See detail button -->
          <button
            class="bg-cyan-500 hover:bg-cyan-700 text-dark font-bold py-2 px-4 rounded"
            :disabled="selectedUsers.length > 1 || selectedUsers.length == 0"
            :style="
              selectedUsers.length > 1 || selectedUsers.length == 0
                ? 'background-color:gray'
                : 'background-color:cyan-500'
            "
          >
            <p
              class="text-white"
              v-if="selectedUsers.length > 1 || selectedUsers.length == 0"
            >
              See Detail
            </p>
            <p v-if="selectedUsers.length == 1">
              <router-link :to="`/admin/teachers/detail/${selectedUsers}`">
                See Detail
              </router-link>
            </p>
          </button>
        </div>
        <!-- search button-->
        <div class="search-controll mt-2">
          <v-btn class="search-bar">
            <input
              @click="searchTeacher"
              type="search"
              v-model="searchByQuery"
              placeholder="search teacher..."
              class="input-search outline outline-0 px-3"
            />
            <v-icon>mdi-magnify</v-icon>
          </v-btn>
        </div>
      </div>
      <hr />
      <!-- table get teacher -->
      <div class="mt-3 relative sm:rounded-t-lg overflow-y-auto h-80">
        <table class="border-collapse border w-100 m-auto text-center">
          <thead class="bg-cyan-500">
            <tr>
              <th class="px-2 py-3 w-2">ID</th>
              <th class="px-2 py-3 w-64">First Name</th>
              <th class="px-2 py-3 w-64">Last Name</th>
              <th class="px-2 py-3 w-64">Gender</th>
              <th class="px-2 py-3 w-64">Course</th>
            </tr>
          </thead>
          <tbody v-if="filterUserList.length >0">
            <tr v-for="(teacher, index) of filterUserList" :key="index"> 
              <td class="border border-slate-300">
                <input type="checkbox" id="checkbox" v-model="selectedUsers" :value="teacher.user.id"
                  class="accent-cyan-500 w-4 h-4 rounded" />
              </td>
              <td class="py-2 px-4 border border-slate-300">
                {{ teacher.user.first_name }}
              </td>
              <td class="py-2 px-4 ml-2 border border-slate-300">
                {{ teacher.user.last_name }}
              </td>
              <td class="py-2 px-4 ml-2 border border-slate-300">
                {{ teacher.user.gender }}
              </td>
              <td class="py-2 px-4 ml-2 border border-slate-300">
                {{ teacher.course.course_name }}
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="5" class="py-2 px-4 border border-slate- text-red-500 ">
                Data teacher is unavailable.
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
  props: ["teacher_id"],
  data() {
    return {
      searchByQuery: "",
      dialogDelete: false,
      dialogUpdate: false,
      breadCrum: [],
      teachers: [],
      selectedUsers: [],
      model: [],
      isNotFound: false,
    };
  },
  methods: {
    async getTeacher() {
      let teacher_id = this.selectedUsers;
      await axiosClient
        .get("teachers/" + teacher_id)
        .then((res) => {
          this.teachers = res.data.data;
          console.log(res.data.data);
        })
        .catch((err) => console.log(err));
    },

    // update teacher
    async editTeacher() {
      try {
        if (this.selectedUsers.length == 1) {
          const res = await axiosClient.get("users/" + this.selectedUsers);
          this.model = res.data.data;
        } else {
          alert("You cannot more than one record!");
        }
      } catch (err) {
        console.log(err);
      }
    },
    async updateTeacher() {
      try {
        if (this.selectedUsers.length == 1 && this.model != null) {
          const res = await axiosClient.put(
            "users/" + this.selectedUsers,
            this.model
          );
          this.getTeacher();
          location.reload();
          console.log(res.data.user);
        }
      } catch (err) {
        console.log(err);
      }
    },

    //delete teacher
    deleteTeacher() {
      this.selectedUsers.forEach((userId) => {
        axiosClient
          .delete(`teachers/${userId}`)
          .then((res) => {
            console.log(res.data);
            this.getTeacher();
            this.dialogDelete = false;

            setTimeout(() => {
              location.reload();
            }, 2000);
          })
          .catch((err) => console.error(err));
      });
    },

    onClickTeacherDetail() {
      this.breadCrum = [];
      this.breadCrum.push({ title: "Detail", href: "/admin/teachers/detail" });
      this.breadCrum.forEach((path) => {
        if (path) {
          this.$router.push("/admin/teachers/detail");
        } else {
          this.$router.push("/404");
        }
      });
    },
  },
  computed: {
    //search teacher first_name, last_name
    filterUserList() {
      if (this.searchByQuery === "") {
        return this.teachers;
      } else {
        const filtered = this.teachers.filter(
          (teacher) =>
            teacher.user.first_name
              .toLowerCase()
              .includes(this.searchByQuery.trim().toLowerCase()) ||
            teacher.user.last_name
              .toLowerCase()
              .includes(this.searchByQuery.trim().toLowerCase())
        );
        if (filtered.length) {
          return filtered;
        } else {
          return [];
        }
      }
    },
  },
  mounted() {
    this.getTeacher();
  },
};
</script>