import { findDeep, removeDeep, route } from "@/helpers";
import API from "@/API";

export default {
    state: {
        task: null,
        tasks: []
    },
    mutations: {
        resetTask: state => (state.task = null),
        setTask: (state, task) => (state.task = Object.assign({}, state.task, task)),
        setTasks: (state, tasks) => (state.tasks = tasks),
        setStatus: (state, status) => (state.task.status = status),
        setAssignee: (state, assignee) => (state.task.assignee = assignee),
        removeAssignee: (state ) => (state.task.assignee = null),
        updateTask: (state, payload) => (state.task = Object.assign({}, state.task, payload)),
        updateTaskInTree(state, payload) {
            let task = findDeep(state.tasks, payload.task_id);
            for (let prop in payload) {
                if (_.has(task, prop)) {
                    task[prop] = payload[prop];
                }
            }
        },
        /**
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
        addSubTask: (state, task) => {
            let parent = findDeep(state.tasks, task.parent_id);
            parent.children.push(task);
        },
        addRootTask: (state, task) => state.tasks.push(task),
        removeTask: (state, id) => removeDeep(state.tasks, id)
    },
    actions: {
        updateTasksOrder(context, payload) {
            context.commit("updateTasksOrder", payload.tasks);
            API.updateTasksOrder(payload.project_id, { tree: context.state.tasks })
        },

        fetchTasks(context, payload) {
            API.fetchTasks(payload.project_id)
            .then(response => context.commit("setTasks", response.data.data));
        },

        fetchTask(context, task_id) {
            API.fetchTask(task_id)
            .then(response => context.commit("setTask", response.data.data));
        },

        addRootTask(context, payload) {
            API.addTask(payload.project_id, { name: payload.task_name })
            .then(response => context.commit("addRootTask", response.data.data));
        },

        addSubTask(context, payload) {
            API.addTask(payload.project_id, {
                parent: payload.parent_id,
                name: payload.task_name
            })
            .then(response => context.commit("addSubTask", response.data.data));
        },

        updateTask(context, payload) {
             API.updateTaskDebounce(payload.task_id, payload);
            if (context.getters.task.id == payload.task_id) {
                context.commit("updateTask", payload);
            }
            context.commit("updateTaskInTree", payload);
        },

        removeTask(context, payload) {
            API.removeTask(payload.task_id)
            .then(() => context.commit("removeTask", payload.task_id));
        },

        setAssignee(context, payload) {
            API.setAssignee(payload.task_id, { 'user_id' : payload.assignee.id });
            context.commit("setAssignee", payload.assignee);
            context.commit("updateTaskInTree", payload);
        },

        removeAssignee(context, payload) {
            API.removeAssignee(payload.task_id);
            context.commit("removeAssignee");
            context.commit("updateTaskInTree", { assignee: null, task_id: payload.task_id });
        },

        setStatus(context, payload) {
            console.log(payload);
            API.setStatus(payload.task_id, { 'status_id' : payload.status.id });
            context.commit("setStatus", payload.status);
            context.commit("updateTaskInTree", payload);
        },
    },
    getters: {
        task: state => state.task,
        tasks: state => state.tasks
    }
};
