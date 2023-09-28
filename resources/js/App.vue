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
                            <a href="#">Home</a>
                            <a href="#">Blog</a>
                            <a href="#">About</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="container">
            <router-view></router-view>
        </main>

        <footer>
            <div class="footer-background">
                <div class="container">
                    <p>&copy; Laravel-vue blog by Andrii S.</p>
                </div>
            </div>
        </footer>
    </div>
</template>
