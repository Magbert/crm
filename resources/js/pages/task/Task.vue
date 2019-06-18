<template>
  <div class="single-task" v-if="task" :key="task.id">
    <div class="scroller-container">
      <div class="single-task__header">
        <el-button icon="el-icon-close" plain @click="close" class="border-0"></el-button>
        <div class="single-task__header__tools">
          <el-button type="danger" icon="el-icon-delete" plain circle @click="remove" size="mini"></el-button>
        </div>
      </div>
      <div class="scrollable">
        <!-- single-task__name__input -->
        <div class="single-task__name-input">
          <div class="single-task__name-input__inner">
            <div class="single-task__name-input__shadow">{{ name }}|</div>
            <textarea
              class="single-task__name-input__textarea simple-textarea"
              placeholder="Название задачи"
              v-model="name"
              @keydown.enter.exact.prevent
            ></textarea>
          </div>
        </div>
        <!--/ ssingle-task__name__input -->

        <div class="date_asigne_row">
          <el-date-picker
            v-model="due_time"
            type="date"
            placeholder="Укажите дату"
            :format="dateFormat"
            value-format="timestamp"
            size="small"
          ></el-date-picker>
        </div>

        <!-- single-task__description -->
        <div class="single-task__description">
          <editor v-model="description"></editor>
        </div>
        <!-- /single-task__description -->
      </div>
      <div class="single-task__footer">sdfsdf</div>
    </div>
  </div>
</template>

<script>
import { taskMixins } from "../../mixins";
import _ from "lodash";

export default {
  data() {
    return {};
  },
  computed: {
    due_time: {
      get() {
        return this.task.due_time;
      },
      set(due_time) {
        this.updateTask("due_time", due_time);
      }
    },
    name: {
      get() {
        return this.task.name;
      },
      set(name) {
        this.updateTask("name", name);
      }
    },
    description: {
      get() {
        return this.task.description;
      },
      set(description) {
        this.updateTask("description", description);
      }
    },
    task() {
      return this.$store.getters.task;
    }
  },
  methods: {
    remove() {
      this.$store.dispatch("removeTask", {
        project_id: this.$route.params.id,
        task_id: this.task.id
      });
      this.successMsg("Задача удалена!");

      this.close();
    },
    close() {
      this.$store.commit("resetTask");

      this.$router.push({
        name: "tasks",
        params: { id: this.$route.params.id }
      });
    },

    updateTask(key, value) {
      this.$store.dispatch("updateTask", {
        task_id: this.task.id,
        [key]: value
      });
    },

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
  },
  mixins: [taskMixins]
};
</script>