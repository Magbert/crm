import axios from "axios";
import { route } from "@/helpers";
import _ from "lodash";

let API = {
    // tasks
    fetchTasks: (project_id) => axios.get(route('tasks.index', project_id) ),
    fetchTask: (task_id) =>  axios.get(route('tasks.show', task_id) ),
    addTask: (project_id, data) => axios.post(route('tasks.store', project_id ), data),
    updateTask: (task_id, data) => axios.put(route('tasks.update', task_id), data),
    removeTask: (task_id) => axios.delete(route('tasks.destroy', task_id)),
    updateTasksOrder: (project_id, reordered_tasks) => axios.put(route('tasks.rebuild', project_id), reordered_tasks),
    updateTaskDebounce: _.debounce((task_id, data) => API.updateTask(task_id, data), 500),
    // assignee
    setAssignee: (task_id, data) => axios.post(route('tasks.assignee.assign', task_id), data),
    removeAssignee: (task_id) => axios.delete(route('tasks.assignee.remove', task_id)),
    // status
    fetchTaskStatuses: () => axios.get(route('tasks.statuses.index')),
    setStatus: (task_id, data) => axios.post(route('tasks.statuses.set', task_id), data),

    // projects
    fetchProject: (project_id) => axios.get(route('projects.show', project_id)),
    fetchProjectsPaginate: (page) => axios.get(`${api_url}/projects?page=${page}`),
    updateProject: (project_id, data) => axios.put(route('projects.update', project_id), data),
    removeProject: (project_id) => axios.delete(route('projects.destroy', project_id)),
    createProject: (data) => axios.post(route("projects.store"), data),

    // customers
    fetchCustomersPaginate: (page) => axios.get(`${api_url}/customers?page=${page}`),
    fetchCustomer: (customer_id) => axios.get(route('customers.show', customer_id)),
    addCustomer: (data) => axios.post(route("customers.store"), data),
    updateCustomer: (customer_id, data) => axios.put(route('customers.update', customer_id), data),
    removeCustomer: (customer_id) => axios.delete(route('customers.destroy', customer_id)),

    // users
    fetchUsersPaginate: (page) => axios.get(`${api_url}/users?page=${page}`),
    fetchUsers: () => axios.get(route("users.index")),
    fetchUser: (user_id) => axios.get(route("users.show", user_id)),
    addUser: (data) => axios.post(route("users.store"), data),

    // auth
    logout: () => axios.post(`${api_url}/logout`),
    login: (credentials) => axios.post(`${api_url}/login`, credentials),
};

export default API;
