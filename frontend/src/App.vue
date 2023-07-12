<template>
  <section>
    <router-view/>
  </section>
</template>
<script>
import { userInformations } from "@/store/userStore";

export default {
  setup() {
    const userData = userInformations();
    return {
      userData,
    };
  },
};
</script>

