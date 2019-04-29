<template>
  <div>
    <tasks-list :tasks="tasks"></tasks-list>
  </div>
</template>

<script>
import TasksList from "@/components/task/TasksList";

export default {
  data(){
    return {
      tasks: []
    }
  },
  methods: {
    fetchTasks(){
      axios.get(`projects/${this.$route.params.id}/tasks`).then(response => {
        this.tasks = response.data.data
      });
    }

  },
  mounted(){
    this.fetchTasks();
  },
  components: {
    'tasks-list': TasksList
  }
}
</script>
