<template>
  <div class="task-row">
    <router-link
      :to="{ name: 'task', params: { task_id: task.id } }"
      class="task-row__link"
    >{{ task.name }}</router-link>

    <el-dropdown trigger="click" class="task-dropdown">
      <span class="task-dropdown__link">
        <i class="el-icon-arrow-down"></i>
      </span>
      <el-dropdown-menu slot="dropdown" class="task-dropdown__popper">
        <el-dropdown-item icon="el-icon-delete" class="danger-color">Удалить</el-dropdown-item>
      </el-dropdown-menu>
    </el-dropdown>
  </div>
</template>

<script>
export default {
  props: ["task"]
  //
};
</script>

<style lang="scss">
@import "sass/_variables.scss";
</style>