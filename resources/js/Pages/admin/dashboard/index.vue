<script>
export default {
    layout: AppLayout,
};
</script>
<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import { array, object, string } from "vue-types";
import AppLayout from "@/layouts/apps.vue";
import WelcomeBanner from "@/partials/dashboard/WelcomeBanner.vue";
import DashboardCard from "@/partials/dashboard/DashboardCard1.vue";
import { usePage } from "@inertiajs/inertia-vue3";

const user = computed(() => usePage().props.value.admin_data);

const props = defineProps({
    filter: object(),
    query: array(),
    modules: array(),
    title: string(),
});
</script>

<template>
    <Head :title="props.title" />
    <WelcomeBanner :user="user" />

    <div class="grid grid-cols-12 gap-6">
        <DashboardCard />
    </div>
</template>
