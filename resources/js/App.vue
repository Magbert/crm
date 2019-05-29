<template>
  <div id="app">
    <div class="main-wrapp" :class="this.$store.getters.mainclass">
      <div class="crm-ui">
        <sidebar-component></sidebar-component>
        <main class="main-container">
          <header-component>
            <router-view name="header"></router-view>
          </header-component>
          <div class="content">
            <router-view></router-view>
          </div>
        </main>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import Header from "./components/Header";
import Sidebar from "./components/Sidebar";

export default {
  computed: {
    loggedIn() {
      return this.$store.getters.loggedIn;
    }
  },
  components: {
    "header-component": Header,
    "sidebar-component": Sidebar
  }
};
</script>

<style lang="scss">
</style>

