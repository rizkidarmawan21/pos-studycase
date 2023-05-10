<script setup>
import { ref } from "vue";
import { array, bool, string } from "vue-types";
import VIcon from "@/components/src/icons/VIcon.vue";
import LineChart from "@/components/charts/VLineChart.vue";
import { tailwindConfig, hexToRGB } from "@/utils/utils.js";

const props = defineProps({
    title: string().isRequired,
    labels: array().isRequired,
    value: string().isRequired,
    datasets: array().isRequired,
    isRupiah: bool(),
    isAnalytic: bool(),
});

const chartData = ref({
    labels: props.labels,
    datasets: [
        // Indigo line
        {
            data: props.datasets,
            fill: true,
            backgroundColor: `rgba(${hexToRGB(
                tailwindConfig().theme.colors.blue[500]
            )}, 0.08)`,
            borderColor: tailwindConfig().theme.colors.indigo[500],
            borderWidth: 2,
            tension: 0,
            pointRadius: 0,
            pointHoverRadius: 3,
            pointBackgroundColor: tailwindConfig().theme.colors.indigo[500],
            clip: 20,
        },
    ],
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
