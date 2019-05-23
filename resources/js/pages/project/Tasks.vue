<template>
  <div>
    <new-task-form @add-task="addTask"/>
    <tasks-list :tasks="tasks" @select-task="selectTask"></tasks-list>
  </div>
</template>

<script>
import TasksList from "@/components/task/TasksList";

export default {
  data() {
    return {
      tasks: []
    };
  },
  methods: {
    fetchTasks() {
      axios.get(`projects/${this.$route.params.id}/tasks`).then(response => {
        this.tasks = response.data.data;
      });
    },
    selectTask(task) {
      console.log(task);
    },
    addTask(task) {
      axios
        .post(`/projects/${this.$route.params.id}/tasks`, {
          name: task.name
        })
        .then(response => {
          this.tasks.push(response.data.data);
        });
    }
  },
  mounted() {
    this.fetchTasks();
  },
  components: {
    "tasks-list": TasksList
  }
};
</script>
