<template>
    <div class="main-title">
        <h1>Manage panel</h1>
        <a href="#" @click="logout">Log out</a>
    </div>
    <div class="welcome-title">
        <h2>Hello, {{ userName }}</h2>
    </div>
    <div class="manage-actions">
        <ul>
            <li><router-link :to="{name: 'CreatePosts'}" class="white-link">Create posts</router-link></li>
            <li><router-link :to="{name: 'PostsList'}" class="white-link">Posts list</router-link></li>
            <li><router-link :to="{name: 'CreateCategories'}" class="white-link">Create categories</router-link></li>
            <li><router-link :to="{name: 'CategoriesList'}" class="white-link">Categories list</router-link></li>
            <li><router-link :to="{name: 'OfficesList'}" class="white-link">OfficesList</router-link></li>
        </ul>
    </div>
</template>

<script setup>
import { ref, defineEmits, onMounted } from "vue";
import axios from "axios";
import router from "@/router/index.js";

const userName = ref('');

const emits = defineEmits(['updateSidebar']);

onMounted(() => {
    const authToken = localStorage.getItem("authToken");

    axios
        .get('/api/user', {
            headers: {
                Authorization: `Bearer ${authToken}`,
            },
        })
        .then((response) => {
            userName.value = response.data.name;
        })
        .catch((error) => {
            if (error.response.status === 401) {
                emits('updateSidebar');
                localStorage.removeItem('authToken');
                localStorage.removeItem('authenticated');
                router.push({name: 'Login'});
            }
        });
});

const logout = () => {
    const authToken = localStorage.getItem("authToken");

    axios
        .get('/api/logout', {
            headers: {
                Authorization: `Bearer ${authToken}`,
            },
        })
        .then((response) => {
            localStorage.removeItem('authToken');
            localStorage.removeItem('authenticated');
            emits('updateSidebar');
            router.push({name: 'Home'});
        })
        .catch((error) => {
            console.log(error);
        });
};
</script>

<style>
.manage-actions {
    display: flex;
    justify-content: center;
    margin-top: 40px;
    font-size: 24px;
}

.manage-actions ul {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.manage-actions ul li {
    padding: 5px 0;
    text-decoration: underline;
}

.manage-actions ul li:hover {
    cursor: pointer;
}

.welcome-title {
    display: flex;
    justify-content: center;
    margin: 20px 0;
}

.main-title a {
    position: absolute;
    font-size: 24px;
    color: white;
    right: 2%;
    top: 0;
}
</style>
