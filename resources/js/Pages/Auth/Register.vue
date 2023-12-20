<template>
    <form @submit.prevent="register">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="name" class="label">Name</label>
                <input type="text" v-model="form.name" name="name" id="name" class="input"/>
                <div class="input-error" v-if="form.errors.name">
                    {{ form.errors.name }}
                </div>
            </div>
            <div class="mt-4">
                <label for="email" class="label">Email</label>
                <input type="text" v-model="form.email" name="email" id="email" class="input"/>
                <div class="input-error" v-if="form.errors.email">
                    {{ form.errors.email }}
                </div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input type="password" v-model="form.password" name="password" id="password" class="input"/>
                <div class="input-error" v-if="form.errors.password">
                    {{ form.errors.password }}
                </div>
            </div>
            <div class="mt-4">
                <label for="password_confirmation" class="label">Confirm password</label>
                <input type="password" v-model="form.password_confirmation" name="password_confirmation" id="password_confirmation" class="input"/>
                <div class="input-error" v-if="form.errors.password_confirmation">
                    {{ form.errors.password_confirmation }}
                </div>
            </div>
            <div class="mt-4">
                <button class="btn-primary w-full" type="submit">Register</button>
            </div>
            <div class="mt-3">
                <span>Already have account? <Link :href="route('login')" class="underline">Login</Link></span>
            </div>
        </div>
    </form>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});

const register = () => form.post(route('register.store'));
</script>