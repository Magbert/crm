<template lang="pug">
pane
    template(#header)
        el-button(type="primary" @click="modalVisible = true" size="small") Добавить компанию

    .customers-list(v-if="customers")
        .customer-row(v-for="customer in customers.data" :key="customer.id")
            router-link(:to="{ name: 'customer', params: {customer_id: customer.id} }") {{ customer.name }}

    el-dialog(title="Новая компания" :visible.sync="modalVisible" :append-to-body="true" width="500px")
        user-access-form(v-model="customer")
        .dialog-footer(slot="footer")
            el-button(type="primary" @click="createCustomer()") Создать

    pagination(
        v-if="customers"
        :data="customers" 
        @pagination-change-page="fetchCustomers"
        slot="footer"
    )
</template>

<script>
import API from "@/API";
import UserAccessForm from "@/components/user/UserAccessForm"

export default {
  data() {
    return {
      customer: {
        name: "qweq",
        email: "qqqqqq",
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
  created() {
    this.$store.commit("setHeader", { title: "Клиенты" });
  },
  mounted() {
    this.fetchCustomers();
  },
  components: {
      UserAccessForm
  }
};
</script>