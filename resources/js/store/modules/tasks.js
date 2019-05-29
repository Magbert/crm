export default {
    state: {
        task: null,
        rootTasks: [],
        tasksTree: []
    },
    mutations: {
        setTask(state, task) {
            state.task = Object.assign({}, state.task, task);
        },
        setRootTasks(state, tasks) {
            state.rootTasks = tasks;
        },
        setTasksTree(state, tasks) {
            state.tasksTree = tasks;
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
            axios.get(`tasks/root/${payload.project_id}`).then(response => {
                context.commit("setRootTasks", response.data.data);
            });
        },

        fetchTasksTree(context, payload) {
            axios.get(`tasks/tree/${payload.project_id}`).then(response => {
                context.commit("setTasksTree", response.data.data);
            });
        },

        fetchTask(context, payload) {
            axios.get(`/tasks/${payload.task_id}`).then(response => {
                context.commit("setTask", response.data.data);
            });
        },

        addRootTask(context, payload) {
            axios
                .post(`/tasks/${payload.project_id}`, {
                    name: payload.task_name
                })
                .then(response => {
                    context.commit("addRootTasks", response.data.data);
                });
        },

        addSubTask(context, payload) {
            axios
                .post(`/tasks/${payload.project_id}`, {
                    name: payload.task_name,
                    parent: payload.parent_id
                })
                .then(response => {
                    context.commit("addSubTask", response.data.data);
                });
        },

        updateTask({ getters }) {
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
        rootTasks: state => state.rootTasks,
        tasksTree: state => state.tasksTree
    }
};
