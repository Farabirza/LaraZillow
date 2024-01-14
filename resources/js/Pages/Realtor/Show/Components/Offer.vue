<template>
    <Box class="w-full">
        <template #header>
            <div class="flex items-center gap-2">
                <span>Offer by {{ props.offer.bidder.name }}</span>
                <span v-if="offer.accepted_at" class="dark:bg-green-900 dark:text-green-200 bg-green-200 text-green-900 p-1 rounded-md uppercase">Accepted</span>
            </div>
        </template>
        <section class="flex justify-between item-center">
            <div>
                <Price :price="props.offer.amount" class="text-xl" />
                <div class="text-gray-500">
                    Difference <Price :price="difference" />
                </div>
                <div class="text-gray-500">
                    Made on {{ madeOn }}
                </div>
            </div>
            <div>
                <!-- <Link v-if="available" :href="route('realtor.offer.accept', {offer: offer.id})" class="btn-outline text-xs font-medium" as="button" method="put">Accept</Link> -->
                <Link v-if="!isSold" :href="route('realtor.offer.accept', {offer: offer.id})" class="btn-outline text-xs font-medium" as="button" method="put">Accept</Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'

const props = defineProps({
    listing: Object,
    offer: Object,
    listingPrice: Number,
    isSold: Boolean,
});

const difference = computed(() => props.offer.amount - props.listingPrice);
const madeOn = computed(() => new Date(props.offer.created_at).toDateString());
// const available = computed(() => !props.offer.accepted_at && !props.offer.rejected_at);
</script>