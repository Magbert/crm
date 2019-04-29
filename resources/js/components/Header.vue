<template>
  <header class="header white-block">
    <div class="header__left">
      <slot></slot>
    </div>
    <div class="header__right"></div>
  </header>
</template>
<script>
export default {};
</script>

<style lang="scss">
.header {
  align-items: center;
  display: flex;
  flex-shrink: 0;
  padding: 0 20px;
  min-height: 65px;
  z-index: 10;
  justify-content: space-between;
  &__nav {
    display: flex;
    flex: 1 0 auto;
    a {
      color: #848f99;
      text-decoration: none;
      font-size: 13px;
      font-weight: 500;
      padding-bottom: 12px;
      transition-duration: 0.2s;
      word-wrap: break-word;
      transition-duration: 0.2s;
      &:not(:last-of-type) {
        margin-right: 20px;
      }
      &:hover {
        box-shadow: inset 0 -2px #b7bfc6;
        color: #151b26;
      }
      &.router-link-active {
        box-shadow: inset 0 -2px #14aaf5;
        color: #008ce3;
      }
    }
  }
  &__left {
    display: flex;
    flex-direction: column;
  }
  &__info {
    display: flex;
    align-items: center;
    padding-top: 5px;
    &__title {
      font-size: 20px;
      font-weight: 500;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
      max-width: 350px;
    }
    &__block-1 {
      margin-right: 15px;
    }
    &__block-2 {
      margin-left: 15px;
    }
  }
}
</style>
