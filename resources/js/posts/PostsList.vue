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

                    <router-link :to="{name: 'EditPosts', params: {slug: post.link}}" class="white-link">
                        <button class="edit-button">Edit</button>
                    </router-link>
                    <button class="delete-button" @click="destroy(post.link)">Delete</button>
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

<script setup>
import { ref, defineEmits, onMounted } from "vue";
import axios from "axios";

const emits = defineEmits(['updateSidebar']);

const posts = ref([]);
const success = ref(false);

const destroy = (slug) => {
    const token = localStorage.getItem('authToken');

    axios
        .delete(`/api/posts/${slug}`, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        })
        .then(() => {
            updateList();
            success.value = true;

            setInterval(() => {
                success.value = false;
            }, 2000);
        })
        .catch((error) => {
            console.log(error);
        });
};

const updateList = () => {
    const token = localStorage.getItem('authToken');

    axios
        .get('/api/manage-posts', {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        })
        .then((response) => {
            posts.value = response.data.data;
        })
        .catch((error) => {
            console.log(error);
        });
};

onMounted(() => {
    updateList();
});
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
