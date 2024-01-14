<template>
    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="email" class="label">Email / username</label>
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
                <button class="btn-primary w-full" type="submit">Login</button>
            </div>
            <div class="mt-3">
                <p>Don't have account? <Link :href="route('register')" class="underline">Register</Link> or <Link :href="route('listing.index')" class="underline">login as a guest</Link></p>
            </div>
        </div>
    </form>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: null,
    password: null,
});

const login = () => form.post(route('login.store'));
</script>