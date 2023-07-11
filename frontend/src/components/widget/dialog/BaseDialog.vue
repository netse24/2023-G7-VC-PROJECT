<template>
  <v-card>
    <slot name="header">
      <h1 class="d-flex justify-center bg-cyan pa-3 text-xl font-weight-bold">
        CREATE USER
      </h1>
    </slot>
    <section>
      <slot name="body"></slot>
    </section>
  </v-card>
</template>
<script>
export default {
};
</script>

<style scoped>

section {
  padding: 1rem;
}

menu {
  display: flex;
  justify-content: space-between;
  margin: 0;
}
</style>
