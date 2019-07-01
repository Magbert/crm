<template>
    <div class="content-wrapp w-850" v-if="user">
        <h2 class="mb-3">{{ user.name }}</h2>
        <div class="content-block scrollable white-bg">
             <el-tabs v-model="activeTab">
                <el-tab-pane label="Проекты" name="projects">
                    <el-table :data="user.projects" style="width: 100%">
                        <el-table-column prop="id" label="№" width="50"></el-table-column>
                        <el-table-column prop="name" label="Название">
                            <template slot-scope="scope">
                            <router-link
                                :to="{name: 'tasks', params: { project_id: scope.row.id }}"
                                :title="scope.row.name"
                                class="project-list__name"
                            >{{ scope.row.name }}</router-link>
                            </template>
                        </el-table-column>
                        <el-table-column prop="name" label="Клиент" width="200">
                            <template slot-scope="scope" v-if="scope.row.customer">
                                <a href="#">{{ scope.row.customer.name }}</a>
                            </template>
                        </el-table-column>
                        <el-table-column prop="address" label="Статус"></el-table-column>
                    </el-table>
                </el-tab-pane>
                <el-tab-pane label="Профиль" name="profile">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Имя</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" v-model="user.name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" v-model="user.email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Пароль</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" v-model="user.password">
                                </div>
                            </div>
                        </div>
                    </div>
                </el-tab-pane>
            </el-tabs>
        </div>
    </div>
</template>

<script>
import API from "@/API";

export default {
  data() {
    return {
        activeTab: 'projects',
        user: null
    };
  },
  methods: {
    fetchUser() {
      API.fetchUser(this.$route.params.user_id)
      .then((response) => this.user = response.data.data);
    }
  },
  created() {
      this.fetchUser();
  }
};
</script>