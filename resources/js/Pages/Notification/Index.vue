<template>
    <h1 class="text-3xl mb-4">notification</h1>
    <section v-if="notifications.data.length" class="text-gray-700 dark:text-gray-400">
        <div v-for="notification in notifications.data" :key="notification.id" class="border-b border-gray-200 dark:border-gray-800 py-4 flex justify-between items-center">
            <div>
                <div v-if="notification.type === 'App\\Notifications\\OfferMade'">
                    Offer <Price :price="notification.data.amount" /> for <Link :href="route('listing.show', {listing: notification.data.listing_id})" class="text-indigo-600 dark:text-indigo-400">Listing</Link> was made!
                </div>
                <span v-else>Notification</span>
            </div>
            <div>
                <Link v-if="!notification.read_at" :href="route('notification.seen', {notification: notification.id})" as="button" method="put" class="btn-outline font-medium text-xs">Mark as read</Link>
            </div>
        </div>
    </section>
    <EmptyState v-else>No notifications yet</EmptyState>
    <section v-if="notifications.data.length > 10" class="w-full flex justify-center my-4">
        <Pagination :links="notifications.links" />
    </section>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
import Price from '@/Components/Price.vue';
import Pagination from '@/Components/UI/Pagination.vue'
import EmptyState from '@/Components/UI/EmptyState.vue';

defineProps({
    notifications: Object
});
</script>