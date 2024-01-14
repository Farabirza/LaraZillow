<template>
    <div class="flex gap-1">
        <Link v-for="(link) in links" 
        :key="link.index" class="py-2 px-4 rounded-md" 
        :href="link.url ?? route('listing.index')" :class="{'bg-indigo-500 dark:bg-indigo-800 text-gray-300': link.active}"
        v-html="!link.url ? null : (link.label == 'pagination.previous') ? 'Previous' : (link.label == 'pagination.next') ? 'Next' : link.label"></Link>
    </div>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'

defineProps({links: Array});
// console.log(links);
</script>