<template>
  <v-row justify="center" class="mt-4">
    <v-dialog v-model="dialog" persistent width="1024">
      <template v-slot:activator="{ props }">
        <v-list class="w-100 ml-5 d-flex justify-start">
          <v-btn color="primary" v-bind="props"> Add Schedule </v-btn>
        </v-list>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">Add A New </span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" sm="6" md="4">
                <v-select
                  :items="itemSubjects"
                  label="Subject*"
                  required
                ></v-select>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-select
                  :items="itemTeachers"
                  :color="gray"
                  label="Teacher*"
                  required
                ></v-select>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-select
                  :items="itemRooms"
                  label="Room*"
                  required
                ></v-select>
              </v-col>
            </v-row>
            <v-row>
              <input type="date">
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
            Close
          </v-btn>
          <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {
  components: {},
  props: [],
  emits: [],
  data() {
    return {
      dialog: false,
      subjectName: "",
      nameRules: [
        (value) => {
          if (value) return true;
          return "Required";
        },
      ],
      selectTeacher: "",
      itemTeachers: ["Rady", "Him", "Yon", "Mengheang"],
      selectRoom: "",
      itemRooms: ["B31", "B12", "B13", "B23"],
      selectSubject: "",
      itemSubjects:["VueJs", "NodeJs", "Laravel", "PHP", "JavaScript", "HTML"]
    };
  },
  watch: {},
  methods: {},
  mounted() {},
};
</script>

<style>
</style>