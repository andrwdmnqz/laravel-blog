<template>
    <div class="main-title">
        <h1>Categories list</h1>
    </div>
    <div class="center-div">
        <table>
            <tr>
                <th>Number</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            <tbody>
                <tr v-for="(category, index) in categories" :key="category.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ category.name }}</td>
                    <td>
                        <button class="edit-button">Edit</button>
                        <button class="delete-button">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="link">
        <h2>
            <router-link :to="{name: 'CreateCategories'}">Create categories</router-link>
        </h2>
    </div>

</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            categories: [],
        }
    },
    mounted() {
        const authToken = localStorage.getItem("authToken");

        axios
            .get('/api/categories', {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                },
            })
            .then((response) => {
                this.categories = response.data;
            })
            .catch((error) => {
                console.log(error);
            });
    },
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
    margin-top: 40px;
}

.link h2 {
    text-decoration: underline;
}
</style>
<script setup>
</script>
