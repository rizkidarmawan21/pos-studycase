<script>
export default {
    layout: AppLayout
}
</script>
<script setup>
import axios from "axios";
import { notify } from "notiwind";
import { object, string } from "vue-types";
import { Head, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, reactive, computed, watch } from "vue";
import AppLayout from '@/layouts/apps.vue';
import debounce from "@/composables/debounce"
import number_format from "@/composables/formatting"
import VInput from '@/components/VInput/index.vue';
import VDropdownEditMenu from '@/components/VDropdownEditMenu/index.vue';
import VDataTable from '@/components/VDataTable/index.vue';
import VBreadcrumb from '@/components/VBreadcrumb/index.vue';
import VLoading from '@/components/VLoading/index.vue';
import VButton from '@/components/VButton/index.vue';
import VAlert from '@/components/VAlert/index.vue';
import VEdit from '@/components/src/icons/VEdit.vue';
import VTrash from '@/components/src/icons/VTrash.vue';
import VAddCart from './addCart.vue';
import VModalForm from './ModalForm.vue';

const form = ref({})
const formError = ref({})
const query = ref([])
const grandTotal = ref(0)
const change = ref(0)
const breadcrumb = [
    {
        name: "Dashboard",
        active: false,
        to: route('dashboard.index')
    },
    {
        name: "Transaction",
        active: true,
        to: route('transaction.index')
    },
]
const alertData = reactive({
    headerLabel: '',
    contentLabel: '',
    closeLabel: '',
    submitLabel: '',
})
const itemSelected = ref({})
const openAlert = ref(false)
const openModalForm = ref(false)
const cartHeads = ["Product Name", "Price", "Qty", "Sub Total", ""]
const cartLoading = ref(true)
const changeLoading = ref(true)
const user = computed(() => usePage().props.value.admin_data)

const props = defineProps({
    title: string(),
    additional: object(),
})

const getCartData = debounce(async () => {
    axios.get(route('transaction.getcartdata'))
        .then((res) => {
            query.value = res.data.data
            grandTotal.value = res.data.grand_total
        }).catch((res) => {
            notify({
                type: "error",
                group: "top",
                text: res.response.data.message
            }, 2500)
        }).finally(() => cartLoading.value = false)
}, 500);

const successSubmit = () => {
    cartLoading.value = true
    getCartData()
}

const handleEditQty = (data) => {
    itemSelected.value = data
    openModalForm.value = true
}

const closeModalForm = () => {
    itemSelected.value = ref({})
    openModalForm.value = false
}


const alertDelete = (data) => {
    itemSelected.value = data
    openAlert.value = true
    alertData.headerLabel = 'Are you sure to delete this?'
    alertData.contentLabel = "You won't be able to revert this!"
    alertData.closeLabel = 'Cancel'
    alertData.submitLabel = 'Delete'
}

const closeAlert = () => {
    itemSelected.value = ref({})
    openAlert.value = false
}

const deleteProductFromCart = async () => {
    axios.delete(route('transaction.deletefromcart', { 'id': itemSelected.value.id })
    ).then((res) => {
        notify({
            type: "success",
            group: "top",
            text: res.data.meta.message
        }, 2500)
        openAlert.value = false
        cartLoading.value = true
        getCartData()
    }).catch((res) => {
        notify({
            type: "error",
            group: "top",
            text: res.response.data.message
        }, 2500)
    })
};

const payOrder = async () => {
    axios.post(route('transaction.createorder', {
        'cash': form.value.cash,
        'grand_total': grandTotal.value,
        'change': change.value
    })
    ).then((res) => {
        notify({
            type: "success",
            group: "top",
            text: res.data.meta.message
        }, 2500)
        change.value = 0
        form.value.cash = 0
        cartLoading.value = true
        getCartData()

        // Print note
        setTimeout(() => {
            window.open(route('transaction.printorder', { 'id': res.data.data.id }), '_blank');
        }, 50);
    }).catch((res) => {
        // Handle validation errors
        const result = res.response.data
        const metaError = res.response.data.meta?.error
        if (result.hasOwnProperty('errors')) {
            formError.value = ref({});
            Object.keys(result.errors).map((key) => {
                formError.value[key] = result.errors[key].toString();
            });
        }

        if (metaError) {
            notify({
                type: "error",
                group: "top",
                text: metaError
            }, 2500)
        } else {
            notify({
                type: "error",
                group: "top",
                text: result.message
            }, 2500)
        }
    })
}

const calculateChange = () => {
    changeLoading.value = true
    setTimeout(() => {
        change.value = form.value.cash - grandTotal.value
        changeLoading.value = false
    }, 500);
};

