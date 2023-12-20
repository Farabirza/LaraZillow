<template>
    <form @submit.prevent="update">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label">Beds</label>
                <input class="input" type="text" v-model.number="form.beds">
                <div class="input-error" v-if="form.errors.beds">
                    {{ form.errors.beds }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Baths</label>
                <input class="input" type="text" v-model.number="form.baths">
                <div class="input-error" v-if="form.errors.baths">
                    {{ form.errors.baths }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Area</label>
                <input class="input" type="text" v-model.number="form.area">
                <div class="input-error" v-if="form.errors.area">
                    {{ form.errors.area }}
                </div>
            </div>
            <div class="col-span-4">
                <label class="label">Street</label>
                <input class="input" type="text" v-model.number="form.street">
                <div class="input-error" v-if="form.errors.street">
                    {{ form.errors.street }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Street number</label>
                <input class="input" type="text" v-model.number="form.street_nr">
                <div class="input-error" v-if="form.errors.street_nr">
                    {{ form.errors.street_nr }}
                </div>
            </div>
            <div class="col-span-4">
                <label class="label">City</label>
                <input class="input" type="text" v-model.number="form.city">
                <div class="input-error" v-if="form.errors.city">
                    {{ form.errors.city }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Code</label>
                <input class="input" type="text" v-model.number="form.code">
                <div class="input-error" v-if="form.errors.code">
                    {{ form.errors.code }}
                </div>
            </div>
            <div class="col-span-6">
                <label class="label">Price</label>
                <input class="input" type="text" v-model.number="form.price">
                <div class="input-error" v-if="form.errors.price">
                    {{ form.errors.price }}
                </div>
            </div>
            <div class="col-span-6 mt-3">
                <button type="submit" class="btn-primary">Submit</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
const props = defineProps({
    listing: Object,
});

const form = useForm({
    _method: 'put',
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    street: props.listing.street,
    street_nr: props.listing.street_nr,
    city: props.listing.city,
    code: props.listing.code,
    price: props.listing.price,
});
const update = () => form.post(route('listing.update', {listing: props.listing.id}));
</script>

<style scoped>
label { margin-right: 2em; }
div { padding: 2px; }
</style>