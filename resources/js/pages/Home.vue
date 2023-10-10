<template>
    <div class="main-title">
        <h1>Relevant news</h1>
    </div>
    <div class="posts">
        <div class="post-card" v-for="post in posts" :key="post.id">
            <router-link :to="{ name: 'SingleBlog', params: { slug: post.link }}" class="white-link">
                <img :src="post.image_path" alt="Post image">
                <div class="post-title-attributes">
                    <h3>
                        {{ post.title }}
                    </h3>
                    <div class="post-attributes">
                        <p>By {{ post.user }}</p>
                        <p>{{ post.created_at }}</p>
                    </div>
                </div>
            </router-link>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, defineEmits } from "vue";
import axios from "axios";

const emits = defineEmits(['updateSidebar']);

const posts = ref([]);

onMounted(() => {
    const token = localStorage.getItem('authToken');

    axios
        .get('/api/home-posts')
        .then((response) => {
            posts.value = response.data.data;
        })
        .catch((error) => {
            console.log(error);
        });
});
</script>
