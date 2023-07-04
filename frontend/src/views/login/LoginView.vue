<template>
<section class= "w-75 mx-auto mt-15">
  <div class="mx-auto my-auto d-flex justify-center">
    <v-card 
      class="form w-50 pa-12 pb-8 rounded-0"
      max-width="350"
      >
      <h1 class="d-flex justify-center">Login</h1>
      <div class="text-subtitle-1 text-medium-emphasis">Account</div>
      <v-text-field
        density="compact"
        placeholder="Email address"
        prepend-inner-icon="mdi-email-outline"
      ></v-text-field>
      <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
        Password
      </div>
      <v-text-field
        :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
        :type="visible ? 'text' : 'password'"
        density="compact"
        placeholder="Enter your password"
        prepend-inner-icon="mdi-lock-outline"
        @click:append-inner="visible = !visible"
      ></v-text-field>
      <v-card
        class="mb-12"
        color="surface-variant"
        variant="tonal">
      </v-card>
      <v-btn
        block
        class="mb-8 bg-cyan"
        color="light"
        size="large"
        variant="tonal">Log In
      </v-btn>
    </v-card>
    <v-card
      class="bg-cyan d-flex justify-center flex-column rounded-0" 
      max-width="500">
      <v-img
        max-height="150"
        class="mx-auto my-4"
        src="https://o.remove.bg/downloads/2d76375d-7df3-4324-9c2b-ce82f7ac3004/366-3666562_passerelles-numeriques-cambodia-hd-png-download-removebg-preview.png"
      ></v-img>
      <h2 class="d-flex justify-center">Welcome to School </h2>
    </v-card>
  </div>
</section>
</template>
<script>
export default {

}
</script>

<style>

</style>