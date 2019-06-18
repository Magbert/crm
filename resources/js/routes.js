import Home from "./pages/Home";
import Projects from "./pages/project/Projects";
import Project from "./pages/project/Project";
import Task from "./pages/task/Task";
import TasksTree from "./pages/task/TasksTree";
import Info from "./pages/project/Info";

//Auth
import Login from "./pages/auth/Login";
import Logout from "./pages/auth/Logout";

import ProjectHeader from "./components/project/ProjectHeader";
import ProjectsHeader from "./components/project/ProjectsHeader";

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
        name: "projects",
        components: {
            default: Projects,
            header: ProjectsHeader
        }
    },
    {
        path: "/:id",
        redirect: { name: "tasks" },
        components: {
            default: Project,
            header: ProjectHeader
        },
        children: [
            {
                path: "/",
                component: TasksTree,
                name: "tasks",
                children: [
                    {
                        path: ":task_id",
                        component: Task,
                        name: "task"
                    }
                ]
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
