<template>
  <div class="projects-page white-block">
    <project-list></project-list>
  </div>
</template>
<script>
import ProjectList from "@/components/project/ProjectList.vue";
export default {

  components: {
    'project-list': ProjectList,
  },
}
</script>

<style lang="scss">
@import "sass/_variables.scss";
.projects-page {
  display: flex;
  flex: 1 1 auto;
  flex-direction: column;
}
</style>
