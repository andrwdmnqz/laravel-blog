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
        <div class="post-content">
            <p>{{ post.text }}</p>
        </div>
    </div>

    <div class="related">
        <h2>Related posts</h2>
        <div class="related-posts">
            <div class="related-post-card" v-for="relatedPost in relatedPosts" :key="relatedPost.id">
                <router-link :to="{ name: 'SingleBlog', params: { slug: relatedPost.link }}" class="white-link">
                    <img :src="`/${relatedPost.image_path}`">
                    <p>{{ relatedPost.title }}</p>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, defineEmits, defineProps } from "vue";
import axios from "axios";

const emits = defineEmits(['updateSidebar']);

const { slug } = defineProps(['slug']);

const post = ref({});
const relatedPosts = ref([]);

onMounted(() => {
    axios
        .get(`/api/posts/${slug}`)
        .then((response) => {
            post.value = response.data.data;
        })
        .catch((error) => {
            console.log(error);
        });

    axios
        .get('/api/related-posts/' + slug)
        .then((response) => {
            relatedPosts.value = response.data.data;
        })
        .catch((error) => {
            console.log(error);
        });
});
</script>

<style>
.post-data {
    max-width: 650px;
    margin: 40px auto;
    align-items: center;
    font-size: 24px;
    background-color: #a22e2e;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0px 15px 15px black;
}

.about-content p {
    font-weight: 300;
    font-size: 20px;
}

.post-image img {
    width: 100%;
    border-radius: 10px;
}

.post-content {
    margin-top: 20px;
    font-weight: 300;
    font-size: 20px;
}

.related h2 {
    padding-left: 2%;
}

.related-posts {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    margin: 20px 0;
}

.related-post-card {
    max-width: 340px;
    background-color: #a22e2e;
    padding: 10px;
    border-radius: 20px;
    box-shadow: 0px 15px 15px black;
    margin-bottom: 20px;
}

.related-post-card img {
    width: 100%;
    border-radius: 10px;
}

@media screen and (max-width: 768px) {
    .related-post-card {
        width: 100%;
    }
}
</style>
<script setup>
</script>
