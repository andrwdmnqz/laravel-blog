<template>
    <div class="main-title">
        <h1>{{ post.title }}</h1>
    </div>
    <div class="post-data">
        <div class="post-image">
            <img :src="`/${post.image_path}`" alt="Post image">
        </div>
        <div class="post-attributes">
            <p>By {{ post.user }}</p>
            <p>{{ post.created_at }}</p>
        </div>
        <div class="about-content">
            <p>{{ post.text }}</p>
        </div>
    </div>

    <div class="related">
        <h2>Related posts</h2>
        <div class="related-posts">
            <div class="related-post-card">
                <img src="/storage/music-listening.jpg">
                <p>Post name</p>
            </div>
            <div class="related-post-card">
                <img src="/storage/music-listening.jpg">
                <p>Post name</p>
            </div>
            <div class="related-post-card">
                <img src="/storage/music-listening.jpg">
                <p>Post name</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: ['slug'],
    data() {
        return {
            post: {},
        }
    },
    mounted() {
        axios
            .get('/api/posts/' + this.slug)
            .then((response) => {
                this.post = response.data.data;
            })
            .catch((error) => {
                console.log(error);
            });
    }
}
</script>

<style>
.post-data {
    max-width: 600px;
    margin: 40px auto;
    align-items: center;
    font-size: 24px;
}

.about-content p {
    font-weight: 300;
    font-size: 20px;
}

.post-image img {
    width: 600px;
}

.related-posts {
    display: flex;
    justify-content: space-between;
    margin: 20px 0;
}

.related-post-card {
    background-color: #a22e2e;
    width: 350px;
    min-height: 300px;
    height: auto;
    padding: 10px;
    box-shadow: 0px 15px 15px black;
    border-radius: 5%;
    margin-bottom: 20px;
}

.related-post-card img {
    width: 100%;
    border-radius: 5%;
}
</style>
<script setup>
</script>
