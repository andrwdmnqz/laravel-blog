<template>
    <div class="main-title">
        <h1>Posts list</h1>
    </div>
    <div class="success-message" v-if="success">
        Post deleted successfully!
    </div>
    <div class="center-div">
        <table>
            <tr>
                <th>Number</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
            <tbody>
            <tr v-for="(post, index) in posts" :key="post.id">
                <td>{{ index + 1 }}</td>
                <td>{{ post.title }}</td>
                <td>

                    <router-link :to="{name: 'EditCategories', params: {id: post.id}}" class="white-link">
                        <button class="edit-button">Edit</button>
                    </router-link>
                    <button class="delete-button" @click="destroy(post.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="link">
        <h2>
            <router-link :to="{name: 'CreateCategories'}" class="white-link">Create posts</router-link>
        </h2>
    </div>

</template>

<script>
import axios from "axios";

export default {
    emits: ['updateSidebar'],
    data() {
        return {
            posts: [],
            success: false
        }
    },
    mounted() {
        const token = localStorage.getItem('authToken');

        axios
            .get('/api/posts')
            .then((response) => {
                this.posts = response.data.data;
            })
            .catch((error) => {
                console.log(error);
            });
    }
}
</script>

<style>
.center-div {
    margin-top: 40px;
    display: flex;
    justify-content: center;
}

table {
    border-collapse: collapse;
    width: 100%;
}

table, th, td {
    border: 1px solid white;
}

th, td {
    padding: 8px;
    text-align: center;
}

th {
    background-color: black;
}

.link {
    display: flex;
    justify-content: center;
    margin: 40px 0;
}

.link h2 {
    text-decoration: underline;
}

.edit-button:hover, .delete-button:hover {
    cursor: pointer;
}
</style>
