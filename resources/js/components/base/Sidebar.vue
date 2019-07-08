<template lang="pug">
.sidebar#sidebar
  a.sidebar__header(href="/")
  .sidebar__body
    router-link.sidebar__link( :to="{ name: 'home' }") Главная
    router-link.sidebar__link( :to="{ name: 'projects' }") Проекты
    router-link.sidebar__link( :to="{ name: 'customers' }") Клиенты
    router-link.sidebar__link( :to="{ name: 'users' }") Сотрудники
    //- router-link.sidebar__link( :to="{ name: 'logout' }" v-if="loggedIn") logout
    //- router-link.sidebar__link( to="/login" v-if="!loggedIn") Login
</template>
<script>
export default {
  computed: {
    loggedIn() {
      return this.$store.getters.loggedIn;
    }
  }
};
</script>


