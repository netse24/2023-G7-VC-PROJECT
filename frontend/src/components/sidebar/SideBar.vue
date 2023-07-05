<template>
  
  <v-navigationdrawer expand-on-hover  class="bg-blue-lighten-3" rail>
    <link
    href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css"
    rel="stylesheet"
    />
    <v-list>
      <v-listItem
        prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg"
        title="John Smith"
        subtitle="johnsmith@gmail.com"
      ></v-listItem>
    </v-list>
    <VDivider/>
      <v-list >
        <!-- icon = mdi -->
        <v-listitem prepend-icon="mdi-home" title="Home" value="myfiles" class="my-10"></v-listitem>
        <v-listitem prepend-icon="mdi-school-outline" title="Students" value="shared"></v-listitem>
        <v-listitem prepend-icon="mdi-account-tie" title="Teachers" value="starred" class="my-10"></v-listitem>
        <v-listitem prepend-icon="mdi-table" title="Schedule" value="schedule"></v-listitem>
      </v-list>
  </v-navigationdrawer>
</template>
