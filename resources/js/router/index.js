import { createRouter, createWebHistory } from "vue-router";

import About from '../pages/About.vue';
import Blog from '../pages/Blog.vue';
import Home from '../pages/Home.vue';
import SingleBlog from '../pages/SingleBlog.vue';

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
        name: "Home",
        component: Home,
    },
    {
        path: "/blog/:slug",
        name: "SingleBlog",
        component: SingleBlog,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
