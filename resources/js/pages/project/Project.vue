<template>
  <div class="project">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  computed: {},
  beforeCreate() {
    this.$store.dispatch("fetchProject", this.$route.params.project_id);
  }
};
</script>


