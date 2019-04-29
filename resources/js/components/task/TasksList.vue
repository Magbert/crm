<template>
    <div class="tasks-list">
        <task-row v-for="task in tasks" :task="task" :key="task.id"></task-row>
    </div>
</template>

<script>
export default {
    props: ['tasks']
};
</script>

<style lang="scss">
//
</style>