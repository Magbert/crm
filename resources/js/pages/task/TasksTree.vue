<template>
  <div class="tasks-tree">
    <div class="tasks-tree__list">
      <div class="scroller-container">
        <div class="tasks-tree__list__header">
          <div class="form-new-task">
            <el-input
              size="small"
              placeholder="Название задачи"
              v-model="newTask.name"
              @keyup.enter.native="addTask"
            ></el-input>
          </div>
        </div>
        <div class="scrollable">
          <nested-draggable
            :tasks="tasks"
            v-if="tasks && project"
            class="tasks-tree__list__root"
            group="asd"
            @move-task="moveTask"
            @open-cmenu="openContextMenu"
          />
        </div>
      </div>
    </div>
    <vue-context ref="context_menu" class="context-menu">
      <!-- <li>
        <a href="#">
          <span>Удалить</span>
        </a>
      </li>-->
      <li class="del-link">
        <a href="#" @click.prevent="removeTask()">
          <span>Удалить</span>
          <i class="el-icon-delete"></i>
        </a>
      </li>
    </vue-context>
    <router-view :key="$route.fullPath"></router-view>
  </div>
</template>

<script>
import nestedDraggable from "@/components/task/Nested";
import { mapGetters } from "vuex";
import { taskMixins } from "@/mixins";

export default {
  data() {
    return {
      newTask: {
        name: ""
      },
      contextTaskId: null
    };
  },
  computed: {
    ...mapGetters(["project", "tasks", "task"])
  },

  methods: {
    removeTask() {
      this.$store.dispatch("removeTask", { task_id: this.contextTaskId });

      if (this.task.id == this.contextTaskId) {
        this.$store.commit("resetTask");
        this.$router.push({ name: "tasks", params: { project_id: this.$route.params.project_id } });
      }
      this.successMsg("Задача удалена!");
    },

    openContextMenu(event, data) {
      this.contextTaskId = data.task_id;
      this.$refs.context_menu.open(event);
    },

    addTask() {
      if (!this.task) {
        this.$store.dispatch("addRootTask", {
          task_name: this.newTask.name,
          project_id: this.$route.params.project_id
        });
      } else {
        this.$store.dispatch("addSubTask", {
          task_name: this.newTask.name,
          parent_id: this.task.id,
          project_id: this.$route.params.project_id
        });
      }
      this.newTask.name = "";
    },
    moveTask(data) {
      this.$store.dispatch("updateTasksOrder", {
        tasks: data,
        project_id: this.$route.params.project_id
      });
    },
    fetchTasks() {
      this.$store.dispatch("fetchTasks", { project_id: this.$route.params.project_id });
    }
  },

  created() {
    this.fetchTasks();
    document.body.classList.add("full-width");
  },
  components: {
    nestedDraggable
  },
  mixins: [taskMixins]
};
</script>
<style ></style>