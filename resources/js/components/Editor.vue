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
        modules: {
          toolbar: [
            ["bold", "italic", "underline", "strike"],
            [{ list: "ordered" }, { list: "bullet" }],
            [{ color: [] }, { background: [] }]
          ],
          history: {
            delay: 1000,
            maxStack: 50,
            userOnly: false
          }
        }
      }
    };
  },
  computed: {
    editor() {
      return this.$refs.textEditor.quill;
    }
  },
  methods: {
    onEditorChange(event) {
      this.$emit( "input", this.editor.getText() ? this.editor.root.innerHTML : "" );
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
