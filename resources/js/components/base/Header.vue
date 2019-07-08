<template lang="pug">
.app__header(v-if="header.show")
  .app__header__left
    .app__header__title(v-html="header.title")
    .app__header__nav(v-if="header.nav")
      router-link.app__header__nav__link(
        v-for="(link, index) in header.nav"
        :key="index"
        :to="link.to"
      ) {{ link.title }}
  .app__header__right
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  computed: {
    ...mapGetters(['loggedIn', 'header'])
  }
};
</script>
