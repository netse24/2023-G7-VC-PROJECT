<template>
  <v-card class="mx-auto w-50">
     <link
    href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css"
    rel="stylesheet"
   />
    <h1 class="d-flex justify-center text-h5 bg-cyan pa-5">Create form info</h1>
    <v-sheet width="auto" class="pa-5 pb-7">
      <!-- form create studnet/teacher -->
      <v-form @submit.prevent="createUser">
        
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
              :items="['Female', 'Male']"
            >
            </v-select>
          </v-col>
          <v-col 
          >
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
        <v-row v-if="isTeacher" @click="getCourses">
          <v-col>
            <v-select
              prepend-inner-icon="mdi mdi-briefcase"
              density="compact"
              v-model="selectedCourse"
              label="Choose Course For Teacher"
              :rules="coursesRules"
              :items="['HTML','OOP','DB','LARAVEL']"
            >
            </v-select>
          </v-col>
        </v-row>
        <v-row v-if="isStudent" @click="getClasses">
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
            <v-select
              prepend-inner-icon="mdi mdi-school"
              density="compact"
              v-model="selectedClass"
              label="Choose Classe For Student"
              :rules="classesRules"
              :items="['SNA', 'WEP A', 'WEP B']"
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
import axios from "axios";

export default {
  emits: ["user-emit", "student-emit", "teacher-emit"],
  data() {

    return {
      selectedGender: null,
      selectedRole: null,
      selectedCourse:null,
      selectedClass:null,
      roleItem:["Teacher", "Student"],
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
      generation: "",
      items: [],
      listCourse: [],
      listClass:[],
      listRole:[],
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
      generationRules: [
        (value) => {
          if (value) return true;
           return "Generation must be filled out";
        },
      ],
    };
  },
   methods: {
      createUser() {
        let userInfo = {
          first_name: this.firstName,
          last_name: this.lastName,
          gender: this.gender,
          email: this.email,
          password: this.password,
          date_of_birth: this.date,
          address: this.address,
          role_id: this.role,
        };
        // let studentInfo = {
        //   user_id: this.role,
        //   course_id: this.course
        // };
        let teacherInfo = {
          user_id: this.role,
          course_id: this.courses
        };
       
        if(this.firstName !=="" && this.lastName !=="" && this.email !=="" && this.password !=="" && this.gender !==""
            && this.date !=="" && this.address !=="" && this.role !==""){
            if(this.classes ==="" && this.generation ===""){
                  this.$emit("user-emit", userInfo);
                  this.$emit("teacher-emit", teacherInfo);

            }
            else if(this.courses ===""){
                this.$emit("user-emit", userInfo);
                // this.$emit("student-emit", studentInfo);

            }
                // this.$emit("user-emit", userInfo);
                // this.$emit("student-emit", studentInfo);


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
                this.gender = "";
                this.selectedCourse = null;
                this.selectedGender = null;
                this.selectedRole = null; 
                this.isTeacher = false;
                this.isStudent = false;
        }
      },
      getRole(){
          axios.get("http://127.0.0.1:8000/api/role")
              .then(response=>{
                  this.listRole = response.data.data
                  console.log(this.listRole)
              })
              .catch(error=>{
                  console.log(error)
          })
      },
      getCourses(){
          axios.get("http://127.0.0.1:8000/api/course")
              .then(response=>{
                  this.listCourse=response.data.data
                  console.log(this.listCourse)
              })
              .catch(error=>{
                  console.log(error)
              })
          // this.listCourse.forEach(element => {
          //   this.items.push(element.course)
          // });
          // console.log(this.items)
      },
      getClasses(){
          axios.get("http://127.0.0.1:8000/api/class")
              .then(response=>{
                  this.listClass = response.data.data
                  console.log(this.listClass)
              })
              .catch(error=>{
                  console.log(error)
          })
      },
    },
  
  watch: {
    selectedRole(role){
      if(role === "Teacher"){
        this.isTeacher = true;
        this.isStudent = false;
        this.role = 2
        } 
      else if (role === "Student") {
        this.isStudent = true;
        this.isTeacher = false;
        this.role = 3
      }
       
    },
    selectedGender(gender) {
      this.gender = gender;
    },
    selectedClass(classes){
       this.listClass.forEach(element => {
          if(classes === element.name){
            this.classes = element.id;
          }  
        });
    },
    selectedCourse(course){
        this.listCourse.forEach(element => {
          if(course === element.course){
            this.courses = element.id;
          }
        });
    }
  },
};
</script>