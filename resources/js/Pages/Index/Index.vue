<template>
    <div>Index</div>
    <div>{{ message }}</div>
    <Link href="/show">ShowPage</Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
defineProps(['message']);
</script>