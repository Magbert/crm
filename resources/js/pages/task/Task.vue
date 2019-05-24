<template>
  <div class="task" v-if="task">
    <div class="task__name">{{ task.name }}</div>

    <el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item
        :to="{ name: 'project.tasks', id: project.id }"
        v-if="project"
        :title="project.name"
      >{{ project.name }}</el-breadcrumb-item>
      <el-breadcrumb-item
        v-for="ancestor in task.ancestors"
        :key="ancestor.id"
        :to="{ name: 'task', params: { task_id: ancestor.id } }"
        :title="ancestor.name"
      >{{ ancestor.name }}</el-breadcrumb-item>
      <el-breadcrumb-item :title="task.name">{{ task.name }}</el-breadcrumb-item>
    </el-breadcrumb>

    <el-tabs type="card" v-model="activeTab">
      <el-tab-pane label="Описание" name="description">
        <div class="input-group mb-3">
          <el-input placeholder="Please input" v-model="name"></el-input>
        </div>
        <div class="input-group mb-3">
          <editor v-model="description"></editor>
        </div>
        <button type="submit" class="btn btn-primary mr-4" @click="saveTask">Сохранить</button>
      </el-tab-pane>
      <el-tab-pane label="Подзадачи" name="second">
        <new-task-form @add-task="addTask"/>
        <tasks-list :tasks="task.subtasks" mode="subTasks"></tasks-list>
      </el-tab-pane>
    </el-tabs>
  </div>
</template>

<script>
import TasksList from "@/components/task/TasksList";
export default {
  data() {
    return {
      activeTab: "description"
    };
  },
  computed: {
    name: {
      get() {
        return this.task.name;
      },
      set(name) {
        this.$store.commit("setTask", { name });
      }
    },
    description: {
      get() {
        return this.task.description;
      },
      set(description) {
        this.$store.commit("setTask", { description });
      }
    },
    project() {
      return this.$store.getters.project;
    },
    task() {
      return this.$store.getters.task;
    }
  },
  methods: {
    addTask(new_task) {
      this.$store.dispatch("addSubTask", {
        task_name: new_task.name,
        parent_id: this.task.id,
        project_id: this.$route.params.id
      });
    },
    fetchTasks() {
      this.$store.dispatch("fetchTask", {
        task_id: this.$route.params.task_id,
        project_id: this.$route.params.id
      });
    },
    saveTask() {
      this.$store.dispatch("updateTask", { task_id: this.task.id }).then(() => {
        this.fetchTasks();
      });
    }
  },
  created() {
    this.fetchTasks();
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