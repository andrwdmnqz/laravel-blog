<template>
    <div class="main-title">
        <h1>All blog posts</h1>
    </div>
    <div class="searchbar">
        <input type="text" placeholder="Enter keyword" class="search-input" v-model="title">
        <button class="search-button">Search</button>
    </div>
    <div class="tags">
        <div class="tag" v-for="category in categories" :key="category.id">
            <a href="#" @click="filterByCategory(category.name)"><span>#{{ category.name }}</span></a>
        </div>
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

    <div class="main-title no-matches" v-if="!posts.length">
        <h1>No matches found</h1>
    </div>

    <div class="pagination">
        <a href="#" v-for="(link, index) in links" :key="index" v-html="link.label"
           :class="{active: link.active, disabled: !link.url }" @click="changePage(link)"></a>
    </div>
</template>

<script>
import axios from "axios";

export default {
    emits: ['updateSidebar'],
    data() {
        return {
            posts: [],
            categories: [],
            title: '',
            links: [],
        }
    },
    methods: {
        filterByCategory(name) {
            axios
                .get('/api/posts', {
                    params: {
                        category: name,
                    },
                })
                .then((response) => {
                    this.posts = response.data.data;
                    this.links = response.data.meta.links;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        changePage(link) {
            if (!link.url || link.active) {
                return;
            }

            axios
                .get(link.url)
                .then((response) => {
                    this.posts = response.data.data;
                    this.links = response.data.meta.links;
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    },
    mounted() {
        axios
            .get('/api/posts')
            .then((response) => {
                console.log(response);
                this.posts = response.data.data;
                this.links = response.data.meta.links;
            })
            .catch((error) => {
                console.log(error);
            });

        axios
            .get('/api/categories')
            .then((response) => {
                this.categories = response.data;
            })
            .catch((error) => {
                console.log(error);
            });
    },
    watch: {
        title() {
            axios
                .get('/api/posts', {
                    params: {
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.posts = response.data.data;
                    this.links = response.data.meta.links;
                })
                .catch((error) => {
                    console.log(error);
                });
        }
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
    padding: 12px 20px;
    border-radius: 15px;
}

.no-matches {
    margin-bottom: 50px;
}

.pagination {
    text-align: center;
    margin-top: 20px;
    margin-bottom: 40px;
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
    margin: 2px 5px;
}

.pagination a:hover {
    background-color: white !important;
    color: black;
    transition-duration: 0.5s;
}

.active {
    background-color: #1a1e24 !important;
}

.active:hover {
    background-color: white !important;
    color: black;
    transition-duration: 0.5s;
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

.disabled {
    pointer-events: none;
}
</style>
