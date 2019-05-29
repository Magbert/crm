<template lang="pug">
Tree(:data="data" draggable crossTree)
  div(slot-scope="{data, level, store}")
    template(v-if="!data.isDragPlaceHolder")
      b(v-if="data.children && data.children.length" @click="store.toggleOpen(data)") {{data.open ? '-' : '+'}}&nbsp;
      span {{data.text}}
</template>

<script>
import { DraggableTree } from "vue-draggable-nested-tree";
export default {
  data() {
    return {
      data: [
        { text: "node 1" },
        { text: "node 2" },
        { text: "node 3 undraggable", draggable: false },
        { text: "node 4" },
        { text: "node 4 undroppable", droppable: false },
        {
          text: "node 5",
          children: [
            { text: "node 1" },
            {
              text: "node 2",
              children: [{ text: "node 3" }, { text: "node 4" }]
            },
            {
              text: "node 2 undroppable",
              droppable: false,
              children: [{ text: "node 3" }, { text: "node 4" }]
            },
            {
              text: "node 2",
              children: [
                { text: "node 3" },
                { text: "node 4 undroppable", droppable: false }
              ]
            },
            { text: "node 3" },
            { text: "node 4" },
            { text: "node 3" },
            { text: "node 4" },
            { text: "node 3" },
            { text: "node 4" },
            { text: "node 3" },
            { text: "node 4" }
          ]
        }
      ]
    };
  }
};
</script>

<style lang="scss">
//
</style>