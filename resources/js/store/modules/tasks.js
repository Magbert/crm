export default {
    state: {
        task: null,
        rootTasks: []
    },
    mutations: {
        setTask(state, task) {
            state.task = Object.assign({}, state.task, task);
        },
        setRootTasks(state, tasks) {
            state.rootTasks = tasks;
        },
        addSubTask(state, task) {
            state.task.subtasks.push(task);
        },
        addRootTasks(state, task) {
            state.rootTasks.push(task);
        },
        removeRootTask(state, index) {
            state.rootTasks.splice(index, 1);
        },
        removeSubTask(state, index) {
            state.task.subtasks.splice(index, 1);
        }
    },
    actions: {
        fetchRootTasks(context, payload) {
            axios.get(`projects/${payload.project_id}/tasks`).then(response => {
                context.commit("setRootTasks", response.data.data);
            });
        },
        fetchTask(context, ids) {
            axios
                .get(`/projects/${ids.project_id}/tasks/${ids.task_id}`)
                .then(response => {
                    context.commit("setTask", response.data.data);
                });
        },
        addRootTask(context, payload) {
            axios
                .post(`/projects/${payload.project_id}/tasks`, {
                    name: payload.task_name
                })
                .then(response => {
                    context.commit("addRootTasks", response.data.data);
                });
        },
        addSubTask(context, payload) {
            axios
                .post(`/projects/${payload.project_id}/tasks`, {
                    name: payload.task_name,
                    parent: payload.parent_id
                })
                .then(response => {
                    context.commit("addSubTask", response.data.data);
                });
        },
        updateTask({ context, commit, getters }, payload) {
            console.log(getters.task);
            return axios
                .put(`/tasks/${getters.task.id}`, {
                    name: getters.task.name,
                    description: getters.task.description
                })
                .then(respose => {
                    console.log(respose);
                });
        },
        removeSubTask(context, payload) {
            return axios.delete(`/tasks/${payload.task_id}`).then(response => {
                context.commit("removeSubTask", payload.task_index);
            });
        },
        removeRootTask(context, payload) {
            return axios.delete(`/tasks/${payload.task_id}`).then(response => {
                context.commit("removeRootTask", payload.task_index);
            });
        }
    },
    getters: {
        task: state => state.task,
        rootTasks: state => state.rootTasks
    }
};
