<template>
    <div class="main-title">
        <h1>All blog posts</h1>
    </div>
    <div class="searchbar">
        <input type="text" placeholder="Enter keyword" class="search-input">
        <button class="search-button">Search</button>
    </div>
    <div class="tags">
        <div class="tag">
            <span>#Health</span>
        </div>
        <div class="tag">
            <span>#Sport</span>
        </div>
        <div class="tag">
            <span>#Music</span>
        </div>
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

        <div class="pagination">
            <ul>
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
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
            .get('/api/posts')
            .then((response) => {
                this.posts = response.data.data;
                console.log(this.posts);
            })
            .catch((error) => {
                console.log(error);
            });
    }
}
</script>

<style>

.searchbar {
    margin: 25px 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-input {
    width: 250px;
    height: 32px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
    font-size: 18px;
}

.search-button {
    background-color: #a22e2e;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    transition-duration: 0.5s;
}

.search-button:hover {
    background-color: #1a1e24;
}

.tags {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 40px;
    flex-wrap: wrap;
}

.tag {
    background-color: #a22e2e;
    padding: 12px 30px;
    border-radius: 15px;
}

.pagination {
    text-align: center;
    margin-top: 20px;
}

.pagination ul {
    list-style: none;
    padding: 0;
    display: inline-block;
}

.pagination li {
    display: inline;
    margin-right: 10px;
}

.pagination a {
    text-decoration: none;
    background-color: #a22e2e;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
}

.pagination a:hover {
    background-color: #1a1e24;
}

@media screen and (max-width: 576px) {
    .search-input {
        width: 180px;
    }

    .tag {
        padding: 8px 24px;
        font-size: 16px;
    }
}
</style>
