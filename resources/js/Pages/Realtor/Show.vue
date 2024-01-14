<template>
    <div class="mb-4">
        <Link :href="route('realtor.listing.index')">&larr; Go back to listings</Link>
    </div>
    <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box v-if="!hasOffers" class="md:col-span-7 flex items-center">
            <div class="w-full text-center font-medium text-grey-500">
                No Offer
            </div>
        </Box>
        <div v-else class="md:col-span-7 flex flex-col gap-3">
            <Offer v-for="offer in listing.offers" :listing="listing" :offer="offer" :listing-price="listing.price" :is-sold="listing.sold_at != null" :key="offer.id" />
        </div>
        <div class="md:col-span-5">
            <Box>
                <template #header>Basic info</template>
                <Price :price="props.listing.price" class="text-2xl font-bold" />
                <ListingSpace :listing="props.listing" class="text-lg" />
                <ListingAddress :listing="props.listing" class="text-gray-500" />
            </Box>
        </div>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import ListingAddress from '@/Components/ListingAddress.vue'
import Offer from '@/Pages/Realtor/Show/Components/Offer.vue'

const props = defineProps({
    listing: Object,
    isSold: Boolean,
});

const hasOffers = computed(() => props.listing.offers.length);

</script>