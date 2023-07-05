<template>
  
  <VNavigationDrawer expand-on-hover  class="bg-cyan" rail>
    <link
    href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css"
    rel="stylesheet"
    />
    <VList>
      <VListItem
        prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg"
        title="John Smith"
        subtitle="johnsmith@gmail.com"
      ></VListItem>
    </VList>
    <VDivider/>
      <VList >
        <!-- icon = mdi -->
        <VListItem prepend-icon="mdi-home" title="Home" value="myfiles" class="my-10"></VListItem>
        <VListItem prepend-icon="mdi-school-outline" title="Students" value="shared"></VListItem>
        <VListItem prepend-icon="mdi-account-tie" title="Teachers" value="starred" class="my-10"></VListItem>
        <VListItem prepend-icon="mdi-table" title="Schedule" value="schedule"></VListItem>
      </VList>
  </VNavigationDrawer>
</template>
