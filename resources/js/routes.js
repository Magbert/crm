import Home from "./pages/Home";
import Projects from "./pages/project/Projects";
import Project from "./pages/project/Project";
import Task from "./pages/task/Task";
import TasksTree from "./pages/task/TasksTree";
import Info from "./pages/project/Info";
//Usrs
import Users from "./pages/user/Users";
import User from "./pages/user/User";
//Customers
import Customers from "./pages/customer/Customers";
import Customer from "./pages/customer/Customer";
//Auth
import Login from "./pages/auth/Login";
import Logout from "./pages/auth/Logout";

import ProjectHeader from "./components/project/ProjectHeader";
import ProjectsHeader from "./components/project/ProjectsHeader";
import CustomersHeader from "./components/customer/CustomersHeader";
import UsersHeader from "./components/user/UsersHeader";
import UserHeader from "./components/user/UserHeader";

const routes = [
    //==================================== Сотрудники
    {
        path: "/users",
        name: "users",
        components: {
            default: Users,
            header: UsersHeader
        }
    },
    {
        path: "/user/:user_id",
        name: "user",
        components: {
            default: User,
            header: UserHeader
        }
    },

    //==================================== Клиенты
    {
        path: "/customers",
        name: "customers",
        components: {
            default: Customers,
            header: CustomersHeader
        }
    },
    {
        path: "/customer/:customer_id",
        name: "customer",
        component: Customer
    },
    //==============================
    {
        path: "/",
        component: Home,
        name: "home",
        meta: {
            requiresAuth: true
        }
    },
    //==================================== Проекты
    {
        path: "/projects",
        name: "projects",
        components: {
            default: Projects,
            header: ProjectsHeader
        }
    },
    {
        path: "/:project_id",
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

    //==================================== Auth
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
