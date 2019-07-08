import Vue from "vue";
import Vuex from "vuex";
import header from "./modules/header";
import auth from "./modules/auth";
import project from "./modules/project";
import tasks from "./modules/tasks";
import user from "./modules/user";

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        mainClass: ""
    },
    getters: {
        mainclass: state => state.mainClass
    },
    mutations: {
        setMainClass(state, mainClass) {
            state.mainClass = mainClass;
        }
    },
    actions: {},
    modules: {
        header: header,
        auth: auth,
        project: project,
        user: user,
        tasks: tasks
    }
});
