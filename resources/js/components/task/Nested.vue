<template>
  <draggable
    v-model="tasksTree"
    :group="{ name: group }"
    name="tasks"
    animation="200"
    handle=".handle"
    swapThreshold="0.70"
    fallbackOnBody="true"
  >
    <div
      v-for="task in tasksTree"
      :key="task.id"
      :class="getTaskClass(task)"
      :ref="'task-' + task.id"
      class="task-item"
      v-show="task.show"
    >
      <taskrow :projectId="project.id" :task="task" @open-cmenu="openContextMenu"></taskrow>
      <nested-draggable
        :tasks="task.children"
        :parent-id="task.id"
        :group="task.id"
        @move-task="moveTask"
        @open-cmenu="openContextMenu"
        class="children-tasks"
      />
    </div>
  </draggable>
</template>
<script>
import draggable from "vuedraggable";
import taskrow from "@/components/task/TaskRow";

export default {
  props: ["tasks", "parentId", "group"],
  watch: {},
  data() {
    return {};
  },
  computed: {
    project() {
      return this.$store.getters.project;
    },
    tasksTree: {
      get() {
        return this.tasks;
      },
      set(value) {
        this.$emit("move-task", { tasks: value, parent_id: this.parentId });
      }
    }
  },
  methods: {
    getTaskClass(task) {
      return [{ "has-child": task.children.length }, `task-${task.id}`];
    },
    handleHover(id, status) {
      let task = this.$refs[`task-${id}`];
      task[0].classList.toggle("handle-hover", status);
    },
    moveTask(data) {
      this.$emit("move-task", data);
    },
    openContextMenu(event, data) {
      this.$emit("open-cmenu", event, data);
    }
  },
  components: {
    draggable,
    taskrow
  },
  name: "nested-draggable"
};
</script>
<style lang="scss">
</style>