import { createRouter, createWebHistory } from "vue-router";

import About from '../pages/About.vue';
import Blog from '../pages/Blog.vue';
import Home from '../pages/Home.vue';
import SingleBlog from '../pages/SingleBlog.vue';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
import Manage from "../pages/Manage.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/about",
        name: "About",
        component: About,
    },
    {
        path: "/blog",
        name: "Blog",
        component: Blog,
    },
    {
        path: "/blog/:slug",
        name: "SingleBlog",
        component: SingleBlog,
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
    },
    {
        path: "/manage",
        name: "Manage",
        component: Manage,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
