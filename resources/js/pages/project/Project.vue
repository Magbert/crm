<template>
  <div class="project p15 white-block">
    <router-view :key="$route.fullPath"></router-view>
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
    this.$store.dispatch("fetchProject", { id: this.$route.params.id });
  }
};
</script>

<style lang="scss">
.project {
  width: 100%;
  height: 100vh;
}
</style>


