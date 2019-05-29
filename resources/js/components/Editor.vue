<template>
  <div class="textEditor">
    <quill-editor
      :options="editorOption"
      @change="onEditorChange($event)"
      :value="value"
      ref="textEditor"
    ></quill-editor>
  </div>
</template>

<script>
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";

import { quillEditor } from "vue-quill-editor";

export default {
  props: ["value"],

  data() {
    return {
      editorOption: {
        // theme: "bubble",
        modules: {
          toolbar: [
            // [{ size: ["small", false, "large"] }],
            ["bold", "italic", "underline", "strike"],
            [{ list: "ordered" }, { list: "bullet" }],
            [{ color: [] }, { background: [] }]
            // ["link"]
          ],
          history: {
            delay: 1000,
            maxStack: 50,
            userOnly: false
          }
        }
      }
      //editor: null
    };
  },
  computed: {
    editor() {
      return this.$refs.textEditor.quill;
    }
  },
  methods: {
    onEditorChange(event) {
      this.$emit(
        "input",
        this.editor.getText() ? this.editor.root.innerHTML : ""
      );
    }
  },
  mounted() {
    this.editor.root.innerHTML = this.value;
  },
  components: {
    quillEditor
  }
};
</script>

<style lang="scss">
.textEditor {
  .ql-editor {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
      "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 20px;
  }
  .ql-toolbar.ql-snow {
    border-bottom: 0;
  }
}
</style>