<template>
  <div class="task-row">
    <a href="#" class="task-row__link">{{ task.name }}</a>
  </div>
</template>

<script>
export default {
  props: ["task"]
  //
};
</script>

<style lang="scss">
.task-row {
}
</style>