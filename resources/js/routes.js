import Home from "./pages/Home";
import Projects from "./pages/project/Projects";
import Project from "./pages/project/Project";
import Tasks from "./pages/project/Tasks";
import Task from "./pages/task/Task";
import TasksTree from "./pages/task/TasksTree";
// import TasksTree2 from "./pages/task/TasksTree2";
import Info from "./pages/project/Info";
import Login from "./pages/auth/Login";
import Logout from "./pages/auth/Logout";

import ProjectHeader from "./components/project/ProjectHeader";
import ProjectsHeader from "./components/project/ProjectsHeader";
import TaskComp from "./components/task/Task";

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
        // component: Projects,
        name: "projects",
        components: {
            default: Projects,
            header: ProjectsHeader
        }
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
                path: "tree",
                component: TasksTree,
                name: "tree",
                children: [
                    {
                        path: ":task_id",
                        component: TaskComp,
                        name: "tree-task"
                    }
                ]
                //TaskComp
            },
            {
                path: "info",
                component: Info,
                name: "project.info"
            },
            {
                path: "task/:task_id",
                component: Task,
                name: "task"
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
