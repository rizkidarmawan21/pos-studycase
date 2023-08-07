<script setup>
import { any, array, bool, string } from "vue-types";

const props = defineProps({
    title: string().isRequired,
    value: any().isRequired,
    isRupiah: bool(),
});
</script>

<template>
    <div
        class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200"
    >
        <div class="px-5 pt-5 text-center">
            <h2 class="text-3xl font-semibold text-slate-800 mt-2 mb-2">
                {{ title }}
            </h2>
            <!-- <div class="text-xs font-semibold text-slate-400 uppercase mb-1">
                Sales
            </div> -->
            <div class="text-center mt-4">
                <div class="text-8xl font-bold text-slate-800 mr-2">
                    {{ isRupiah ? "Rp." : "" }} {{ value }}
                </div>
            </div>
        </div>
    </div>
</template>
