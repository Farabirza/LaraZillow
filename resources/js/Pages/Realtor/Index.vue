<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>
    <section><RealtorFilters :filters="filters" /></section>
    <section v-if="listings.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings.data" :key="listing.id">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between" :class="{'opacity-50': listing.deleted_at}">
                <div>
                    <div v-if="listing.sold_at != null" class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 dark:border-green-600 dark:text-green-600 inline-block rounded-md mb-2">Sold</div>
                    <div class="xl:flex items-center gap-2">
                        <Price :price="listing.price" class="text-2xl font-medium" />
                        <ListingSpace :listing="listing" />
                        <ListingAddress :listing="listing" class="text-gray-500" />
                    </div>
                </div>
                <section v-if="!listing.deleted_at">
                    <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                        <a :href="route('listing.show', {listing: listing.id})" class="btn-outline text-xs font-medium">Preview</a>
                        <Link :href="route('listing.edit', {listing: listing.id})" class="btn-success text-xs font-medium">Edit</Link>
                        <Link :href="route('realtor.listing.destroy', {listing: listing.id})" as="button" method="delete" class="btn-danger text-xs font-medium">Delete</Link>
                    </div>
                    <div class="mt-2">
                        <Link :href="route('realtor.listing.image.create', {listing: listing.id})" class="btn-outline block w-full text-xs text-center font-medium">Image ({{ listing.images_count }})</Link>
                        <Link :href="route('realtor.listing.show', {listing: listing.id})" class="btn-outline block w-full text-xs text-center font-medium mt-2">Offers ({{ listing.offers_count }})</Link>
                    </div>
                </section>
                <section v-else>
                    <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                        <Link :href="route('realtor.listing.restore', {listing: listing.id})" as="button" method="put" class="btn-outline text-xs font-medium">Restore</Link>
                    </div>
                </section>
            </div>
            <div v-if="listing.deleted_at" class="flex mt-2">
                <div class="px-3 py-1 border text-xs text-gray-500 border-gray-300 dark:border-gray-700 rounded-md"><span>Deleted item</span></div>
            </div>
        </Box>
    </section>
    <EmptyState v-else>No listings yet</EmptyState>
    <section v-if="listings.data.length > 8" class="w-full flex justify-center my-4">
        <Pagination :links="listings.links" />
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import ListingAddress from '@/Components/ListingAddress.vue'
import RealtorFilters from '@/Pages/Realtor/Index/Components/RealtorFilters.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import EmptyState from '@/Components/UI/EmptyState.vue'

defineProps({
    listings: Object,
    filters: Object,
});
</script>