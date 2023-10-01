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
                            <router-link :to="{name: 'Home'}" class="header-link">Home</router-link>
                            <router-link :to="{name: 'Blog'}" class="header-link">Blog</router-link>
                            <router-link :to="{name: 'About'}" class="header-link">About</router-link>
                            <router-link :to="{name: 'Login'}" class="header-link">Login</router-link>
                            <router-link :to="{name: 'Register'}" class="header-link">Register</router-link>
                            <router-link :to="{name: 'Manage'}" class="header-link">Manage</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-content">
            <main class="container main-content">
                <router-view></router-view>
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
