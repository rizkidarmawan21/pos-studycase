<template>
    <canvas ref="canvas" :data="data" :width="width" :height="height"></canvas>
</template>

<script>
import { ref, onMounted, onUnmounted, watch } from "vue";
import {
    Chart,
    LineController,
    LineElement,
    Filler,
    PointElement,
    LinearScale,
    TimeScale,
    Tooltip,
    CategoryScale,
} from "chart.js";
import "chartjs-adapter-moment";

// Import utilities
import { tailwindConfig, formatValue } from "@/utils/Utils.js";

Chart.register(
    LineController,
    LineElement,
    Filler,
    PointElement,
    LinearScale,
    TimeScale,
    Tooltip,
    CategoryScale
);

export default {
    props: ["data", "width", "height"],
    setup(props) {
        const canvas = ref(null);
        let chart = null;

        onMounted(() => {
            const ctx = canvas.value;
            chart = new Chart(ctx, {
                type: "line",
                data: props.data,
                options: {
                    chartArea: {
                        backgroundColor:
                            tailwindConfig().theme.colors.slate[50],
                    },
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
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                    interaction: {
                        intersect: false,
                        mode: "nearest",
                    },
                    maintainAspectRatio: false,
                    responsive: true,
                },
            });
        });

        watch(
            () => props.data,
            (newData) => {
                chart.destroy();
                chart.data = newData;
                chart.update();
            }
        );

        onUnmounted(() => chart.destroy());
        return {
            canvas,
        };
    },
};
</script>
