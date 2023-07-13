<template>
  <section>
    <base-button color="primary" @click="showDialog">CREATE</base-button>
    <!-- <base-button color="primary" @click="showDialog">EDIT</base-button>  -->
    <link
      href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css"
      rel="stylesheet"
    />
    <v-row justify="center">
      <v-dialog ref="dialog" v-model="dialog" persistent width="1000">
        <base-dialog>
          <template #body>
            <v-sheet width="auto">
              <!-- form create studnet/teacher -->
              <v-form @submit.prevent="createUser">
                <v-row class="d-flex">
                  <v-col>
                    <v-text-field
                      required
                      density="compact"
                      v-model="firstName"
                      label="Enter Firstname"
                      :rules="firstNameRules"
                      prepend-inner-icon="mdi-account-box"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col>
                    <v-text-field
                      density="compact"
                      v-model="lastName"
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
                      v-model="email"
                      label="Enter Email"
                      :rules="emailRules"
                      prepend-inner-icon="mdi-email"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col>
                    <v-text-field
                      type="password"
                      density="compact"
                      v-model="password"
                      label="Enter Password"
                      :rules="passwordRules"
                      prepend-inner-icon="mdi-lock"
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
                      v-model="date"
                      :rules="dateRules"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col>
                    <v-text-field
                      density="compact"
                      v-model="address"
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
                      v-model="selectedGender"
                      :rules="genderRules"
                      :items="['Female', 'Male']"
                    >
                    </v-select>
                  </v-col>
                  <v-col>
                    <v-select
                      label="Choose Role"
                      v-model="selectedRole"
                      class="form-control-select"
                      density="compact"
                      :rules="roleRules"
                      :items="roleItem"
                      prepend-inner-icon="mdi mdi-account-key"
                    >
                    </v-select>
                  </v-col>
                </v-row>
                <v-row v-if="isTeacher">
                  <v-col>
                   <v-text-field
                      density="compact"
                      v-model="course"
                      label="Enter Course For teacher"
                      :rules="courseRules"
                      prepend-inner-icon="mdi mdi-briefcase"
                    >
                    </v-text-field>
                  </v-col>
                </v-row>
                <v-row v-if="isStudent">
                  <v-col>
                    <v-text-field
                      density="compact"
                      v-model="generation"
                      label="Enter Generation"
                      :rules="generationRules"
                      prepend-inner-icon="mdi mdi-account-multiple"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col>
                    <v-text-field
                      prepend-inner-icon="mdi mdi-school"
                      density="compact"
                      v-model="classes"
                      label="Enter Classe For Student"
                      :rules="classesRules"
                    >
                    </v-text-field>
                  </v-col>
                   <v-col @click="getRoom">
                    <v-select
                      prepend-inner-icon="mdi mdi-domain"
                      density="compact"
                      v-model="selectedRoom"
                      label="Choose Room"
                      :rules="roomRules"
                      :items="roomList"
                    >
                    </v-select>
                  </v-col>
                </v-row>
                <v-list class="d-flex justify-space-between">
                  <v-btn
                    @click="clearForm"
                    type="#####"
                    class="bg-grey-lighten-1"
                    >CANCEL</v-btn
                  >
                  <v-btn type="submit" class="bg-cyan">Create</v-btn>
                </v-list>
              </v-form>
            </v-sheet>
          </template>
        </base-dialog>
      </v-dialog>
    </v-row>
  </section>
</template>

