<template lang="pug">
  #app.app
    v-sidebar
    .app__main
      v-header
      router-view.app__content
</template>

<script>
import Header from "./components/base/Header";
import Sidebar from "./components/base/Sidebar";

export default {
  components: {
    "v-header": Header,
    "v-sidebar": Sidebar
  }
};
</script>