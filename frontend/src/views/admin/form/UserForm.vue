<template>
  <link
    href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css"
    rel="stylesheet"
  />
  <v-card class="mx-auto w-50">
    <h1 class="d-flex justify-center text-h5 bg-cyan pa-5">Create form info</h1>
    <v-sheet width="auto" class="pa-5 pb-7">
      <!-- form create studnet/teacher -->
      <v-form @submit.prevent="addData">
        
        <v-row class="d-flex">
          <v-col>
            <v-text-field
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
              :items="['Female', 'Male', 'Other']"
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
              :items="items"
              prepend-inner-icon="mdi mdi-account-key"
            >
            </v-select>
          </v-col>
        </v-row>
        <v-row v-if="isTeacher">
          <v-col>
            <v-select
              prepend-inner-icon="mdi mdi-briefcase"
              density="compact"
              v-model="selectedCourse"
              label="Choose Course For Teacher"
              :rules="coursesRules"
              :items="['OOP', 'PHP', 'English', 'Professional Life', 'Logic']"
            >
            </v-select>
          </v-col>
        </v-row>
        <v-row v-if="isStudent">
          <v-col>
            <v-select
              prepend-inner-icon="mdi mdi-school"
              density="compact"
              v-model="selectedClass"
              label="Choose Classe For Student"
              :rules="classesRules"
              :items="['WEP-B', 'WEP-A', 'WEP-C']"
            >
            </v-select>
          </v-col>
        </v-row>
        <v-list class="w-100 d-flex justify-space-between mt-10">
          <v-btn
            type="#####"
            class="bg-grey-lighten-1 pa-4 pa-5 pb-7"
            width="270"
            >ADD</v-btn
          >
          <v-btn class="bg-cyan pa-4 pa-5 pb-7" width="270" >CANCEL</v-btn>
        </v-list>
      </v-form>
    </v-sheet>
  </v-card>
</template>

<script>
//   import axios from "axios";

export default {
  emits: ["add-emit"],
  data() {

    return {
      selectedGender: null,
      selectedRole: null,
      selectedCourse:null,
      selectedClass:null,
      items: ["Teacher", "Student"],
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
      courses: "",
      date:"",

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
          if (/[^0-9]/.test(value)) return true;
          return "Password must be include at least 1 letter";
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
          return "Please select your class room";
        },
      ],
      coursesRules: [
        (value) => {
          if (value) return true;
           return "Please select your course";
        },
      ],
    };
  },
   methods: {
      addData() {
        let userInfo = {
          firstName: this.firstName,
          lastName: this.lastName,
          email: this.email,
          password: this.password,
          gender: this.gender,
          date: this.date,
          address: this.address,
          role: this.role,
        };
       
        if(this.firstName !=="" && this.lastName !=="" && this.email !=="" && this.password !=="" && this.gender !==""
            && this.date !=="" && this.address !=="" && this.role !==""){
            if(this.role === "Teacher" && this.classes ===""){
                  this.$emit("add-emit", userInfo);
            }
            else if(this.role === "Student" && this.courses ===""){
                this.$emit("add-emit", userInfo);
            }
              // clear after add already
                this.firstName = "";
                this.lastName = "";
                this.email = "";
                this.password = "";
                this.gender = "";
                this.address = "";
                this.role = "";
                this.date = "";
                this.classes = "";
                this.courses = "";
                this.selectedCourse = null;
                this.selectedGender = null;
                this.selectedRole = null; 
                this.isTeacher = false;
                this.isStudent = false;
        }
      },
      //    getCourse(){
      //     axios.get("http://127.0.0.1:8000/api/course")
      //         .then(response=>{
      //             this.course = response.data
      //             console.log(this.course)
      //         })
      //         .catch(error=>{
      //             console.log(error)
      //         })
      //     },
    },
  
  watch: {
    selectedRole(role) {
      if (role === "Teacher") {
        this.isTeacher = true;
        this.isStudent = false;
      } else if (role === "Student") {
        this.isStudent = true;
        this.isTeacher = false;
      }
      this.role = role;
    },
    selectedGender(gender) {
      this.gender = gender;
    },
    selectedClass(classes){
      this.classes = classes;
    },
    selectedCourse(course){
        this.courses = course;
    }

   
  },
};
</script>