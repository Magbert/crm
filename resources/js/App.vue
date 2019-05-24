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
.main-wrapp {
  display: flex;
  flex-direction: column;
  bottom: 0;
  left: 0;
  overflow: hidden;
  position: fixed;
  right: 0;
  top: 0;
  z-index: 0;
}
.crm-ui {
  display: flex;
  flex: 1;
  min-height: 1px;
  overflow: hidden;
}

.main-container {
  display: flex;
  flex: 1;
  flex-direction: column;
  min-width: 920px;
  position: relative;
}
.content {
  display: flex;
  flex: 1 1 auto;
  flex-direction: column;
  min-height: 1px;
  position: relative;
  overflow-y: auto;
  padding: 15px;
}
</style>

