import Vue from "vue";
import Vuex from "vuex";
import auth from "./modules/auth";
import project from "./modules/project";
import user from "./modules/user";

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        test: "test asdasd"
    },
    getters: {},
    mutations: {},
    actions: {},
    modules: {
        auth: auth,
        project: project,
        user: user
    }
});
