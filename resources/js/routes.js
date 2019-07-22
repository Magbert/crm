import Home from "./pages/Home";
import Projects from "./pages/project/Projects";
import Project from "./pages/project/Project";
import Task from "./pages/task/Task";
import TasksTree from "./pages/task/TasksTree";
import Info from "./pages/project/Info";
//Users
import Users from "./pages/user/Users";
import User from "./pages/user/User";
//Customers
import Customers from "./pages/customer/Customers";
import Customer from "./pages/customer/Customer";
//Auth
import Login from "./pages/auth/Login";
import Logout from "./pages/auth/Logout";


import Test from "./pages/Test";

const routes = [
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
    },
    //================================
    {
        path: "/test",
        name: "test",
        component: Test,
    },
    //==================================== Сотрудники
    {
        path: "/users",
        name: "users",
        component: Users
    },
    {
        path: "/user/:user_id",
        name: "user",
        component: User
    },

    //==================================== Клиенты
    {
        path: "/customers",
        name: "customers",
        component: Customers
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
        component: Projects
    },
    {
        path: "/:project_id",
        redirect: { name: "tasks" },
        component: Project,
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
    
];

export default routes;
