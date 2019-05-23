<template>
  <div class="new-task-form mb-4">
    <el-input placeholder="Название задачи" v-model="task.name" @keyup.enter.native="add"></el-input>
    <el-button type="primary" icon="el-icon-plus" @click="add">Добавить</el-button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      task: {
        name: ""
      }
    };
  },
  methods: {
    add() {
      this.$emit("add-task", this.task);
      this.task.name = "";
    }
  }
};
</script>

<style lang="scss">
//
</style>