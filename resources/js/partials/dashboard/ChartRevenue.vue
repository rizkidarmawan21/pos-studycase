<script setup>
import axios from "axios";
import { onMounted, ref, watch } from "vue";
import { object } from "vue-types";
import { notify } from "notiwind";
import LineChart from "@/components/charts/LineChart.vue";
import { tailwindConfig, hexToRGB, formatValue } from "@/utils/Utils.js";
import VLoading from "@/components/VLoading/index.vue";
import debounce from "@/composables/debounce";

const props = defineProps({
    filter: object(),
});

const total_revenue = ref(0);
const loaded = ref(false);
const isLoading = ref(true);

const chartData = ref({
    labels: [],
    datasets: [
        // Indigo line
        {
            label: "Total Revenue",
            data: [],
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

const query = debounce(async () => {
    axios
        .get(route("dashboard.gettotalrevenue"), {
            params: {
                start_date: props.filter.start_date,
                end_date: props.filter.end_date,
            },
        })
        .then((res) => {
            total_revenue.value = formatValue(res.data.total_revenue);
            chartData.value.labels = Object.keys(res.data.graph_data);
            chartData.value.datasets[0].data = Object.values(
                res.data.graph_data
            );
        })
        .catch((res) => {
            notify(
                {
                    type: "error",
                    group: "top",
                    text: res.response.data.message,
                },
                2500
            );
        })
        .finally(() => ((loaded.value = true), (isLoading.value = false)));
}, 500);

watch(
    () => props.filter,
    () => {
        query();
        console.log(chartData.value);
    }
);
onMounted(() => {
    query();
    console.log(props.filter);
});
</script>

<template>
    <div
        class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200"
    >
        <div v-if="isLoading" class="px-5 pt-5">
            <div class="h-[100%] overflow-hidden my-2">
                <VLoading />
            </div>
        </div>
        <div v-else>
            <div class="px-5 pt-5">
                <h2 class="text-lg font-semibold text-slate-800 mb-2">
                    Total Revenue
                </h2>
                <div class="flex items-start">
                    <div class="text-3xl font-bold text-slate-800 mr-2">
                        {{ total_revenue }}
                    </div>
                </div>
            </div>
            <!-- Chart built with Chart.js 3 -->
            <div class="grow">
                <!-- Change the height attribute to adjust the chart height -->
                <LineChart v-if="loaded" :data="chartData" />
            </div>
        </div>
    </div>
</template>
