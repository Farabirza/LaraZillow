<template>
    <form @submit.prevent="create">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label">Beds</label>
                <input type="text" v-model.number="form.beds" class="input">
                <div class="input-error" v-if="form.errors.beds">
                    {{ form.errors.beds }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Baths</label>
                <input type="text" v-model.number="form.baths" class="input">
                <div class="input-error" v-if="form.errors.baths">
                    {{ form.errors.baths }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Area</label>
                <input type="text" v-model.number="form.area" class="input">
                <div class="input-error" v-if="form.errors.area">
                    {{ form.errors.area }}
                </div>
            </div>
            <div class="col-span-4">
                <label class="label">Street</label>
                <input type="text" v-model.number="form.street" class="input">
                <div class="input-error" v-if="form.errors.street">
                    {{ form.errors.street }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Street number</label>
                <input type="text" v-model.number="form.street_nr" class="input">
                <div class="input-error" v-if="form.errors.street_nr">
                    {{ form.errors.street_nr }}
                </div>
            </div>
            <div class="col-span-4">
                <label class="label">City</label>
                <input type="text" v-model.number="form.city" class="input">
                <div class="input-error" v-if="form.errors.city">
                    {{ form.errors.city }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Code</label>
                <input type="text" v-model.number="form.code" class="input">
                <div class="input-error" v-if="form.errors.code">
                    {{ form.errors.code }}
                </div>
            </div>
            <div class="col-span-6">
                <label class="label">Price</label>
                <input type="text" v-model.number="form.price" class="input">
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

const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    street: null,
    street_nr: 0,
    city: null,
    code: null,
    price: 0,
});
const create = () => form.post('/listing');
</script>

<style scoped>
label { margin-right: 2em; }
div { padding: 2px; }
</style>