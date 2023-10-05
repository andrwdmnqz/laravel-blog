<template>
    <div class="main-title">
        <h1>Relevant world news</h1>
    </div>
    <div class="posts">
        <div class="post-card" v-for="post in posts" :key="post.id">
            <img :src="post.image_path" alt="Post image">
            <div class="post-title-attributes">
                <h3>
                    <router-link :to="{ name: 'SingleBlog', params: { slug: post.link }}" class="white-link">
                        {{ post.title }}
                    </router-link>
                </h3>
                <div class="post-attributes">
                    <p>By {{ post.user }}</p>
                    <p>{{ post.created_at }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    emits: ['updateSidebar'],

    data() {
        return {
            posts: [],
        }
    },
    mounted() {
        const token = localStorage.getItem('authToken');

        axios
            .get('/api/home-posts')
            .then((response) => {
                this.posts = response.data.data;
            })
            .catch((error) => {
                console.log(error);
            });
    }
}
</script>
