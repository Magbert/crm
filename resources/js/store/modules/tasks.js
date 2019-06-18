import { findDeep, removeDeep } from "../../helpers";

const updateTask = _.debounce(function(payload) {
    return axios.put(`tasks/${payload.task_id}`, payload);
}, 500);

export default {
    state: {
        task: null,
        tasks: []
    },
    mutations: {
        resetTask: state => (state.task = null),
        setTask(state, task) {
            state.task = Object.assign({}, state.task, task);
        },
        setTasks: (state, tasks) => (state.tasks = tasks),

        updateTask(state, payload) {
            state.task = Object.assign({}, state.task, payload);
        },

        updateTaskInTree(state, payload) {
            let task = findDeep(state.tasks, payload.task_id);
            for (let prop in payload) {
                if (task[prop]) {
                    task[prop] = payload[prop];
                }
            }
        },

        /**
         *
         * @param {*} state
         * @param {parent_id, tasks} payload
         * Обновление сортировки задач
         */
        updateTasksOrder(state, payload) {
            if (payload.parent_id) {
                //Если перемешены подзадачи
                let task = findDeep(state.tasks, payload.parent_id);
                task.children = payload.tasks;
            } else {
                //Если перемешены рутовые задачи
                state.tasks = payload.tasks;
            }
        },

        addSubTask(state, task) {
            let parent = findDeep(state.tasks, task.parent_id);
            parent.children.push(task);
        },
        addRootTask(state, task) {
            state.tasks.push(task);
        },
        removeTask(state, id) {
            removeDeep(state.tasks, id);
        }
    },
    actions: {
        updateTasksOrder(context, payload) {
            context.commit("updateTasksOrder", payload.tasks);
            axios
                .put(`tasks/tree/${payload.project_id}`, {
                    tree: context.state.tasks
                })
                .then(response => {});
        },

        fetchTasks(context, payload) {
            axios.get(`tasks/tree/${payload.project_id}`).then(response => {
                context.commit("setTasks", response.data.data);
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
                    context.commit("addRootTask", response.data.data);
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

        updateTask(context, payload) {
            if (context.getters.task.id == payload.task_id) {
                context.commit("updateTask", payload);
            }
            context.commit("updateTaskInTree", payload);
            updateTask(payload);
        },

        removeTask(context, payload) {
            return axios.delete(`/tasks/${payload.task_id}`).then(response => {
                context.commit("removeTask", payload.task_id);
            });
        },

        setDueTime(state, payload) {
            axios.put(`tasks/${payload.task_id}`, payload.data);
        }
    },
    getters: {
        task: state => state.task,
        tasks: state => state.tasks
    }
};
