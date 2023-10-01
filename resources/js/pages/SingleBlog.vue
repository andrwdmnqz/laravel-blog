<template>
    <div class="main-title">
        <h1>Post title</h1>
    </div>
    <div class="post-data">
        <div class="post-image">
            <img src="/storage/team-empire.jpg" alt="Team empire">
        </div>
        <div class="post-attributes">
            <p>Post author</p>
            <p>Created when</p>
        </div>
        <div class="about-content">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel nisi eget augue ultrices pellentesque. Praesent venenatis, nulla id efficitur tincidunt, ipsum mauris aliquet dolor, id gravida tellus velit nec arcu. Vestibulum et hendrerit sem. Duis aliquam ac nulla vitae consectetur. Duis venenatis tristique fermentum. Praesent lorem massa, vehicula ut lectus eu, ullamcorper mollis mi. Aliquam in mi et mauris posuere bibendum. Fusce pretium arcu laoreet massa condimentum, ac semper augue mollis.</p>
            <p>Nulla at lacinia lorem. Curabitur in ipsum vestibulum, pharetra dolor sed, tristique dui. Sed efficitur sem sed commodo egestas. Donec viverra aliquet ligula. Nulla ac dui augue. Praesent nec aliquet quam. Maecenas vitae sollicitudin eros. Quisque aliquam rhoncus dui. Duis ut sem in magna fringilla fringilla eu a massa. Vestibulum fringilla lobortis risus, eu porttitor sapien varius vitae. Proin aliquet nibh a turpis elementum, quis posuere magna blandit. Vivamus at nunc dui. Curabitur aliquet vehicula massa, at pretium dolor facilisis at.</p>
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
