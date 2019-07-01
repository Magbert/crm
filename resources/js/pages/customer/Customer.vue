<template>
  <div class="content-wrapp">
    <div class="content-block scrollable" v-if="customer">

    </div>
  </div>
</template>

<script>
import API from "@/API";

export default {
  data() {
    return {
      customer: null
    };
  },
  methods: {
    fetchCustomer() {
      API.fetchCustomer(this.$route.params.customer_id)
      .then((response) => this.customer = response.data.data);
    }
  },
  created() {
      this.fetchCustomer();
  }
};
</script>