onMounted(() => {
    getCartData();
});
</script>

<template>
    <Head :title="props.title" />
    <VBreadcrumb :routes="breadcrumb" />

    <div class="flex flex-col space-y-3 md:flex-row md:space-x-3 md:space-y-0">
        <!-- Add Cart Component -->
        <VAddCart :additional="additional" @successSubmit="successSubmit" />

        <div class="w-full md:w-2/3">
            <!-- Grand Total -->
            <div class="border rounded bg-white drop-shadow-sm p-3 mb-3">
                <div class="flex justify-between">
                    <p class="my-auto">
                        Grand Total
                    </p>
                    <div v-if="cartLoading" class="w-6">
                        <VLoading />
                    </div>
                    <p v-else>
                        Rp{{ number_format(grandTotal, 2, ',', '.') }}
                    </p>
                </div>
                <div class="flex justify-between" v-if="form.cash">
                    <p class="my-auto">
                        Change
                    </p>
                    <div v-if="changeLoading" class="w-6">
                        <VLoading />
                    </div>
                    <p v-else>
                        Rp{{ number_format(change, 2, ',', '.') }}
                    </p>
                </div>
            </div>
            <!-- Carts Table -->
            <div class="border rounded bg-white drop-shadow-sm p-4">
                <!-- Information Section -->
                <section class="w-full sm:w-1/2">
                    <VInput :placeholder="user.name" label="Cashier" :disabled="true" />
                </section>

                <!-- Cart Table Section -->
                <section class="mt-5">
                    <VDataTable :heads="cartHeads" :isLoading="cartLoading" wrapperClass="!px-0">
                        <tr v-if="cartLoading">
                            <td class="overflow-hidden my-2" :colspan="cartHeads.length">
                                <VLoading />
                            </td>
                        </tr>
                        <tr v-else-if="query.length === 0 && !cartLoading">
                            <td class="overflow-hidden my-2" :colspan="cartHeads.length">
                                <div class="flex items-center flex-col w-full">
                                    <div class="my-2 text-slate-500 text-md font-medium">Result not found.</div>
                                </div>
                            </td>
                        </tr>
                        <tr v-for="(data, index) in query" :key="index" v-else>
                            <td class="px-4 whitespace-nowrap h-16"> {{ data.product.name }} </td>
                            <td class="px-4 whitespace-nowrap h-16"> Rp{{ data.product.price_formatted }} </td>
                            <td class="px-4 whitespace-nowrap h-16"> {{ data.qty }} </td>
                            <td class="px-4 whitespace-nowrap h-16"> Rp{{ data.sub_total_formatted }} </td>
                            <td class="px-4 whitespace-nowrap h-16 text-right">
                                <VDropdownEditMenu class="relative inline-flex r-0" :align="'right'"
                                    :last="index === query.length - 1 ? true : false">
                                    <li class="cursor-pointer hover:bg-slate-100" @click="handleEditQty(data)">
                                        <div class="flex items-center space-x-2 p-3">
                                            <span>
                                                <VEdit color="primary" />
                                            </span>
                                            <span>Edit</span>
                                        </div>
                                    </li>
                                    <li class="cursor-pointer hover:bg-slate-100">
                                        <div class="flex justify-between items-center space-x-2 p-3"
                                            @click="alertDelete(data)">
                                            <span>
                                                <VTrash color="danger" />
                                            </span>
                                            <span>Delete</span>
                                        </div>
                                    </li>
                                </VDropdownEditMenu>
                            </td>
                        </tr>
                    </VDataTable>
                </section>

                <!-- Submit Transaction Section -->
                <section class="mt-5 space-y-3" v-if="query.length > 0 && !cartLoading">
                    <div class="flex justify-end">
                        <VInput placeholder="Insert Cash (Rp)" label="Pay" :required="true" v-model="form.cash"
                            :errorMessage="formError.cash" @update:modelValue="formError.cash = '', calculateChange()"
                            type="number" />
                    </div>
                    <div class="text-end">
                        <VButton label="Pay Order" type="primary" :disabled="!form.cash" @click="payOrder" />
                    </div>
                </section>
            </div>
        </div>
        <VAlert :open-dialog="openAlert" @closeAlert="closeAlert" @submitAlert="deleteProductFromCart" type="danger"
            :headerLabel="alertData.headerLabel" :content-label="alertData.contentLabel" :close-label="alertData.closeLabel"
            :submit-label="alertData.submitLabel" />
        <VModalForm :data="itemSelected" :open-dialog="openModalForm" @close="closeModalForm" @successUpdate="successSubmit"
            :additional="additional" />
       
    </div>
</template>