<script>
export default {
    layout: AppLayout,
};
</script>
<script setup>
import axios from "axios";
import { Head } from "@inertiajs/inertia-vue3";
import { computed, onMounted, ref } from "vue";
import { array, object, string, any } from "vue-types";
import { usePage } from "@inertiajs/inertia-vue3";
import AppLayout from "@/layouts/apps.vue";
import WelcomeBanner from "@/partials/dashboard/WelcomeBanner.vue";
import DashboardCard from "@/partials/dashboard/DashboardCard1.vue";
import Card from "@/partials/dashboard/DashboardCard.vue";
import BarChartCard from "@/partials/dashboard/DashboardCard2.vue";
import DashboardCardTable from "@/partials/dashboard/DashboardCardTable.vue";
import debounce from "@/composables/debounce";
import dayjs from "dayjs";

const user = computed(() => usePage().props.value.admin_data);
const total_revenue = ref(0);
const total_products = ref(0);
const most_sales_products = ref([]);
const labels = ref([]);
const datasets = ref([]);
const filter = ref({});

const isLoading = ref(true);
const props = defineProps({
    filter: object(),
    query: array(),
    modules: array(),
    title: string(),
    additional: any(),
});

const labelsDummy = [
    "2023-1",
    "2023-2",
    "2023-3",
    "2023-4",
    "2023-5",
    "2023-6",
    "2023-7",
    "2023-8",
    "2023-9",
    "2023-10",
    "2023-11",
    "2023-12",
];

const datasetsDummy = [0, 5000000, 0, 1530000, 0, 0, 0, 0, 0, 0, 0, 0];

const handleDateRange = () => {
    const dateStart = new Date(
        filter.value.date[0].getFullYear(),
        filter.value.date[0].getMonth(),
        filter.value.date[0].getDate()
    );
    const dateEnd = new Date(
        filter.value.date[1].getFullYear(),
        filter.value.date[1].getMonth(),
        filter.value.date[1].getDate()
    );

    filter.value.start_date = dayjs(dateStart).format("YYYY-MM-DD");
    filter.value.end_date = dayjs(dateEnd).format("YYYY-MM-DD");
};

const getTotalRevenue = async () => {
    axios
        .get(route("dashboard.gettotalrevenue"), {
            params: {
                start_date: filter.value.start_date,
                end_date: filter.value.end_date,
            },
        })
        .then((res) => {
            total_revenue.value = Number(res.data.total_revenue).toLocaleString(
                "id-ID"
            );
            labels.value = Object.keys(res.data.graph_data);
            datasets.value = Object.values(res.data.graph_data);
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
        .finally(() => (isLoading.value = false));
};

const getTotalProducts = debounce(async () => {
    axios
        .get(route("dashboard.gettotalproducts"), {
            params: {
                start_date: filter.value.start_date,
                end_date: filter.value.end_date,
            },
        })
        .then((res) => {
            total_products.value = res.data.total
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
        .finally(() => (isLoading.value = false));
},500)

const getMostSalesProduct = debounce(async () => {
    axios
        .get(route("dashboard.getmostsalesproduct"), {
            params: {
                start_date: filter.value.start_date,
                end_date: filter.value.end_date,
            },
        })
        .then((res) => {
            most_sales_products.value = res.data.data
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
        .finally(() => (isLoading.value = false));
})

onMounted(() => {
    getTotalRevenue();
    getTotalProducts();
    getMostSalesProduct();
});

</script>

<template>
    <Head :title="props.title" />
    <WelcomeBanner :user="user" />

    <div class="mb-4 sm:mb-6 flex justify-end">
        <Datepicker
            v-model="filter.date"
            @update:modelValue="handleDateRange"
            range
            :partial-range="false"
            :enableTimePicker="false"
            :clearable="true"
            position="left"
            format="dd MMMM yyyy"
            previewFormat="dd MMMM yyyy"
            placeholder="Filter by date"
        />
    </div>
    {{ labels }}
    <br />
    {{ datasets }}


    <div class="grid grid-cols-12 gap-6">
        <!-- <DashboardCard
            title="Total Revenue"
            :value="total_revenue"
            isRupiah
            :labels="Object.keys(props.additional.graph_data)"
            :datasets="Object.values(props.additional.graph_data)"
            isAnalytic
        /> -->
        <DashboardCard
            title="Total Revenue"
            :value="total_revenue"
            isRupiah
            :labels="labels"
            :datasets="datasets"
            isAnalytic
        />
        <!-- <DashboardCard
            title="Total Revenue"
            :value="total_revenue"
            isRupiah
            :labels="labelsDummy"
            :datasets="datasetsDummy"
            isAnalytic
        /> -->
        <!-- <DashboardCard
            title="Total Transaction"
            :value="props.additional.total_transaction"
            :labels="labels"
            :datasets="graph_data"
            isAnalytic
        /> -->

        <Card
            title="Total Product"
            :value="total_products"
        />
        <BarChartCard />

        <DashboardCardTable :products="most_sales_products" />
    </div>
</template>
