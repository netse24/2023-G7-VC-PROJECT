<template>
  <link
    href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css"
    rel="stylesheet"
  />
  <v-card
    class="mx-auto"
    max-width="1100"
  >
    <v-layout>
      <v-main>
        <v-container fluid class="mb-15 mt-10">
          <v-row dense>
            <v-col>
              <v-hover v-slot="{ isHovering, props }">
                 <v-card
                  color="#00BCD4"
                  height="210"
                  class="d-flex flex-column align-center justify-center rounded"
                  :elevation="isHovering ? 20 : 2"
                  :class="{ 'on-hover': isHovering }"
                  v-bind="props"
                 >
                    <v-icon class="mdi mdi-account-box text-h1" color="white"></v-icon>
                    <div class="text-subtitle-2 text-white">YOUR BACKGROUND</div>
                </v-card>
              </v-hover>
            </v-col>

             <v-col>
              <v-hover v-slot="{ isHovering, props }">
                <v-card
                  color="#00BCD4"
                  height="210"
                  class="d-flex flex-column align-center justify-center rounded"
                  :elevation="isHovering ? 20 : 2"
                  :class="{ 'on-hover': isHovering }"
                  v-bind="props"
                >
                  <v-icon class="mdi mdi-timetable text-h1" color="white"></v-icon>
                  <div class="text-subtitle-2 text-white">SCHEDULES</div>
                </v-card>
              </v-hover>
               
            </v-col>
             <v-col
            >
            <v-hover v-slot="{ isHovering, props }">
                <v-card
                  color="#00BCD4"
                  height="210"
                  class="d-flex flex-column align-center justify-center rounded"
                  :elevation="isHovering ? 20 : 2"
                  :class="{ 'on-hover': isHovering }"
                  v-bind="props"
                
                >
                  <v-icon class="mdi mdi-folder-download text-h1" color="white"></v-icon>
                  <div class="text-subtitle-2 text-white">ASSIGNMENT</div>
                </v-card>
             </v-hover>
            </v-col>
             <v-col>
              <v-hover v-slot="{ isHovering, props }">
                <v-card
                  color="#00BCD4"
                  height="210"
                  class="d-flex flex-column align-center justify-center rounded"
                  :elevation="isHovering ? 20 : 2"
                  :class="{ 'on-hover': isHovering }"
                  v-bind="props"
                >
                  <v-icon class="mdi mdi-school text-h1" color="white"></v-icon>
                  <div class="text-subtitle-2 text-white">TRANSCRIPT</div>
                </v-card>
              </v-hover>
            </v-col>
              <v-col>
                <v-hover v-slot="{ isHovering, props }">
                  <v-card
                  color="#00BCD4"
                  height="210"
                  class="d-flex flex-column align-center justify-center rounded"
                  :elevation="isHovering ? 20 : 2"
                  :class="{ 'on-hover': isHovering }"
                  v-bind="props"
                >
                  <v-icon class="mdi mdi-file-document text-h1" color="white"></v-icon>
                  <div class="text-subtitle-2 text-white">CURRICULUM</div>
                </v-card>
              </v-hover>
            </v-col>
          </v-row>
        </v-container>
        
        <v-toolbar >
            <v-toolbar-title >Latest Activities</v-toolbar-title>
        </v-toolbar>
        <v-expansion-panels>
          <v-expansion-panel
            v-for="i in 5"
            :key="i"
          >
            <v-row

              align="center"
              class="spacer pa-5"
              no-gutters
            >
              <v-col
                class="d-flex align-center"
              >
                <v-avatar
                  size="40px"
                >
                  <v-img
                    alt="Avatar"
                    src="https://avatars0.githubusercontent.com/u/9064066?v=4&s=460"
                  ></v-img>
                </v-avatar>
                <v-text class="d-flex flex-column ml-5 ">
                 <span
                  class="text-black text-h6"
                  >Thavroth Chea
                </span>
                <span
                  class="text-gray "
                  >Date: 15 Sep 2023
                </span>
              </v-text>
               
              </v-col>
            </v-row>
         
        </v-expansion-panel>
        </v-expansion-panels>
      </v-main>
    </v-layout>
  </v-card>

</template>
<script>


export default {
 
}
</script>
<style scoped>
.on-hover{
  opacity: 0.7;
}
</style>


