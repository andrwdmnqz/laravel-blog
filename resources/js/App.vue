<script setup>
</script>
<template>
    <div class="background">
        <header>
            <div class="header-background">
                <div class="container">
                    <div class="header">
                        <div class="logo">
                            <img src="/storage/laravel-logo.png" alt="lara-logo" class="lara-logo">
                            <p>Blog</p>
                        </div>
                        <div class="actions">
                            <router-link :to="{name: 'Home'}" class="header-link white-link">Home</router-link>
                            <router-link :to="{name: 'Blog'}" class="header-link white-link">Blog</router-link>
                            <router-link :to="{name: 'About'}" class="header-link white-link">About</router-link>
                            <router-link v-if="!loggedIn" :to="{name: 'Login'}" class="header-link white-link">Login</router-link>
                            <router-link v-if="!loggedIn" :to="{name: 'Register'}" class="header-link white-link">Register</router-link>
                            <router-link v-if="loggedIn" :to="{name: 'Manage'}" class="header-link white-link">Manage</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-content">
            <main class="container main-content">
                <router-view @update-sidebar="updateSidebar" :key="$route.path"></router-view>
            </main>
        </div>

        <footer>
            <div class="footer-background">
                <div class="container footer">
                    <p>&copy; Laravel-vue blog by Andrii S.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
export default {
    emits: ['updateSidebar'],
    data() {
        return {
            loggedIn: false
        }
    },
    methods: {
        updateSidebar() {
            this.loggedIn = !this.loggedIn;
        }
    },
    mounted() {
        if (localStorage.getItem('authenticated')) {
            this.loggedIn = true;
        }
        else {
            this.loggedIn = false;
        }
    }
}
</script>
