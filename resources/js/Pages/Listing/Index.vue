<template>
    <Filters :filters="filters" />
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Listing class="listing-item" v-for="(listing, i) in listings.data" :key="listing.id" :listing="listing" />
    </div>
    <div v-if="listings.data.length" class="w-full flex justify-center my-8">
        <Pagination :links="listings.links"/>
    </div>
</template>

<script setup>
import Listing from '@/Pages/Listing/Index/Components/Listing.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import Filters from '@/Components/ListingFilters.vue'
defineProps({
    listings: Object,
    filters: Object
});
</script>