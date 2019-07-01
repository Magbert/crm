<template>
  <div class="content-wrapp">
     <div class="ui-header w-850">
        <el-button type="primary" @click="modalVisible = true" class="d-block ml-auto" size="small" plain>Добавить компанию</el-button>
      </div>
    <div class="content-block scrollable" v-if="customers">
      <div class="content-block__inner w-850">
        <div class="customers-list">
          <div v-for="customer in customers.data" :key="customer.id" class="customer-row">
            <router-link :to="{ name: 'customer', params: {customer_id: 49} }" >{{ customer.name }}</router-link>
          </div>
        </div>
        <pagination :data="customers" @pagination-change-page="fetchCustomers"></pagination>
      </div>
    </div>

    <el-dialog title="Новая компания" :visible.sync="modalVisible" :append-to-body="true" width="500px">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Название</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" v-model="customer.name">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" v-model="customer.email">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Пароль</label>
        <div class="col-sm-10 flex-row d-flex">
          <input type="text" class="form-control" v-model="customer.password">
          <!-- <el-button icon="el-icon-refresh" size="small"></el-button>           -->
        </div>
      </div>
      <div slot="footer" class="dialog-footer">
        <el-button @click="modalVisible = false">Отмена</el-button>
        <el-button type="primary" @click="createCustomer()">Создать</el-button>
      </div>
    </el-dialog>
  </div>
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
    createCustomer(){
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