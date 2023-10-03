<template>
    <div class="main-title">
        <h1>Create category</h1>
    </div>
    <div class="success-message" v-if="success">
        <i class="fa fa-check"></i>
        Category created successfully!
    </div>
    <div class="center-form">
        <div class="category-form">
            <form @submit.prevent="submit">
                <div class="form-group">
                    <label for="name">Name</label><br>
                    <input type="text" id="name" class="input-field" v-model="field.name">
                    <span v-if="errors.name">{{ errors.name[0] }}</span>
                </div>
                <div class="form-group">
                    <button type="submit" class="submit-button">Create</button>
                </div>
            </form>
        </div>
    </div>
    <div class="link">
        <h2><router-link :to="{name: 'CategoriesList'}">Categories list</router-link></h2>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            field: {},
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

.input-field {
    width: 100%;
}

.submit-button:hover {
    cursor: pointer;
}
</style>
