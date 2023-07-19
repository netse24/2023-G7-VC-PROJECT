<template>
  <section>
    <NavBar />
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
          :key="index">
          <a :href="item.href"> {{ item.title }}</a>
        </li>
      </ol>
    </div>
    <div class="w-11/12 m-auto">
      <div class="flex justify-between my-2 mt-5">
        <div class="flex gap-2">
          <!-- Back button -->
          <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <router-link to="/admin">Home</router-link>
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
                  >Delete date of Teacher</v-card-title
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
                      @click="deleteTeacher((dialogDelete = false))"
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
          <!--See detail button -->
          <button class="bg-orange-700 hover:bg-orange-800 text-white font-bold px-2 rounded">
            <router-link :to="`/admin/teachers/detail/${selectedUsers}`">
              See Detail
            </router-link>
          </button>
        </div>
        <!-- search button-->
        <div class="search-controll mt-2">
          <v-btn class="search-bar">
            <input
              @click="searchTeacher"
              v-model="searchByQuery"
              placeholder="search teacher..."
              class="input-search outline outline-0 px-3"/>
            <v-icon>mdi-magnify</v-icon>
          </v-btn>
        </div>
      </div>
      <hr />
      <!-- table  -->
      <div class="d-flex mt-8 mr-12">
        <table class="border-collapse border w-100 m-auto">
          <thead class="bg-cyan-500 text-center">
            <tr>
              <th class="px-4 py-4 w-2">ID</th>
              <th class="px-4 py-4 w-64">First Name</th>
              <th class="px-4 py-4 w-64">Last Name</th>
              <th class="px-4 py-4 w-64">Gender</th>
              <th class="px-4 py-4 w-64">Course</th>
            </tr>
          </thead>
          <tbody class=" text-center">
            <tr  v-for="(teacher, index) of filterUserList" :key="index">
              <td class="border border-slate-300">
                <input type="checkbox" id="checkbox" v-model="selectedUsers" :value="teacher.id" 
                  class="accent-cyan-500 w-4 h-4 rounded"/>
              </td>
              <td class="py-2 px-4 border border-slate-300">
                {{teacher.user.first_name}}
              </td>
              <td class="py-2 px-4 ml-2 border border-slate-300">
                {{teacher.user.last_name}}
              </td>
              <td class="py-2 px-4 ml-2 border border-slate-300">
                {{teacher.user.gender}}
              </td>
              <td class="py-2 px-4 ml-2 border border-slate-300">
                {{teacher.course_id.course}}
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
import NavBar from "../../components/navbar/NavigationBar.vue";
export default {
  props:["teacher_id"],
  components: { NavBar },
  data() {
    return {
      dialogDelete: false,
      dialogUpdate: false,
      breadCrum: [],
      teachers: [],
      selectedUsers: [],
      searchByQuery:"",
    };
  },
  methods: {
    getTeacher() {
      let teacher_id = this.selectedUsers;
      axiosClient
        .get("teachers/" + teacher_id )
        .then((res) => {
          this.teachers = res.data.data;
          console.log(res.data.data)
        })
        .catch((err) => console.log(err));
    },

    //delete teacher
    deleteTeacher() {
      this.selectedUsers.forEach((userId) => {
        axiosClient
          .delete(`teacher/${userId}`)
          .then((res) => {
            console.log(res.data);
            this.getTeacher();
            location.reload();
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
        const filtered = this.teachers.filter((teacher) =>
          teacher.user.first_name.toLowerCase().includes(this.searchByQuery.trim().toLowerCase()) ||
          teacher.user.last_name.toLowerCase().includes(this.searchByQuery.trim().toLowerCase())
        );
        if (filtered.length === 0) {
          return confirm ("Nothing teacher that have match name with latter you try to search");
        } else {
          return filtered;
        }
      }
    },
  },
  mounted() {
    this.getTeacher();
  },
};
</script>