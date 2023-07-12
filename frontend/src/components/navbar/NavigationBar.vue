<template>
  <v-app-bar>
    <v-img
      src="../../assets/school-1.png"
      alt="Logo"
      max-width="60"
      max-height="50"
      class="ma-3"
      contain
    ></v-img>
      <v-breadcrumbs :items="breadCrum" class="mt-3">
        <template v-slot:divider>
          <v-icon icon="mdi-chevron-right"></v-icon>
        </template>
      </v-breadcrumbs>
    <v-spacer></v-spacer>
    <v-btn icon>
      <v-icon>mdi-magnify</v-icon>
    </v-btn>

    <v-btn icon>
      <v-icon>mdi-moon-waning-crescent</v-icon>
    </v-btn>

    <v-btn icon @click="onClickVertical">
      <v-menu>
        <template v-slot:activator="{ props }">
          <v-btn icon="mdi-dots-vertical" v-bind="props"></v-btn>
        </template>

        <v-list
          class="d-flex rounded-0 hover bg-gray pointer"
          v-for="(item, i) in items"
          :key="i"
        >
          <v-list-item>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item>
          <v-list-item>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-btn>
  </v-app-bar>
</template>
<script>
export default {
  props: ['breadCrum'],
  data() {
    return {
      isVertical: false,
      items: [
        { title: "Your Profile", icon: "mdi-account-circle" },
        { title: "Reset Password", icon: "mdi-update" },
        { title: "Log Out", icon: "mdi-logout" },
      ],
    };
  },
  methods: {
    onClickVertical() {
      this.isVertical = !this.isVertical;
      console.log(this.isVertical);
    },
  },
};
</script>
<style scoped>
* {
  padding: 0;
  margin: 0;
}

.hover:hover {
  background-color: #d9d6d6ed;
  cursor: pointer;
}
</style>