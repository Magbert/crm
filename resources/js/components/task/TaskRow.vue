<template>
  <div @contextmenu.prevent="$emit('open-cmenu', $event, {task_id: task.id })">
    <router-link
      class="tasks-tree__row"
      :to="{ name: 'task',  params: { project_id: projectId, task_id: task.id } }"
      tag="div"
    >
      <div class="tasks-tree__row__left">
        <i class="handle">
          <svg class="drag-icon" focusable="false" viewBox="0 0 32 32">
            <path
              d="M14,5.5c0,1.7-1.3,3-3,3s-3-1.3-3-3s1.3-3,3-3S14,3.8,14,5.5z M21,8.5c1.7,0,3-1.3,3-3s-1.3-3-3-3s-3,1.3-3,3S19.3,8.5,21,8.5z M11,12.5c-1.7,0-3,1.3-3,3s1.3,3,3,3s3-1.3,3-3S12.7,12.5,11,12.5z M21,12.5c-1.7,0-3,1.3-3,3s1.3,3,3,3s3-1.3,3-3S22.7,12.5,21,12.5z M11,22.5c-1.7,0-3,1.3-3,3s1.3,3,3,3s3-1.3,3-3S12.7,22.5,11,22.5z M21,22.5c-1.7,0-3,1.3-3,3s1.3,3,3,3s3-1.3,3-3S22.7,22.5,21,22.5z"
            ></path>
          </svg>
        </i>
        <span class="tasks-tree__row__name">{{ task.name }}</span>
      </div>
      <div class="tasks-tree__row__right" @click.stop>
        <el-date-picker
          v-if="due_time"
          v-model="due_time"
          type="date"
          placeholder
          :format="dateFormat"
          value-format="timestamp"
          size="mini"
          :clearable="false"
          prefix-icon="non"
          v-bind:class="{'short-date': isCurrentDate(due_time)}"
          align="right"
        ></el-date-picker>
      </div>
    </router-link>
  </div>
</template>

<script>
import { taskMixins } from "../../mixins";
// @mouseover="handleHover(task.id, true)"
//           @mouseout="handleHover(task.id, false)"
export default {
  props: ["projectId", "task"],
  computed: {
    due_time: {
      get() {
        return this.task.due_time;
      },
      set(due_time) {
        this.$store.dispatch("updateTask", {
          task_id: this.task.id,
          due_time: due_time
        });
      }
    }
  },
  mixins: [taskMixins]
};
</script>

<style lang="scss">
//
</style>