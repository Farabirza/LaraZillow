<template>
    <Box>
        <template #header>Make an Offer</template>
        <div class="mt-1">
            <form @submit.prevent="makeOffer">
                <input type="text" v-model.number="form.amount" class="input" />
                <input type="range" v-model.number="form.amount" :min="min" :max="max" step="1000" class="input-range mt-3">
                <button class="btn-outline w-full mt-2 text-sm">Make an Offer</button>
                {{ form.errors.amount }}
            </form>
        </div>
        <div class="flex justify-between text-gray-500 mt-2">
            <div>Difference</div>
            <div>
                <Price :price="difference" />
            </div>
        </div>
    </Box>
</template>

<script setup>
import { computed, watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { debounce } from 'lodash'
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'

const props = defineProps({
    listingId: String,
    price: Number,
});

const form = useForm({
    amount: props.price
});

const difference = computed(() => form.amount - props.price);
const min = computed(() => Math.round(props.price / 2));
const max = computed(() => Math.round(props.price * 2));

const makeOffer = () => form.post(
    route('listing.offer.store', {listing: props.listingId}),
    {
        preserveScroll: true,
        preserveState: true,
    }
);

const emit = defineEmits(['offerUpdated']);
watch(() => form.amount, debounce((value) => emit('offerUpdated', value), 200));
</script>