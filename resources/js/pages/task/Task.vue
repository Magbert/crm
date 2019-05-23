<template>
  <div class="task">
    <div class="task__name">{{ name }}</div>

    <el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item
        :to="{ name: 'project.tasks', id: project.id }"
        v-if="project"
        :title="project.name"
      >{{ project.name }}</el-breadcrumb-item>
      <el-breadcrumb-item
        v-for="ancestor in ancestors"
        :key="ancestor.id"
        :to="{ name: 'task', params: { task_id: ancestor.id } }"
        :title="ancestor.name"
      >{{ ancestor.name }}</el-breadcrumb-item>
      <el-breadcrumb-item :title="name">{{ name }}</el-breadcrumb-item>
    </el-breadcrumb>

    <el-tabs type="card" v-model="activeTab">
      <el-tab-pane label="Описание" name="description"></el-tab-pane>
      <el-tab-pane label="Подзадачи" name="second">
        <new-task-form @add-task="addTask"/>
        <tasks-list :tasks="subtasks"></tasks-list>
      </el-tab-pane>
    </el-tabs>
  </div>
</template>

<script>
import TasksList from "@/components/task/TasksList";
export default {
  data() {
    return {
      task_id: "",
      name: "",
      subtasks: [],
      ancestors: [],
      activeTab: "description"
    };
  },
  created() {
    let project_id = this.$route.params.id;
    this.task_id = this.$route.params.task_id;
    axios
      .get(`/projects/${project_id}/tasks/${this.task_id}`)
      .then(response => {
        let data = response.data.data;
        this.id = data.id;
        this.name = data.name;
        this.subtasks = data.subtasks;
        this.ancestors = data.ancestors;
      });
  },
  computed: {
    project() {
      return this.$store.getters.project;
    }
  },
  methods: {
    addTask(task) {
      axios
        .post(`/projects/${this.project.id}/tasks`, {
          name: task.name,
          parent: this.task_id
        })
        .then(response => {
          this.subtasks.push(response.data.data);
        });
    }
  },
  components: {
    "tasks-list": TasksList
  }
};
</script>

<style lang="scss">
.task {
  &__name {
    font-size: 22px;
    margin-bottom: 15px;
  }
}

.el-breadcrumb {
  margin-bottom: 30px;
  //   background-color: #eff7ff;
  padding: 10px;
  &__inner {
    max-width: 200px;
    display: inline-block;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }
}
</style>