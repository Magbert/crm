<template>
  <pane>
    <template #header>
      <el-button
        type="primary"
        @click="modalVisible = true"
        size="small"
      >Добавить компанию</el-button>
    </template>
    <div class="customers-list" v-if="customers">
      <div v-for="customer in customers.data" :key="customer.id" class="customer-row">
        <router-link :to="{ name: 'customer', params: {customer_id: 49} }">{{ customer.name }}</router-link>
      </div>
    </div>
    <el-dialog
      title="Новая компания"
      :visible.sync="modalVisible"
      :append-to-body="true"
      width="500px"
    >
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Название</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" v-model="customer.name" />
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" v-model="customer.email" />
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Пароль</label>
        <div class="col-sm-10 flex-row d-flex">
          <input type="text" class="form-control" v-model="customer.password" />
        </div>
      </div>
      <div slot="footer" class="dialog-footer">
        <el-button @click="modalVisible = false">Отмена</el-button>
        <el-button type="primary" @click="createCustomer()">Создать</el-button>
      </div>
    </el-dialog>
    <template #footer>
      <pagination :data="customers" @pagination-change-page="fetchCustomers" v-if="customers"></pagination>
    </template>
  </pane>
</template>


<script>
import API from "@/API";

export default {
  data() {
    return {
      customer: {
        name: "",
        email: "",
        password: ""
      },
      modalVisible: false,
      customers: null
    };
  },
  methods: {
    createCustomer() {
      API.addCustomer(this.customer).then(response => {
        console.log(response);
      });
    },
    fetchCustomers(page = 1) {
      API.fetchCustomersPaginate(page).then(response => {
        this.customers = response.data;
      });
    }
  },
  mounted() {
    this.fetchCustomers();
  }
};
</script>