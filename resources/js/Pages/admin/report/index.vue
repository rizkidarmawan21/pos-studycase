<script>
export default {
    layout: AppLayout
}
</script>
<script setup>
import axios from "axios";
import { notify } from "notiwind";
import { string } from "vue-types";
import { Head } from "@inertiajs/inertia-vue3";
import { ref, onMounted } from "vue";
import AppLayout from '@/layouts/apps.vue';
import debounce from "@/composables/debounce"
import VDropdownEditMenu from '@/components/VDropdownEditMenu/index.vue';
import VDataTable from '@/components/VDataTable/index.vue';
import VPagination from '@/components/VPagination/index.vue'
import VBreadcrumb from '@/components/VBreadcrumb/index.vue';
import VLoading from '@/components/VLoading/index.vue';
import VEmpty from '@/components/src/icons/VEmpty.vue';
import VButton from '@/components/VButton/index.vue';
import VDetail from '@/components/src/icons/VDetail.vue';
import VFilter from './Filter.vue';
import VModalForm from './ModalForm.vue';

const query = ref([])
const filter = ref({});
const breadcrumb = [
    {
        name: "Dashboard",
        active: false,
        to: route('dashboard.index')
    },
    {
        name: "Report",
        active: true,
        to: route('report.index')
    },
]
const pagination = ref({
    count: '',
    current_page: 1,
    per_page: '',
    total: 0,
    total_pages: 1
})
const itemSelected = ref({})
const openModalForm = ref(false)
const heads = ["Invoice", "Date", "Total", ""]
const isLoading = ref(true)

const props = defineProps({
    title: string()
})

const getData = debounce(async (page) => {
    axios.get(route('report.getdata'), {
        params: {
            page: page,
            start_date: filter.value.start_date,
            end_date: filter.value.end_date
        }
    }).then((res) => {
        query.value = res.data.data
        pagination.value = res.data.meta.pagination
    }).catch((res) => {
        notify({
            type: "error",
            group: "top",
            text: res.response.data.message
        }, 2500)
    }).finally(() => isLoading.value = false)
}, 500);

const nextPaginate = () => {
    pagination.value.current_page += 1
    isLoading.value = true
    getData(pagination.value.current_page)
}

const previousPaginate = () => {
    pagination.value.current_page -= 1
    isLoading.value = true
    getData(pagination.value.current_page)
}

const applyFilter = (data) => {
    filter.value = data
    isLoading.value = true
    getData(1)
}

const clearFilter = (data) => {
    filter.value = data
    isLoading.value = true
    getData(1)
}

const handleDetailModal = (data) => {
    itemSelected.value = data
    openModalForm.value = true
}

const closeModalForm = () => {
    itemSelected.value = ref({})
    openModalForm.value = false
}

const handleExportExcel = () => {
    window.open(route('report.exportexcel', { 'start_date': filter.value.start_date, 'end_date': filter.value.end_date }));
}

const handleExportPdf = () => {
    window.open(route('report.exportpdf', { 'start_date': filter.value.start_date, 'end_date': filter.value.end_date }));
}

onMounted(() => {
    getData(1);
});
</script>

<template>

    <Head :title="props.title" />
    <VBreadcrumb :routes="breadcrumb" />
    <div class="mb-4 sm:mb-6 flex justify-between items-center">
        <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Report</h1>
    </div>
    <div class="bg-white shadow-lg rounded-sm border border-slate-200"
        :class="isLoading && 'min-h-[40vh] sm:min-h-[50vh]'">
        <header class="block justify-between items-center sm:flex py-6 px-4">
            <h2 class="font-semibold text-slate-800">
                All Transactions <span class="text-slate-400 !font-medium ml">{{ pagination.total }}</span>
            </h2>
            <div class="mt-3 sm:mt-0 flex space-x-2 sm:justify-between justify-end">
                <!-- Filter -->
                <VFilter @apply="applyFilter" @clear="clearFilter" />
                <VButton label="Export Excel" type="success" @click="handleExportExcel" class="mt-auto" />
                <VButton label="Export Pdf" type="danger" @click="handleExportPdf" class="mt-auto" />
            </div>
        </header>

        <VDataTable :heads="heads" :isLoading="isLoading">
            <tr v-if="isLoading">
                <td class="h-[100%] overflow-hidden my-2" :colspan="heads.length">
                    <VLoading />
                </td>
            </tr>
            <tr v-else-if="query.length === 0 && !isLoading">
                <td class="overflow-hidden my-2" :colspan="heads.length">
                    <div class="flex items-center flex-col w-full my-32">
                        <VEmpty />
                        <div class="mt-9 text-slate-500 text-xl md:text-xl font-medium">Result not found.</div>
                    </div>
                </td>
            </tr>
            <tr v-for="(data, index) in query" :key="index" v-else>
                <td class="px-4 whitespace-nowrap h-16"> {{ data.invoice_code }} </td>
                <td class="px-4 whitespace-nowrap h-16"> {{ data.created_at }} </td>
                <td class="px-4 whitespace-nowrap h-16"> Rp{{ data.grand_total_formatted }} </td>
                <td class="px-4 whitespace-nowrap h-16 text-right">
                    <VDropdownEditMenu class="relative inline-flex r-0" :align="'right'"
                        :last="index === query.length - 1 ? true : false">
                        <li class="cursor-pointer hover:bg-slate-100" @click="handleDetailModal(data)">
                            <div class="flex items-center space-x-2 p-3">
                                <span>
                                    <VDetail color="primary" />
                                </span>
                                <span>Show</span>
                            </div>
                        </li>
                    </VDropdownEditMenu>
                </td>
            </tr>
        </VDataTable>
        <div class="px-4 py-6">
            <VPagination :pagination="pagination" @next="nextPaginate" @previous="previousPaginate" />
        </div>
    </div>
    <VModalForm :data="itemSelected" :open-dialog="openModalForm" @close="closeModalForm"/>
</template>