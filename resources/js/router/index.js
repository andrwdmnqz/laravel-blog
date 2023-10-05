import {createRouter, createWebHistory} from "vue-router";

import About from '../pages/About.vue';
import Blog from '../pages/Blog.vue';
import Home from '../pages/Home.vue';
import SingleBlog from '../pages/SingleBlog.vue';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
import Manage from "../pages/Manage.vue";
import CreateCategories from "../categories/CreateCategories.vue";
import CategoriesList from "../categories/CategoriesList.vue";
import EditCategories from "../categories/EditCategories.vue";
import CreatePosts from "../posts/CreatePosts.vue";
import PostsList from "../posts/PostsList.vue";

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
        props: true
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
        meta: {requiresGuest: true}

    },
    {
        path: "/register",
        name: "Register",
        component: Register,
        meta: {requiresGuest: true}
    },
    {
        path: "/manage",
        name: "Manage",
        component: Manage,
        meta: {requiresAuth: true}
    },
    {
        path: "/categories/create",
        name: "CreateCategories",
        component: CreateCategories,
        meta: {requiresAuth: true}
    },
    {
        path: "/categories",
        name: "CategoriesList",
        component: CategoriesList,
        meta: {requiresAuth: true}
    },
    {
        path: "/categories/:id/edit",
        name: "EditCategories",
        component: EditCategories,
        meta: {requiresAuth: true},
        props: true
    },
    {
        path: "/posts/create",
        name: "CreatePosts",
        component: CreatePosts,
        meta: {requiresAuth: true}
    },
    {
        path: "/manage-posts",
        name: "PostsList",
        component: PostsList,
        meta: {requiresAuth: true}
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from) => {
    const authenticated = localStorage.getItem('authenticated');

    if (to.meta.requiresGuest && authenticated) {
        return {
            name: 'Manage',
        };
    } else if (to.meta.requiresAuth && !authenticated) {
        return {
            name: 'Login'
        };
    }
});

export default router;
