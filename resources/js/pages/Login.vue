<template>
    <div class="main-title">
        <h1>Login</h1>
    </div>
    <div class="center-form">
        <div class="login-form">
            <form>
                <div class="form-group">
                    <label for="email">Email</label><br>
                    <input type="text" id="email" class="input-field" v-model="fields.email">
                    <span v-if="errors.email" class="error-validation">{{ errors.email[0] }}</span>
                    <span v-if="errors.error_text" class="error-validation">{{ errors.error_text }}</span>
                </div>

                <div class="form-group">
                    <label for="name">Password</label><br>
                    <input type="password" id="password" class="input-field" v-model="fields.password">
                    <span v-if="errors.password" class="error-validation">{{ errors.password[0] }}</span>
                </div>
                <button class="submit-button" type="button" @click="submit">Sign in</button>
                <p>Already have an account?
                    <router-link :to="{name: 'Register'}" class="header-link redirect-link">Sign up</router-link>
                </p>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, defineEmits } from "vue";
import axios from "axios";
import router from "@/router/index.js";

const emits = defineEmits(['updateSidebar']);

const wrongCredentialsText = ref('');
const fields = ref({});
const errors = ref({});

const submit = () => {
    errors.value = {};
    axios
        .post('/api/login', fields.value)
        .then((response) => {
            localStorage.setItem('authToken', response.data.token);
            localStorage.setItem('authenticated', 'true');
            router.push({ name: 'Manage' });
            emits('updateSidebar');
    }).catch((error) => {
        errors.value = error.response.data.errors;
        if (error.response.status === 401) {
            errors.value = error.response.data;
        }
    });
};
</script>

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
