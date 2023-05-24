<template>
    <div
        class="flex flex-col col-span-full sm:col-span-6 xl:col-span-6 bg-white shadow-lg rounded-sm border border-slate-200"
    >
        <header class="px-5 py-4 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">
                Analytic of the previous 7 days
            </h2>
        </header>
        <!-- Chart built with Chart.js 3 -->
        <!-- Change the height attribute to adjust the chart height -->
        <BarChart v-if="loaded" :data="chartData" width="200" height="248" />
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { notify } from "notiwind";
import BarChart from "@/components/charts/BarChart.vue";

// Import utilities
import { tailwindConfig } from "@/utils/Utils.js";
import axios from "axios";

const loaded = ref(false);
const chartData = ref({
    labels: [],
    datasets: [
        // Light blue bars
        {
            label: "Revenue",
            data: [],
            backgroundColor: tailwindConfig().theme.colors.blue[400],
            hoverBackgroundColor: tailwindConfig().theme.colors.blue[500],
            barPercentage: 0.66,
            categoryPercentage: 0.66,
        },
    ],
});

const query = async () => {
    axios
        .get(route("dashboard.gettotalrevenue"))
        .then((res) => {
            chartData.value.labels = Object.keys(res.data.graph_data);
            chartData.value.datasets[0].data = Object.values(
                res.data.graph_data
            );
            loaded.value = true;
        })
        .catch((res) => {
            console.log(res);
        });
};

onMounted(() => {
    query();
});
</script>
