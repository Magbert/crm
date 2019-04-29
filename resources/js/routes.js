import Home from "./pages/Home";
import Projects from "./pages/project/Projects";
import Project from "./pages/project/Project";
import Tasks from "./pages/project/Tasks";
import Info from "./pages/project/Info";
import Login from "./pages/auth/Login";
import Logout from "./pages/auth/Logout";

import ProjectHeader from "./components/project/ProjectHeader";

const routes = [
    {
        path: "/",
        component: Home,
        name: "home",
        meta: {
            requiresAuth: true
        }
    },
    {
        path: "/projects",
        component: Projects,
        name: "projects"
    },
    {
        path: "/project/:id",
        redirect: { name: "project.tasks" },
        components: {
            default: Project,
            header: ProjectHeader
        },
        children: [
            {
                path: "tasks",
                component: Tasks,
                name: "project.tasks"
            },
            {
                path: "info",
                component: Info,
                name: "project.info"
            }
        ]
    },
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: {
            requiresGuest: true
        }
    },
    {
        path: "/logout",
        name: "logout",
        component: Logout
    }
];

export default routes;
