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
                        <label for="title">Title</label><br>
                        <input type="text" id="title" v-model="fields.title">
                        <span v-if="errors.title">{{ errors.title[0] }}</span>
                    </div>

                    <div class="form-block">
                        <label for="image">Image</label><br>
                        <input type="file" id="image" class="image" @input="getFile" ref="fileInput">
                        <span v-if="errors.file">{{ errors.file[0] }}</span>
                    </div>
                    <div class="preview">
                        <img :src="url" alt=""/>
                    </div>

                    <div class="form-block">
                        <label for="category">Category</label><br>
                        <select v-model="fields.category_id" id="category">
                            <option disabled value="">Select category</option>
                            <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.name }}</option>
                        </select>
                        <span v-if="errors.category_id">{{ errors.category_id[0] }}</span>
                    </div>
                    <div class="form-block">
                        <label for="body">Post text</label><br>
                        <textarea id="body" v-model="fields.text"></textarea>
                        <span v-if="errors.text">{{ errors.text[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="submit-button">Create</button>
                </div>
            </form>
        </div>
    </div>
    <div class="link">
        <h2>
            <router-link :to="{name: 'CategoriesList'}">Posts list</router-link>
        </h2>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            fields: {
                category_id: "",
            },
            errors: {},
            success: false,
            url: "",
            categories: []
        };
    },
    methods: {
        submit() {
            const token = localStorage.getItem('authToken');

            console.log(this.fields);

            axios
                .post('/api/posts', this.fields, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                        "content-type": "multipart/form-data",
                    }
                })
                .then(() => {
                    this.fields = {};
                    this.fields.category_id = "";
                    this.errors = {};
                    this.url = null;
                    this.$refs.fileInput.value = null;

                    this.success = true;

                    setInterval(() => {
                        this.success = false;
                    }, 2000);
                }).catch((error) => {
                this.errors = error.response.data.errors;
                this.success = false;
            });
        },

        getFile(f) {
            const uploadedFile = f.target.files[0];
            this.fields.file = uploadedFile;
            this.url = URL.createObjectURL(uploadedFile);
            URL.revokeObjectURL(uploadedFile);
        }
    },
    mounted() {
        this.fields = {};
        this.fields.category_id = "";
        this.errors = {};
        this.success = false;

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
    min-height: 100px;
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

.preview img {
    max-width: 100%;
    max-height: 150px;
}

</style>
