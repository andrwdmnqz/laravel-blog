<template>
    <div class="main-title">
        <h1>Registration</h1>
    </div>
    <div class="center-form">
        <div class="register-form">
            <form @submit.prevent="submit">
                <div class="form-group">
                    <label for="email">Email</label><br>
                    <input type="email" id="email" class="input-field" v-model="fields.email">
                    <span v-if="errors.email" class="error-validation">{{ errors.email[0] }}</span>
                </div>

                <div class="form-group">
                    <label for="name">Name</label><br>
                    <input type="text" id="name" class="input-field" v-model="fields.name">
                    <span v-if="errors.name" class="error-validation">{{ errors.name[0] }}</span>
                </div>

                <div class="form-group">
                    <label for="password">Password</label><br>
                    <input type="password" id="password" class="input-field" v-model="fields.password">
                    <span v-if="errors.password" class="error-validation">{{ errors.password[0] }}</span>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm password</label><br>
                    <input type="password" id="confirm-password" class="input-field"
                           v-model="fields.password_confirmation">
                </div>
                <button class="submit-button" type="submit">Sign up</button>
                <p>Already have an account?
                    <router-link :to="{name: 'Login'}" class="header-link redirect-link">Sign in</router-link>
                </p>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, defineEmits } from "vue";
import axios from "axios";
import router from "@/router/index.js";

const fields = ref({});
const errors = ref({});

const emits = defineEmits(['updateSidebar']);

const submit = () => {
    axios.post('/api/register', fields.value).then((response) => {
        localStorage.setItem('authToken', response.data.token);
        localStorage.setItem('authenticated', 'true');
        router.push({name: 'Manage'});
        emits('updateSidebar');
    }).catch((error) => {
        console.log(error);
        errors.value = error.response.data.errors;
    });
};
</script>

<style>
.center-form {
    display: flex;
    justify-content: center;
}

.register-form {
    border-radius: 20px;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    width: fit-content;
    padding: 20px;
    background-color: #a22e2e;
    margin: 40px 0;
}

.register-form div {
    margin-top: 15px;
}

.register-form div:first-child {
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

.register-form p {
    padding-top: 15px;
}

.redirect-link {
    color: #0c0c6b !important;
    text-decoration: underline;
}
</style>
<script setup>
</script>
