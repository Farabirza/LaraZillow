<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center w-full">
            <div class="w-full text-center font-medium text-gray-500">No image</div>
        </Box>
        <div class="flex flex-col md:col-span-5 gap-4">
            <Box class="md:col-span-5">
                <template #header>Basic info</template>
                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAdress :listing="listing" class="text-gray-500" />
                <div class="flex gap-3">
                    <Link :href="route('listing.edit', listing.id)">Edit</Link>
                    <Link :href="`/listing/${listing.id}`" method="delete" as="button">Delete</Link>
                </div>
            </Box>
            <Box>
                <template #header>
                    Monthly Payment
                </template>
                <div>
                    <label class="label">Interset rate {{ intersetRate }}</label>
                    <input type="range" v-model.number="intersetRate" min="0.1" max="30" step="0.1" class="input-range">
                </div>
                <div>
                    <label class="label">Duration {{ duration }} years</label>
                    <input type="range" v-model.number="duration" min="3" max="35" step="1" class="input-range">
                </div>
                <div class="text-gray-600 dark:text-gray-300 mt-2">
                    <div class="text-gray-400">Your monthly payment</div>
                    <Price :price="monthlyPayment" class="text-3xl"/>
                </div>
                <div class="mt-2 text-gray-500">
                    <div class="flex justify-between">
                        <div>Total paid</div>
                        <div>
                            <Price :price="totalPaid" class="font-medium" />
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>Principal paid</div>
                        <div>
                            <Price :price="listing.price" class="font-medium" />
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>Interest paid</div>
                        <div>
                            <Price :price="totalInterest" class="font-medium" />
                        </div>
                    </div>
                </div>
            </Box>
            <Box>
                <template #header>Offer</template>
                Make an offer
            </Box>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Box from '@/Components/UI/Box.vue'
import ListingAdress from '@/Components/ListingAdress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import {ref} from 'vue'
import {useMonthlyPayment} from '@/Composables/useMonthlyPayment'

const intersetRate = ref(2.5);
const duration = ref(25);

const props = defineProps({
    listing: Object,
});

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(props.listing.price, intersetRate, duration);
</script>