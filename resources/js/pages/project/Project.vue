<template>
  <div class="project">
    <router-view></router-view>
    <!-- :key="$route.fullPath" -->
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  //methods: {},
  computed: {},
  beforeCreate() {
    this.$store.commit("setMainClass", "small-width");
    this.$store.dispatch("fetchProject", { id: this.$route.params.id });
  }
};
</script>

<style lang="scss">
</style>


