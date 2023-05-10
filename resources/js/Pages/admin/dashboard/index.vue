<script>
export default {
    layout: AppLayout,
};
</script>
<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { computed, ref } from "vue";
import { array, object, string } from "vue-types";
import AppLayout from "@/layouts/apps.vue";
import WelcomeBanner from "@/partials/dashboard/WelcomeBanner.vue";
import DashboardCard from "@/partials/dashboard/DashboardCard1.vue";
import Card from "@/partials/dashboard/DashboardCard.vue";
import BarChartCard from "@/partials/dashboard/DashboardCard2.vue";
import DashboardCardTable from "@/partials/dashboard/DashboardCardTable.vue";
import { usePage } from "@inertiajs/inertia-vue3";
import dayjs from "dayjs";

const user = computed(() => usePage().props.value.admin_data);
const filter = ref({});

const props = defineProps({
    filter: object(),
    query: array(),
    modules: array(),
    title: string(),
});

const labels = [
    "12-01-2020",
    "01-01-2021",
    "02-01-2021",
    "03-01-2021",
    "04-01-2021",
    "05-01-2021",
    "06-01-2021",
    "07-01-2021",
    "08-01-2021",
    "09-01-2021",
    "10-01-2021",
    "11-01-2021",
    "12-01-2021",
    "01-01-2022",
    "02-01-2022",
    "03-01-2022",
    "04-01-2022",
    "05-01-2022",
    "06-01-2022",
    "07-01-2022",
    "08-01-2022",
    "09-01-2022",
    "10-01-2022",
    "11-01-2022",
    "12-01-2022",
    "01-01-2023",
];

const datasets = [
    732, 610, 610, 504, 504, 504, 349, 349, 504, 342, 504, 610, 391, 192, 154,
    273, 191, 191, 126, 263, 349, 252, 423, 622, 470, 532,
];

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
    <div class="grid grid-cols-12 gap-6">
        <DashboardCard
            title="Total Revenue"
            value="100,000"
            isRupiah
            :labels="labels"
            :datasets="datasets"
            isAnalytic
        />
        <DashboardCard
            title="Total Purchase"
            value="10"
            :labels="labels"
            :datasets="datasets"
            isAnalytic
        />

        <Card
            title="Total Product"
            value="44"
            :labels="labels"
            :datasets="datasets"
        />
        <BarChartCard />

        <DashboardCardTable />
    </div>
</template>
