<template>
  <div class="projects-page-wrapp">
    <div class="ui-header">
      <el-button
        type="primary"
        @click="outerVisible = true"
        class="d-block ml-auto"
        plain
      >Новый проект</el-button>
    </div>
    <div class="projects-page white-block scrollable">
      <project-list ref="projectList"></project-list>
    </div>

    <el-dialog title="Новый проект" :visible.sync="outerVisible" :append-to-body="true">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Название</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" v-model="name">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Сотрудник</label>
        <div class="col-sm-10">
          <select name="user" class="form-control" v-model="user_id">
            <option :value="null" selected>Не выбран</option>
            <option v-for="user in users" v-bind:value="user.id" :key="user.id">{{ user.name }}</option>
          </select>
        </div>
      </div>
      <div slot="footer" class="dialog-footer">
        <el-button @click="outerVisible = false">Отмена</el-button>
        <el-button type="primary" @click="createProject()">Создать</el-button>
      </div>
    </el-dialog>
  </div>
</template>
<script>
import ProjectList from "@/components/project/ProjectList.vue";
import API from "@/API";

export default {
  data() {
    return {
      outerVisible: false,
      name: "",
      user_id: null,
      users: null
    };
  },
  methods: {
    fetchUsers() {
      API.fetchUsers().then(respose => {
        this.users = respose.data.data;
      });
    },
    createProject() {
      API.createProject({
        name: this.name,
        user_id: this.user_id
      }).then(respose => {
        let project_id = respose.data.data.id;
        this.$router.push({
          name: "project.info",
          params: { project_id: project_id }
        });
      });
    }
  },
  created() {
    this.$store.commit("setMainClass", "");
    this.fetchUsers();
  },
  components: {
    "project-list": ProjectList
  }
};
</script>