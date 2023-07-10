<template>
  <v-card>
    <slot name="header">
      <h1 class="d-flex bold justify-center bg-cyan pa-3">
        CREATE USER
      </h1>
    </slot>
    <section>
      <slot name="body"></slot>
    </section>
    <menu>
      <div>
        <slot name="cencel">
        </slot>
      </div>
      <div>
        <slot name="actions">
        </slot>
      </div>
    </menu>
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
