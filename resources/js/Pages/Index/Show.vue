<template>
        <div>Show</div>
        <Link href="/">Index</Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
defineProps(['message']);
</script>

<script>
import MainLayout from '../../Layouts/MainLayout.vue';
export default {
    layout: MainLayout
}
</script>