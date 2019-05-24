<template>
  <div class="task-row">
    <router-link
      :to="{ name: 'task', params: { task_id: task.id } }"
      class="task-row__link"
    >{{ task.name }}</router-link>

    <el-dropdown trigger="click" class="task-dropdown" @command="handleCommand">
      <span class="task-dropdown__link">
        <i class="el-icon-arrow-down"></i>
      </span>
      <el-dropdown-menu slot="dropdown" class="task-dropdown__popper">
        <el-dropdown-item icon="el-icon-delete" class="danger-color" command="remove-task">Удалить</el-dropdown-item>
      </el-dropdown-menu>
    </el-dropdown>
  </div>
</template>

<script>
//$emit('remove-task', index)
export default {
  props: ["task", "index"],
  methods: {
    handleCommand(command) {
      this.$emit(command, {
        task_id: this.task.id,
        task_index: this.index
      });
    }
  }
};
</script>

<style lang="scss">
@import "sass/_variables.scss";
</style>