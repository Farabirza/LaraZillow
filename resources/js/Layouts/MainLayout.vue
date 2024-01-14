<template>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium cursor-pointer"><Link :href="route('listing.index')">Listings</Link></div>
                <div class="text-lg text-indigo-600 dark:text-indigo-300 font-bold text-center"><Link :href="route('listing.index')">LaraZillow</Link></div>
                <div v-if="user" class="flex items-center gap-4">
                    <Link v-if="notificationsCount" :href="route('notification.index')" class="relative">
                        <svg class="w-8 h-8 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 21"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M15.585 15.5H5.415A1.65 1.65 0 0 1 4 13a10.526 10.526 0 0 0 1.5-5.415V6.5a4 4 0 0 1 4-4h2a4 4 0 0 1 4 4v1.085c0 1.907.518 3.78 1.5 5.415a1.65 1.65 0 0 1-1.415 2.5zm1.915-11c-.267-.934-.6-1.6-1-2s-1.066-.733-2-1m-10.912 3c.209-.934.512-1.6.912-2s1.096-.733 2.088-1M13 17c-.667 1-1.5 1.5-2.5 1.5S8.667 18 8 17"/></svg>
                        <div class="px-1 bg-red-500 rounded-full text-center text-white text-sm absolute -top-3 -end-2">
                            <span>{{ notificationsCount }}</span>
                        </div>
                    </Link>
                    <Link :href="route('realtor.listing.index')" class="text-sm text-gray-500">{{ user.name }}</Link>
                    <div class="btn-primary"><Link :href="route('listing.create')">+ New listing</Link></div>
                    <div>
                        <Link :href="route('logout')" method="delete" as="button">Logout</Link>
                    </div>
                </div>
                <div v-else class="btn-primary">
                    <Link :href="route('login')">Login</Link>
                </div>
            </nav>
        </div>
    </header>
    <main class="container mx-auto p-4 w-full">
        <div v-if="page.props.flash.success" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
            {{ flashSuccess }}
        </div>
        <div v-if="page.props.flash.error" class="mb-4 border rounded-md shadow-sm border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900 p-2">
            {{ flashError }}
        </div>
        <slot>Default</slot>
    </main>
</template>

<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const page = usePage();
const flashSuccess = computed(
    () => page.props.flash.success,
);
const flashError = computed(
    () => page.props.flash.error,
);
const user = computed(() => page.props.user);
const notificationsCount = computed(() => Math.min(page.props.user.notificationsCount, 9));
</script>