<template>
  <div class="tasks-list">
    <task-row
      v-for="(task, index) in tasks"
      :task="task"
      :index="index"
      :key="task.id"
      @select-task="$emit('select-task', task)"
      @remove-task="removeTask"
    />
  </div>
</template>

<script>
export default {
  props: ["tasks", "mode"],
  data() {
    return {};
  },
  methods: {
    removeTask(payload) {
      if (this.mode == "rootTasks") {
        this.$store.dispatch("removeRootTask", payload);
      }
      if (this.mode == "subTasks") {
        this.$store.dispatch("removeSubTask", payload);
      }
    }
  }
};
</script>

<style lang="scss">
//
</style>