<template lang="pug">
    .pane(:class="{ pane_strech : strech }")
        .pane__header(v-if="$slots.header")
            slot(name="header")
        .pane__content
            slot
        .pane__footer(v-if="$slots.footer")
            slot(name="footer")
</template>

<script>
export default {
  name: "pane",
  props: {
    strech: {
      type: Boolean
    }
  }
};
</script>