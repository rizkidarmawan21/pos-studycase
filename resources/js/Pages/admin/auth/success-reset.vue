<script>
import AuthLayout from "@/layouts/auth.vue"
export default {
    layout: AuthLayout,
}
</script>
<script setup>
import { string } from "vue-types";
import { Link } from "@inertiajs/inertia-vue3";
import { Head } from "@inertiajs/inertia-vue3";

const props = defineProps({
    title: string()
})
</script>

<template>
    <Head :title="title"></Head>
    <div class="min-h-screen h-full flex flex-col after:flex-1">
        <div class="flex-1" />
        <div class="max-w-sm px-4 py-8 w-full">
            <h1 class="text-3xl text-slate-800 font-bold mb-3">
                Success Reset Password
                Please try to Login Again
            </h1>
            <div class="text-sm">
                <Link class="font-medium text-primary hover:text-primary-hover underline" :href="route('login')">
                Login Page</Link>
            </div>
        </div>
    </div>
</template>
