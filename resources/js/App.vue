<template lang="pug">
  #app.app
    v-sidebar
    .app__main
      v-header
      .app__content
        router-view
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