<template>
  <div>
    <new-task-form @add-task="addRootTask"/>
    <tasks-list :tasks="rootTasks" v-if="rootTasks" mode="rootTasks"></tasks-list>
  </div>
</template>

<script>
import TasksList from "@/components/task/TasksList";

export default {
  methods: {
    fetchRootTasks() {
      this.$store.dispatch("fetchRootTasks", {
        project_id: this.$route.params.id
      });
    },
    addRootTask(task) {
      this.$store.dispatch("addRootTask", {
        task_name: task.name,
        project_id: this.$route.params.id
      });
    }
  },
  computed: {
    rootTasks() {
      return this.$store.getters.rootTasks;
    }
  },
  created() {
    this.fetchRootTasks();
  },
  components: {
    "tasks-list": TasksList
  }
};
</script>
