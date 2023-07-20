<template>
  <form class="w-75 m-auto mt-3">
    <div class="mb-3">
      <select
        id="disabledSelect"
        class="form-select"
        v-model="filterValue"
        @input="filterOption"
      >
        <option v-for="option in selectOption" :key="option.name">
          {{ option.name }}
        </option>
      </select>
    </div>
  </form>
</template>

<script>
import { axiosClient } from "../../axios-http";
export default {
  data() {
    return {
      selectOption: [],
      filterValue: "",
    };
  },
  methods: {
    filterOption() {
      axiosClient
        .get("classes")
        .then((response) => {
          this.selectOption = response.data.data;
          console.log(this.filterValue);
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
  mounted() {
    this.filterOption();
  },
  created() {},
};
</script>

<style>
</style>