<script>
import axiosClient from '@/axios-http';
export default {
  emits: ["student-emit", "teacher-emit"],
  data() {
    return {
      dialog: false,
      dialogDisplayed: false,
      selectedGender: null,
      selectedRole: null,
      roleItem: ["Teacher", "Student"],
      roomList:["B12", "B13", "B31"],
      isTeacher: false,
      isStudent: false,
      firstName: "",
      lastName: "",
      email: "",
      password: "",
      gender: "",
      address: "",
      role: "",
      classes: "",
      course: "",
      date: "",
      generation: "",
      listRoom: [],
      roomId: null,
      selectedRoom:null,
      //Validation all of form
      firstNameRules: [
        (value) => {
          if (/^[a-zA-Z]*$/.test(value)) return true;
          return "Firstname can contain only letter";
        },
        (value) => {
          if (value) return true;
          return "First name must be filled out";
        },
      ],

      lastNameRules: [
        (value) => {
          if (value) return true;
          return "Last name must be filled out";
        },
        (value) => {
          if (/^[a-zA-Z]*$/.test(value)) return true;
          return "Lastname can contain only letter";
        },
      ],
      emailRules: [
        (value) => {
          if (value) return true;
          return "E-mail must be filled out";
        },
        (value) => {
          if (/.+@.+\..+/.test(value)) return true;
          return "E-mail invalide Format";
        },
      ],
      passwordRules: [
        (value) => {
          if (value?.length >= 8) return true;
          return "Password must be filled out at least 8 characters";
        },
        (value) => {
          if (/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(value)) return true;
          return "Password must contain at least one letter and one number";
        },
      ],
      addressRules: [
        (value) => {
          if (value) return true;
          return "Address must be filled out";
        },
      ],
      genderRules: [
        (value) => {
          if (value) return true;
          return "Please select your gender";
        },
      ],
      dateRules: [
        (value) => {
          if (value) return true;
          return "Please select your birthday";
        },
      ],
      roleRules: [
        (value) => {
          if (value) return true;
          return "Please select your role";
        },
      ],
      classesRules: [
        (value) => {
          if (value) return true;
          return "Classe must be filled out";
        },
      ],
      courseRules: [
        (value) => {
          if (value) return true;
          return "Course must be filled out";
        },
      ],
      generationRules: [
        (value) => {
          if (value) return true;
          return "Generation must be filled out";
        },
      ],
      roomRules:[
        (value) => {
          if (value) return true;
          return "Room must be select";
        },
      ],
    };
  },
  methods: {
    createUser() {
      let teacherInfo = {
        user: {
          first_name: this.firstName,
          last_name: this.lastName,
          gender: this.gender,
          email: this.email,
          password: this.password,
          date_of_birth: this.date,
          address: this.address,
          role_id: this.role,
        },
        course: {
          course: this.course,
        },
        teacher:{
        }
      };

      let studentInfo = {
        user: {
          first_name: this.firstName,
          last_name: this.lastName,
          gender: this.gender,
          email: this.email,
          password: this.password,
          date_of_birth: this.date,
          address: this.address,
          role_id: this.role,
        },
        generation:{
          name: this.generation,
        },
        class:{
          name: this.classes,
          room_id: this.roomId,
        },
        student: {
        },
      };
      if (
        this.firstName !== "" &&
        this.lastName !== "" &&
        this.email !== "" &&
        this.password !== "" &&
        this.gender !== "" &&
        this.date !== "" &&
        this.address !== "" &&
        this.role !== ""
      ) {
        if (this.course !== "") {
          this.$emit("teacher-emit", teacherInfo);
          this.dialog = false;
        } else if (this.classes !== "" && this.generation !== "" && this.selectedRoom !== null) {
          this.$emit("student-emit", studentInfo);
          this.dialog = false;
        }
        this.clearForm();
      }
    },
    clearForm() {
      this.firstName = "";
      this.lastName = "";
      this.email = "";
      this.password = "";
      this.gender = "";
      this.address = "";
      this.role = "";
      this.date = "";
      this.classes = "";
      this.course = "";
      this.generation = "";
      this.roomId= null;
      this.selectedGender = null;
      this.selectedRole = null;
      this.selectedRoom = null;
      (this.isTeacher = false), (this.isStudent = false), (this.dialog = false);
    },
    showCreateUser() {
      this.dialogMode = "create";
      this.dialogDisplayed = true;
    },
    onConfirm() {
      this.dialogDisplayed = false;
    },
    showDialog() {
      this.dialog = true;
    },
    getRoom(){
      axiosClient.get("room") 
      .then((response) => {
          this.listRoom = response.data.data
        })
        .catch((error) => {
          console.error(error);
        });
    }
  },

  watch: {
    selectedRole(role) {
      if (role === "Teacher") {
        this.isTeacher = true;
        this.isStudent = false;
        this.role = 2;
      } else if (role === "Student") {
        this.isStudent = true;
        this.isTeacher = false;
        this.role = 3;
      }
    },
    selectedGender(gender) {
      this.gender = gender;
    },
    selectedRoom(rooms) {
      this.listRoom.forEach(room => {
        if(room.name == rooms){
          this.roomId = room.id;
        }
      });
    },
 
  },
};
</script>
