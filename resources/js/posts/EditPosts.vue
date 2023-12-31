<template>
    <div class="main-title">
        <h1>Edit post</h1>
    </div>
    <div class="success-message" v-if="success">
        Post edited successfully!
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
                            <option :value="category.id" v-for="category in categories" :key="category.id">
                                {{ category.name }}
                            </option>
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
                    <button type="submit" class="submit-button">Update</button>
                </div>
            </form>
        </div>
    </div>
    <div class="link">
        <h2>
            <router-link :to="{name: 'PostsList'}" class="white-link">Posts list</router-link>
        </h2>
    </div>
</template>

<script setup>
import { ref, onMounted, defineProps, defineEmits } from "vue";
import axios from "axios";
import router from "@/router/index.js";

const emits = defineEmits(['updateSidebar']);
const { slug } = defineProps(['slug']);

const fields = ref({
    category_id: "",
    title: "",
    text: "",
    file: null
});
const errors = ref({});
const success = ref(false);
const url = ref("");
const categories = ref([]);

const submit = () => {
    const token = localStorage.getItem('authToken');

    const fd = new FormData();
    fd.append('title', fields.value.title);
    fd.append('category_id', fields.value.category_id);
    fd.append('text', fields.value.text);

    if (fields.value.file) {
        fd.append('file', fields.value.file);
    }

    fd.append('_method', 'PUT');

    axios
        .post(`/api/posts/${slug}`, fd, {
            headers: {
                Authorization: `Bearer ${token}`,
                "content-type": "multipart/form-data",
            }
        })
        .then(() => {

            getPostData();

            success.value = true;

            setInterval(() => {
                success.value = false;
            }, 2000);
        }).catch((error) => {
            console.log(error);
            errors.value = error.response.data.errors;
            success.value = false;
            if (error.response.status === 403) {
                router.push({name: 'PostsList'});
            }
    });
};

const getPostData = () => {
    const token = localStorage.getItem('authToken');

    axios
        .get(`/api/posts/show-post/${slug}`, {
            headers: {
                Authorization: `Bearer ${token}`,
            }
        })
        .then((response) => {
            fields.value = response.data.data;
            url.value = "/" + response.data.data.image_path;
        })
        .catch((error) => {
            if (error.response.status === 403) {
                router.push({name: 'PostsList'});
            }
        });

    const authToken = localStorage.getItem("authToken");

    axios
        .get('/api/categories', {
            headers: {
                Authorization: `Bearer ${authToken}`,
            },
        })
        .then((response) => {
            categories.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
};

const getFile = (f) => {
    const uploadedFile = f.target.files[0];
    fields.value.file = uploadedFile;
    url.value = URL.createObjectURL(uploadedFile);
    URL.revokeObjectURL(uploadedFile);
};

onMounted(() => {
    getPostData();
});
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
