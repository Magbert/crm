require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";
import { store } from "./store";
import App from "./App.vue";

import Editor from "@/components/editor";
import TaskRow from "@/components/task/TaskRow";
import ElementUI from "element-ui";
import "element-ui/lib/theme-chalk/index.css";
import locale from "element-ui/lib/locale/lang/ru-RU";
import pagination from "laravel-vue-pagination";
import { VueContext } from "vue-context";

Vue.use(VueRouter);
Vue.use(ElementUI, { locale });

Vue.component("vue-context", VueContext);
Vue.component("pagination", pagination);
Vue.component("editor", Editor);
Vue.component("task-row", TaskRow);

const router = new VueRouter({
    routes,
    mode: "history"
});

router.beforeEach((to, from, next) => {
    // Если посетитель не авторизован и пытается получит доступ к зашишенным урлам пренаправит на форму входа
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.loggedIn) {
            next({
                name: "login"
            });
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.requiresGuest)) {
        // Если посетитель авторизован и пытается получит доступ к форме входа перенаправить на главную страницу
        if (store.getters.loggedIn) {
            next({
                name: "home"
            });
        } else {
            next();
        }
    } else {
        next();
    }
});

App.router = router;
App.store = store;
new Vue(App).$mount("#app");
