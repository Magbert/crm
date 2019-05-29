<template>
  <draggable
    :list="tasks"
    :group="{ name: 'tasks' }"
    name="tasks"
    animation="200"
    handle=".handle"
    swapThreshold="0.20"
    @sort="$emit('sort', tasks)"
    fallbackOnBody="true"
  >
    <div
      v-for="task in tasks"
      :key="task.id"
      class="task-item"
      :class="getTaskClass(task)"
      :ref="'task-' + task.id"
    >
      <router-link
        class="tasks-tree__row"
        :to="{ name: 'tree-task',  params: { id: project.id, task_id: task.id } }"
      >
        <i
          class="handle"
          @mouseover="handleHover(task.id, true)"
          @mouseout="handleHover(task.id, false)"
        >
          <svg class="drag-icon" focusable="false" viewBox="0 0 32 32">
            <path
              d="M14,5.5c0,1.7-1.3,3-3,3s-3-1.3-3-3s1.3-3,3-3S14,3.8,14,5.5z M21,8.5c1.7,0,3-1.3,3-3s-1.3-3-3-3s-3,1.3-3,3S19.3,8.5,21,8.5z M11,12.5c-1.7,0-3,1.3-3,3s1.3,3,3,3s3-1.3,3-3S12.7,12.5,11,12.5z M21,12.5c-1.7,0-3,1.3-3,3s1.3,3,3,3s3-1.3,3-3S22.7,12.5,21,12.5z M11,22.5c-1.7,0-3,1.3-3,3s1.3,3,3,3s3-1.3,3-3S12.7,22.5,11,22.5z M21,22.5c-1.7,0-3,1.3-3,3s1.3,3,3,3s3-1.3,3-3S22.7,22.5,21,22.5z"
            ></path>
          </svg>
        </i>
        <span class="tasks-tree__row__name">{{ task.name }}</span>
      </router-link>
      <nested-draggable :tasks="task.subtasks" class="children-tasks"/>
    </div>
  </draggable>
</template>
<script>
import draggable from "vuedraggable";
export default {
  props: {
    tasks: {
      required: true,
      type: Array
    }
  },
  data() {
    return {};
  },
  computed: {
    project() {
      return this.$store.getters.project;
    }
  },
  methods: {
    getTaskClass(task) {
      return [{ "has-child": task.subtasks.length }, `task-${task.id}`];
    },
    handleHover(id, status) {
      let task = this.$refs[`task-${id}`];
      task[0].classList.toggle("handle-hover", status);
    },
    sort(task) {
      this.$emit("sort", task);
    }
  },
  components: {
    draggable
  },
  name: "nested-draggable"
};
</script>
<style lang="scss">
</style>