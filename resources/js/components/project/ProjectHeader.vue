<template>
  <div class="project-header" v-if="project">
    <div class="header__info">
      <span class="header__info__block-1">ID: {{ project.id }}</span>
      <div class="header__info__title" :title="project.name">
        {{ project.name }}
        <span class="header__info__items-count"></span>
      </div>
      <span class="header__info__block-2" v-if="project.user">
        Сотрудник:
        <router-link to="#">{{ project.user.name }}</router-link>
      </span>
    </div>
    <div class="header__nav">
      <router-link :to="{name: 'project.tasks', params: { id: project.id }}">Задачи</router-link>
      <router-link :to="{name: 'project.info', params: { id: project.id }}">Проект</router-link>
    </div>
  </div>
</template>
<script>
export default {
  computed: {
    project() {
      return this.$store.getters.project;
    }
  }
};
</script>

<style lang="scss">
</style>
