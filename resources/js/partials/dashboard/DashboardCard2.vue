<template>
    <div
        class="flex flex-col col-span-full sm:col-span-6 xl:col-span-6 bg-white shadow-lg rounded-sm border border-slate-200"
    >
        <header class="px-5 py-4 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Analytic of the previous 7 days</h2>
        </header>
        <!-- Chart built with Chart.js 3 -->
        <!-- Change the height attribute to adjust the chart height -->
        <BarChart :data="chartData" width="200" height="248" />
    </div>
</template>

<script setup>
import { ref } from "vue";
import BarChart from "@/components/charts/BarChart.vue";

// Import utilities
import { tailwindConfig } from "@/utils/utils.js";

const chartData = ref({
    labels: [
        "12-01-2020",
        "01-01-2021",
        "02-01-2021",
        "03-01-2021",
        "04-01-2021",
        "05-01-2021",
        "06-01-2021",
        "07-01-2021",
    ],
    datasets: [
        // Light blue bars
        {
            label: "Direct",
            data: [800, 1600, 900, 1300, 1950, 1700],
            backgroundColor: tailwindConfig().theme.colors.blue[400],
            hoverBackgroundColor: tailwindConfig().theme.colors.blue[500],
            barPercentage: 0.66,
            categoryPercentage: 0.66,
        },
    ],
});


</script>
