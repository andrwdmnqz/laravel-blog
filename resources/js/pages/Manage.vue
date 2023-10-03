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
            <li>Create post</li>
            <li>Post list</li>
            <li><router-link :to="{name: 'CreateCategories'}">Create categories</router-link></li>
            <li><router-link :to="{name: 'CategoriesList'}">Categories list</router-link></li>
        </ul>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            userName: '',
        }
    },
    mounted() {
        const authToken = localStorage.getItem("authToken");

        axios
            .get('/api/user', {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                },
            })
            .then((response) => {
                console.log(response);
                this.userName = response.data.name;
            })
            .catch((error) => {
                if (error.response.status === 401) {
                    this.$emit('updateSidebar');
                    localStorage.removeItem('authToken');
                    localStorage.removeItem('authenticated');
                    this.$router.push({name: 'Login'});
                }
            });
    },
    methods: {
        logout() {
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
                    this.$emit('updateSidebar');
                    this.$router.push({name: 'Home'});
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }
}
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
    right: 0;
    top: 0;
}
</style>
