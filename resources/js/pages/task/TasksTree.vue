<template>
  <div class="tasks-tree">
    <div class="tasks-tree__list">
      <div class="scroller-container">
        <div class="tasks-tree__list__header">header</div>
        <div class="scrollable">
          <nested-draggable
            :tasks="tasks"
            v-if="tasks"
            class="tasks-tree__list__root"
            @sort="sort"
          />
        </div>
      </div>
    </div>

    <router-view></router-view>
  </div>
</template>

<script>
import nestedDraggable from "@/components/task/Nested";

export default {
  data() {
    return {
      tasks: null
    };
  },
  computed: {
    project() {
      return this.$store.getters.project;
    }
  },

  methods: {
    fetchTasks() {
      axios.get(`tasks/tree/1`).then(response => {
        // ${this.project.id}
        this.tasks = response.data.data;
      });
    },
    sort(val) {
      console.log(val);
    }
  },
  watch: {
    tasks(val, oldVal) {
      //console.log(val);
    }
  },
  created() {
    // this.$store.dispatch("fetchProject", { id: this.$route.params.id });
    this.fetchTasks();
    document.body.classList.add("full-width");
  },
  mounted() {},
  components: {
    nestedDraggable
  }
};
</script>
<style ></style>