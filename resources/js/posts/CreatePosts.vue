<template>
    <div class="main-title">
        <h1>Create post</h1>
    </div>
    <div class="success-message" v-if="success">
        Post created successfully!
    </div>
    <div class="center-form">
        <div class="category-form">
            <form @submit.prevent="submit">
                <div class="form-group">
                    <div class="form-block">
                        <label for="name">Title</label><br>
                        <input type="text" id="name" v-model="fields.name">
                        <span v-if="errors.name">{{ errors.name[0] }}</span>
                    </div>

                    <div class="form-block">
                        <label for="image">Image</label><br>
                        <input type="file" id="image" class="image">
                    </div>
                    <div class="form-block">
                        <label for="category">Category</label><br>
                        <select id="category">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </select>
                    </div>
                    <div class="form-block">
                        <label for="body">Post text</label><br>
                        <textarea id="body" v-model="fields.body"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="submit-button">Create</button>
                </div>
            </form>
        </div>
    </div>
    <div class="link">
        <h2><router-link :to="{name: 'CategoriesList'}">Posts list</router-link></h2>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            fields: {},
            errors: {},
            success: false
        };
    },
    methods: {
        submit() {
            const token = localStorage.getItem('authToken');

            axios
                .post('/api/categories/create', this.field, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    }
                })
                .then(() => {
                    this.field = {};
                    this.errors = {};
                    this.success = true;

                    setInterval(() => {
                        this.success = false;
                    }, 2000);
                }).catch((error) => {
                this.errors = error.response.data.errors;
            });
        }
    }
}
</script>

<style>
.center-form {
    width: 100%;
    display: flex;
    justify-content: center;
}

.category-form {
    width: 100%;
    max-width: 400px;
    margin-top: 40px;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
}

.category-form form {
    width: 100%;
}

.form-group {
    margin-bottom: 20px;
}

.submit-button {
    margin-top: 25px;
    color: white;
    background-color: black;
    padding: 10px 20px;
    font-size: 20px;
    border-radius: 15px;
    border: none;
}

.form-block {
    margin-bottom: 20px;
}

.form-block * {
    width: 100%;
}

.form-block select, input {
    height: 30px;
    font-size: 18px;
}

.form-block input {
    padding-left: 1px;
}

.form-block select {
    margin: 2px 0;
}

.form-block textarea {
    width: 100%;
    min-height: 100px; /* Задайте бажану мінімальну висоту тут */
    min-width: 100%;
    max-width: 100%;
    max-height: 30%;
    padding-left: 1px;
    font-size: 18px;
}

.form-group:last-child {
    margin-bottom: 0px;
}

.submit-button:hover {
    cursor: pointer;
}
</style>
