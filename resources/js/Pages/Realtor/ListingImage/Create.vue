<template>
    <Box>
        <template #header>Upload new images</template>
        <div class="mt-2">
            <form @submit.prevent="upload">
                <section class="flex gap-3">
                    <input type="file" multiple @input="addFiles" class="block w-full border rounded-md file:px-4 file:py-3 file:border-0 border-gray-200 dark:border-gray-700 file:text-gray-700 dark:file:text-gray-400 file:bg-gray-100 dark:file:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer" />
                    <div class="flex gap-2">
                        <button type="submit" class="btn-outline disabled:opacity-25" :disabled="!canUpload">Upload</button>
                        <button type="reset" class="btn-outline" @click="reset">Reset</button>
                    </div>
                </section>
            </form>
        </div>
        <div v-if="imageErrors.length" class="input-error mt-2">
            <div v-for="(error, index) in imageErrors" :key="index">
                {{ error }}
            </div>
        </div>
    </Box>
    <Box v-if="listing.images.length" class="mt-4">
        <template #header>Listing images</template>
        <section class="mt-4 grid grid-cols-3 gap-3">
            <div v-for="image in listing.images" :key="image.id" class="flex flex-col justify-between">
                <img :src="image.src" class="rounded-md" style="height: 320px;" />
                <Link :href="route('realtor.listing.image.destroy', {listing: props.listing.id, image: image.id})" method="delete" as="button" class="mt-2 btn-outline text-xs">Delete</Link>
            </div>
        </section>
    </Box>
    <EmptyState v-else class="mt-4">No image uploaded yet</EmptyState>
</template>

<script setup>
import { computed } from 'vue'
import { Link, useForm, router } from '@inertiajs/vue3'
import NProgress from 'nprogress'
import Box from '@/Components/UI/Box.vue'
import EmptyState from '@/Components/UI/EmptyState.vue';

const props = defineProps({listing: Object});
router.on('progress', (e) => {
    if(e.detail.progress.percentage) {
        NProgress.set((e.detail.progress.percentage / 100) * .9)
    }
});

const form = useForm({
    images: []
});
const imageErrors = computed(() => Object.values(form.errors));
const canUpload = computed(() => form.images.length);
const upload = () => {
    form.post(
        route('realtor.listing.image.store', {listing: props.listing.id}), {
            onSuccess: () => form.reset('images'),
        }
    )
};
const addFiles = (e) => {
    for(const image of e.target.files) {
        form.images.push(image);
    }
};
const reset = () => form.reset('images');
</script>