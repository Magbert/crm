<template>
  <div class="user-picker" :class="{'select-open' : showSelectInput}">
    <div class="user-picker__inner">
      <div class="user-picker__button">
        <div
          v-if="value"
          class="user-picker__button__avatar"
          style="background-image: url('/user_photos/1/avatar_36x36.jpg')"
        ></div>
        <div v-if="!value" class="user-picker__button__avatar empty-user">
          <i class="el-icon-user"></i>
        </div>
        <div class="user-picker__button__label-title">
          <div class="user-picker__button__title" v-if="value">Ответственный</div>
          <div class="user-picker__button__title" v-if="!value">Не назначен</div>
          <div class="user-picker__button__label" v-if="value">{{ value.name }}</div>
        </div>
        <div class="user-picker__remove" @click="clear">
          <i class="el-icon-error"></i>
        </div>
      </div>
      <div class="user-picker__select" :class="{'show-select' : showSelectInput}">
        <el-select
          :value="value"
          filterable
          placeholder="Select"
          value-key="id"
          ref="user_select"
          @visible-change="visibleChange"
          @change="change"
        >
          <el-option
            v-for="user in users"
            :key="user.id"
            :label="user.name"
            :value="user"
            class="user-picker__select__option"
          >
            <div class="user-picker__select__avatar"></div>
            <div class="user-picker__select__name">{{ user.name }}</div>
          </el-option>
        </el-select>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["value", "users"],
  data() {
    return {
      showSelectInput: false,
    };
  },
  methods: {
    clear() {
        this.$emit("clear");
    },
    change(value) {
      this.$emit("input", value);
    },
    visibleChange(v) {
      this.showSelectInput = !this.showSelectInput;
      if(!this.showSelectInput){
          this.$refs.user_select.blur();
      }
    }
  }
};
</script>
