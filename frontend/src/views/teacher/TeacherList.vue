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
          :key="index"
        >
          <a :href="item.href"> {{ item.title }}</a>
        </li>
      </ol>
    </div>
    <div class="w-10/12 m-auto mb-3 my-5">
      <div class="flex gap-2 my-2">
        <button
          class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 border-blue-700 rounded w-28"
        >
          Back
        </button>
        <!-- dialog for update teacher -->
        <button
          class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 border-blue-700 rounded w-28"
        >
          <v-dialog
            v-if="selectedUsers.length > 1 || selectedUsers.length == 0"
            class="w-50"
            v-model="dialogUpdate"
          >
            <template v-slot:activator="{ props }">
              <v-text v-bind="props">Update</v-text>
            </template>
            <v-card>
              <v-card-title class="border-gray-200 bg-green-500"
                >Update Teacher</v-card-title
              >
              <v-card-text>
                <v-container>
                  <p v-if="selectedUsers.length > 1">
                    Sorry you can't update more than one checkbox
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
            <router-link to="/admin/batch/teacher_detail/">Update</router-link>
          </div>
        </button>
        <!-- dialog for delete teacher -->
        <button
          class="btn bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 border-red-800 rounded w-28"
        >
          <v-dialog
            v-if="selectedUsers.length >= 1 || selectedUsers.length == 0"
            class="w-50"
            v-model="dialogDelete"
          >
            <template v-slot:activator="{ props }">
              <v-text v-bind="props">Delete</v-text>
            </template>
            <v-card>
              <v-card-title class="border-gray-200 bg-red-500"
                >Delete Teacher</v-card-title
              >
              <v-card-text>
                <v-container>
                  <p v-if="selectedUsers.length >= 1">
                    Are you sure want to permanently delete teacher
                  </p>
                  <p v-else>Please select checkbox</p>
                </v-container>
              </v-card-text>
              <v-card-actions class="flex justify-end">
                <div v-if="selectedUsers.length >= 1">
                  <v-btn
                    class="bg-cyan"
                    color="flex justify-center font-normal text-1xl font-bold"
                    variant="text"
                    @click="dialogDelete = false"
                    >Cancel
                  </v-btn>
                  <v-btn
                    class="bg-red"
                    color="flex justify-center font-normal text-1xl font-bold"
                    variant="text"
                    @click="deleteTeacher((dialogDelete = false))"
                    >Delete
                  </v-btn>
                </div>
                <v-btn
                  v-else
                  class="bg-red"
                  color="flex justify-center font-normal text-1xl font-bold"
                  variant="text"
                  @click="dialogDelete = false"
                  >OK
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <div v-else>
            <router-link to="/admin/batch/teacher_detail/">Delete</router-link>
          </div>
        </button>
        <!-- dialog for detail eacher teacher  -->
        <button
          class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold rounded w-28"
        >
          <v-dialog
            v-if="selectedUsers.length > 1 || selectedUsers.length == 0"
            class="w-50"
            v-model="dialogDetail"
          >
            <template v-slot:activator="{ props }">
              <v-text v-bind="props">See more</v-text>
            </template>
            <v-card>
              <v-card-title class="border-gray-200 bg-cyan-500"
                >Detail Teacher</v-card-title
              >
              <v-card-text>
                <v-container>
                  <p v-if="selectedUsers.length > 1">
                    Sorry you can detail teacher one by one
                  </p>
                  <p v-else>Please select checkbox</p>
                </v-container>
              </v-card-text>
              <v-card-actions class="flex justify-end">
                <v-btn
                  class="bg-cyan"
                  color="flex justify-center font-normal text-1xl font-bold"
                  variant="text"
                  @click="dialogDetail = false"
                  >OK
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <div v-else @click="onClickTeacherDetail">
              See more
          </div>
        </button>
      </div>
      <hr class="w-full h-0.5 bg-gray-300 dark:bg-cyan-900 mb-3 my-4" />
      <!-- table store list of teacher -->
      <table class="border-collapse border w-10/12 m-auto">
        <thead class="bg-cyan-500">
          <tr>
            <th class="px-4 py-4 w-2">ID</th>
            <th class="px-4 py-4 w-64">First Name</th>
            <th class="px-4 py-4 w-64">Last Name</th>
            <th class="px-4 py-4 w-64">Course</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(teacher, index) in teachers" :key="index">
            <td class="border border-slate-300 pl-4">
              <input
                type="checkbox"
                id="checkbox"
                v-model="selectedUsers"
                :value="teacher.id"
                class="accent-cyan-500 w-4 h-4 rounded"
              />
            </td>
            <td class="py-2 px-4 border border-slate-300">
              {{ teacher.user.first_name }}
            </td>
            <td class="py-2 px-4 border border-slate-300">
              {{ teacher.user.last_name }}
            </td>
            <td class="py-2 px-4 border border-slate-300">
              {{ teacher.course_id.course }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>
<script>
import axios from "axios";
import NavBar from "../../components/navbar/NavigationBar.vue";
export default {
  components: {
    NavBar,
  },
  data() {
    return {
      breadCrum: [],
      dialogDetail: false,
      dialogDelete: false,
      dialogUpdate: false,
      teachers: [],
      selectedUsers: [],
    };
  },
  methods: {
    getTeacher() {
      let user_id = this.selectedUsers;
      axios
        .get("http://127.0.0.1:8000/api/teacher/" + user_id)
        .then((Response) => {
          this.teachers = Response.data.data;
        })
        .catch((err) => console.log(err.respone.data.message));
    },
    deleteTeacher() {
      this.selectedUsers.forEach((userId) => {
        axios
          .delete(`http://127.0.0.1:8000/api/teacher/${userId}`)
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
  mounted() {
    this.getTeacher();
  },
};
</script>