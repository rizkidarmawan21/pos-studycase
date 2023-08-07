<script>
export default {
    layout: AppLayout,
};
</script>
<script setup>
import axios from "axios";
import { Head } from "@inertiajs/inertia-vue3";
import { notify } from "notiwind";
import { computed, onMounted, ref, watch } from "vue";
import { array, object, string, any } from "vue-types";
import { usePage } from "@inertiajs/inertia-vue3";
import AppLayout from "@/layouts/apps.vue";
import WelcomeBanner from "@/partials/dashboard/WelcomeBanner.vue";
import ChartRevenue from "@/partials/dashboard/ChartRevenue.vue";
import ChartTransaction from "@/partials/dashboard/ChartTransaction.vue";
import DashboardCardTable from "@/partials/dashboard/DashboardCardTable.vue";
import DashboardCard from "@/partials/dashboard/DashboardCard.vue";
import ChartAnalytic from "@/partials/dashboard/ChartAnalytic.vue";
import debounce from "@/composables/debounce";
import VFilter from "./Filter.vue";

const user = computed(() => usePage().props.value.admin_data);
const total_products = ref(0);
const most_sales_products = ref([]);
const filter = ref({});
const filterData = ref({});

const isLoading = ref(true);
const props = defineProps({
    title: string(),
    additional: any(),
});

const applyFilter = (data) => {
    filter.value = data
    isLoading.value = true

    handleFilter()
}

const clearFilter = (data) => {
    filter.value = data
    isLoading.value = true

    handleFilter()
}

const handleFilter = () => {
    filterData.value = {
        start_date: filter.value.start_date,
        end_date: filter.value.end_date,
    }
}

const getTotalProducts = debounce(async () => {
    axios
        .get(route("dashboard.gettotalproducts"))
        .then((res) => {
            total_products.value = res.data.total;
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
}, 500);

const getMostSalesProduct = debounce(async () => {
    axios
        .get(route("dashboard.getmostsalesproduct"), {
            params: {
                start_date: filter.value.start_date,
                end_date: filter.value.end_date,
            },
        })
        .then((res) => {
            most_sales_products.value = res.data.data;
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
});


onMounted(() => {
    getTotalProducts();
    getMostSalesProduct();
});

</script>

<template>
    <Head :title="props.title" />
    <WelcomeBanner :user="user" />

    <div class="mb-4 sm:mb-6 flex justify-end">
        <!-- Filter -->
        <VFilter @apply="applyFilter" @clear="clearFilter" />
    </div>
    <div class="grid grid-cols-12 gap-6">
       
        <ChartRevenue :filter="filterData" />
        <ChartTransaction :filter="filterData" />
        <DashboardCard title="Total Product" :value="total_products" />
        <!-- <ChartAnalytic /> -->
        <DashboardCardTable :products="most_sales_products" />
    </div>
</template>
