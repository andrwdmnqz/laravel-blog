<template>
    <div class="main-title">
        <h1>Login</h1>
    </div>
    <div class="center-form">
        <div class="login-form">
            <form>
                <div class="form-group">
                    <label for="email">Email</label><br>
                    <input type="text" id="email" class="input-field">
                </div>

                <div class="form-group">
                    <label for="name">Password</label><br>
                    <input type="password" id="password" class="input-field">
                </div>
                <button class="submit-button">Sign in</button>
                <p>Already have an account? <router-link :to="{name: 'Register'}" class="header-link redirect-link">Sign up</router-link></p>
            </form>
        </div>
    </div>
</template>
<style>
.center-form {
    display: flex;
    justify-content: center;
}
.login-form {
    border-radius: 20px;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    width: fit-content;
    padding: 20px;
    background-color: #a22e2e;
    margin-top: 40px;
}

.login-form div {
    margin-top: 15px;
}

.login-form div:first-child {
    margin-top: 0;
}

.input-field {
    width: 100%;
    height: 25px;
    font-size: 20px;
    padding-left: 1px;
}

.submit-button {
    margin-top: 25px;
    color: white;
    background-color: black;
    padding: 10px 20px;
    font-size: 20px;
    border-radius: 15px;
    border: none;
}

.submit-button:hover {
    cursor: pointer;
}

.login-form p {
    padding-top: 15px;
}

.redirect-link {
    color: #0c0c6b !important;
    text-decoration: underline;
}
</style>
<script setup>
</script>
