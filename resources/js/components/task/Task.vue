<template>
  <div class="single-task" v-if="task" :key="task.id">
    <div class="scroller-container">
      <div class="single-task__header">single-task</div>
      <div class="scrollable">
        <!-- single-task__name__input -->
        <div class="single-task__name-input">
          <div class="single-task__name-input__inner">
            <div class="single-task__name-input__shadow">{{ task.name }}|</div>
            <textarea
              class="single-task__name-input__textarea simple-textarea"
              placeholder="Название задачи"
              v-model="task.name"
              @keydown.enter.exact.prevent
            ></textarea>
          </div>
        </div>
        <!--/ ssingle-task__name__input -->

        <!-- single-task__description -->
        <div class="single-task__description">
          <editor></editor>
        </div>
        <!-- /single-task__description -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    task() {
      return this.$store.getters.task;
    }
  },
  methods: {
    fetchTasks(task_id) {
      this.$store.dispatch("fetchTask", { task_id });
    }
  },
  beforeRouteUpdate(to, from, next) {
    this.fetchTasks(to.params.task_id);
    next();
  },
  created() {
    this.fetchTasks(this.$route.params.task_id);
  }
};
</script>