<script setup>
import { ref } from "vue";
import { any, array, bool, object, string } from "vue-types";
import LineChart from "@/components/charts/LineChart.vue";
import { tailwindConfig, hexToRGB } from "@/utils/Utils.js";

const props = defineProps({
    title: string().isRequired,
    value: any().isRequired,
    labels: array().isRequired,
    datasets: array().isRequired,
    isRupiah: bool(),
    isAnalytic: bool(),
});

console.log(props.title)
console.log(props.labels)
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
            tension: 0.3,
            pointRadius: 0,
            pointHoverRadius: 3,
            pointBackgroundColor: tailwindConfig().theme.colors.indigo[500],
            clip: 20,
        },
    ],
});
</script>

<template>
    <div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200" >
        <div class="px-5 pt-5">
            <h2 class="text-lg font-semibold text-slate-800 mb-2">
                {{ title }}
            </h2>
            <div class="flex items-start">
                <div class="text-3xl font-bold text-slate-800 mr-2">
                    {{ isRupiah ? "Rp." : "" }} {{ value }}
                </div>
            </div>
        </div>
        <!-- Chart built with Chart.js 3 -->
        <div class="grow">
            <!-- Change the height attribute to adjust the chart height -->
            <LineChart :data="chartData" />
        </div>
    </div>
</template>
