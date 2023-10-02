<template>
    <div class="main-title">
        <h1>Manage panel</h1>
    </div>
    <div class="welcome-title">
        <h2>Hello, </h2>
    </div>
    <div class="manage-actions">
        <ul>
            <li>Create post</li>
            <li>Post list</li>
            <li>Create category</li>
            <li>Category list</li>
        </ul>
    </div>
</template>

<script>

</script>

<style>
.manage-actions {
    display: flex;
    justify-content: center;
    margin-top: 40px;
    font-size: 24px;
}

.manage-actions ul {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.manage-actions ul li {
    padding: 5px 0;
    text-decoration: underline;
}

.manage-actions ul li:hover {
    cursor: pointer;
}

.welcome-title {
    display: flex;
    justify-content: center;
    margin: 20px 0;
}
</style>
