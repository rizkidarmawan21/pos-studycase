<script setup>
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
} from "chart.js";
import { Line } from "vue-chartjs";
import { tailwindConfig, formatValue } from "@/utils/Utils.js";
import { array, bool } from "vue-types";

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
);

const props = defineProps({
    isRupiah: bool(),
    data: array(),
});

const options = {
    responsive: true,
    maintainAspectRatio: false,
    resizeDelay: 200,
    layout: {
        padding: 20,
    },
    scales: {
        y: {
            display: false,
            beginAtZero: true,
        },
        x: {
            display: false,
        },
    },
    chartArea: {
        backgroundColor: tailwindConfig().theme.colors.slate[50],
    },
    plugins: {
        tooltip: {
            callbacks: {
                title: () => false, // Disable tooltip title
                label: (context) =>
                    props.isRupiah
                        ? formatValue(context.parsed.y)
                        : context.parsed.y,
            },
        },
        legend: {
            display: false,
        },
    },
    interaction: {
        intersect: false,
        mode: "nearest",
    },
};
</script>

<template>
    <Line :data="props.data" :options="options" />
</template>
