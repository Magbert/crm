<template>
  <div class="content-wrapp">
    <div class="ui-header w-850">
        <el-button type="primary" @click="modalVisible = true" class="d-block ml-auto" size="small" plain>Добавить сотрудника</el-button>
    </div>
    <div class="content-block scrollable" v-if="users">
      <div class="content-block__inner w-850">
        <div class="users-list">
          <div v-for="user in users.data" :key="user.id" class="user-row">
            <div class="user-row__thumb">
                <div class="user-row__thumb__img"></div>
                <el-badge  :value="user.projects.length" type="warning"/>
            </div>
            <div>
                <router-link :to="{ name: 'user', params: {user_id: user.id} }" class="user-row__name">{{ user.name }}</router-link>
                <div class="user-row__role">Менеджер</div>
            </div>
            <div></div>
          </div>
        </div>
        <pagination :data="users" @pagination-change-page="fetchUsers"></pagination>
      </div>
    </div>

    <el-dialog title="Новая компания" :visible.sync="modalVisible" :append-to-body="true" width="500px">
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
        <div class="col-sm-10 flex-row d-flex">
          <input type="text" class="form-control" v-model="user.password">
          <!-- <el-button icon="el-icon-refresh" size="small"></el-button>           -->
        </div>
      </div>
      <div slot="footer" class="dialog-footer">
        <el-button @click="modalVisible = false">Отмена</el-button>
        <el-button type="primary" @click="createUser()">Добавить</el-button>
      </div>
    </el-dialog>
  </div>
</template>


<script>
import API from "@/API";

export default {
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: ""
      },
      modalVisible: false,
      users: null
    };
  },
  methods: {
    createUser(){
      API.addUser(this.user).then(response => {
          let user_id = response.data.data.id;
          this.$router.push({ name: "user", params: { user_id } });
      });
    },
    fetchUsers(page = 1) {
      API.fetchUsersPaginate(page).then(response => {
        this.users = response.data;
      });
    }
  },
  mounted() {
    this.fetchUsers();
  }
};
</script>