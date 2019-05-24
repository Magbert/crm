<template>
  <div class="sidebar" id="sidebar">
    <a class="sidebar__header" href="#"></a>
    <div class="sidebar__body">
      <!-- <router-link :to="{ name: 'home' }" class="sidebar__link">Главная</router-link> -->
      <router-link :to="{ name: 'projects' }" class="sidebar__link">Проекты</router-link>

      <!-- <router-link :to="{name : 'logout'}" v-if="loggedIn">logout</router-link>
      <router-link to="/login" v-if="!loggedIn" class="sidebar__link">Login</router-link>-->
    </div>
  </div>
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

<style lang="scss">
@import "sass/_variables.scss";
.sidebar {
  display: flex;
  flex-direction: column;
  flex: 0 0 auto;
  transition: margin-left 250ms ease-out, transform 250ms ease-out;
  width: 244px;
  background-color: $main-color;
  &__header {
    align-items: center;
    display: flex;
    flex-shrink: 0;
    height: 25px;
    padding: 0 10px;
    margin: 20px 0;
    color: $white-color;
    font-weight: bold;
    font-size: 18px;
    background-image: url(/img/logo.svg);
    background-position: 15px center;
    background-repeat: no-repeat;
    background-size: 110px 19px;
  }
  &__link {
    align-items: center;
    display: flex;
    height: 40px;
    line-height: 40px;
    padding: 0 10px 0 15px;
    &,
    &:link,
    &:visited {
      color: $white-color;
    }
    &:hover {
      text-decoration: unset;
      background-color: rgba(255, 255, 255, 0.08);
    }
  }
}
</style>


