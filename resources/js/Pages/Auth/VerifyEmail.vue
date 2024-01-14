<template>
    <Box>
        <div class="text-center">
            <h1 class="text-bold text-3xl mb-4">Email Verification</h1>
            <p>A verification mail has been sent to your email address, please click the button or the link inside it to verify your account.</p>
            <p>If you don't receive any email, click the button below to resend the verification email:</p>
        </div>
        <div class="flex justify-center mt-4">
            <Link :href="route('verification.send')" as="button" method="post" class="btn-outline">Resend Verification Email</Link>
        </div>
    </Box>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
import Box from '@/Components/UI/Box.vue';

</script>