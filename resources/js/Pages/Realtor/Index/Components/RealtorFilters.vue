<template>
    <form action="">
        <div class="my-4 flex flex-wrap gap-4">
            <div>
                <select v-model="filterForm.by" class="input-filter-l w-24">
                    <option value="created_at">Added</option>
                    <option value="price">Price</option>
                </select>
                <select v-model="filterForm.order" class="input-filter-r w-32">
                    <option v-for="option in sortOption" :key="option.value" :value="option.value">{{ option.label }}</option>
                </select>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" v-model="filterForm.deleted" id="deleted" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                <label for="deleted">Show deleted items</label>
            </div>
        </div>
    </form>
</template>

<script setup>
import { reactive, watch, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import { debounce } from 'lodash'

const sortOption = computed(() => sortLabel[filterForm.by]);

const props = defineProps({
    filters: Object,
});

const filterForm = reactive({
    deleted: props.filters.deleted ?? false,
    by: props.filters.created_at ?? 'created_at',
    order: props.filters.order ?? 'desc',
});

const sortLabel = {
    created_at: [{
        label: 'Latest',
        value: 'desc',
    }, {
        label: 'Oldest',
        value: 'asc',
    }],
    price: [{
        label: 'Highest',
        value: 'desc',
    }, {
        label: 'Lowest',
        value: 'asc',
    }]
};

watch(
    filterForm, debounce(() => router.get(
        route('realtor.listing.index'),
        filterForm,
        {preserveState: true, preserveScroll: true}
    ), 1000),
);
</script>