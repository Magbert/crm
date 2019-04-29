<template>
  <div v-if="projects" class="project-list">
    <el-table :data="projects.data" style="width: 100%">
      <el-table-column prop="id" label="№" width="50"></el-table-column>
      <el-table-column prop="name" label="Название">
        <template slot-scope="scope">
          <router-link
            :to="{name: 'project.tasks', params: { id: scope.row.id }}"
            :title="scope.row.name"
            class="project-list__name"
          >{{ scope.row.name }}</router-link>
        </template>
      </el-table-column>
      <el-table-column prop="name" label="Исполнитель" width="200">
        <template slot-scope="scope" v-if="scope.row.user">
          <a href="#">{{ scope.row.user.name }}</a>
        </template>
      </el-table-column>
      <el-table-column prop="name" label="Клиент" width="200">
        <template slot-scope="scope" v-if="scope.row.user">
          <a href="#">Клиент</a>
        </template>
      </el-table-column>
      <el-table-column prop="address" label="Статус"></el-table-column>
    </el-table>
    <pagination :data="projects" @pagination-change-page="getResults"></pagination>
  </div>
</template>

<script>
export default {
  name: "project-list",

  data() {
    return {
      projects: null
    };
  },
  methods: {
    getResults(page = 1) {
      axios.get(`/projects?page=${page}`).then(response => {
        this.projects = response.data;
      });
    }
  },
  mounted() {
    this.getResults();
  }
};
</script>


<style lang="scss">
@import "sass/_variables.scss";
.project-list {
  width: 100%;
  padding-bottom: 30px;
  a {
    color: $main-color;
  }
  .el-table td,
  .el-table th {
    height: 65px;
  }
  .cell {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    a {
      line-height: 50px;
      display: block;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }
  }
  &__name {
    font-weight: 600;
  }
  .pagination {
    margin: 20px;
  }
}
</style>
