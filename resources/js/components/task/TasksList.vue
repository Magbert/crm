<template>
  <div class="tasks-list">
    <task-row
      v-for="task in tasks"
      :task="task"
      :key="task.id"
      @select-task="$emit('select-task', task)"
    />
  </div>
</template>

<script>
export default {
  props: ["tasks"],
  data() {
    return {};
  },
  methods: {}
};
</script>

<style lang="scss">
//
</style>