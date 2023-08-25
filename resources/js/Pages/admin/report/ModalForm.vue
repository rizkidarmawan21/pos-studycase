<script setup>
import { bool, object } from "vue-types";
import VDialog from '@/components/VDialog/index.vue';
import VButton from '@/components/VButton/index.vue';
import VDataTable from '@/components/VDataTable/index.vue';
import number_format from "@/composables/formatting"

const heads = ["Product Name", "Price", "Qty", "Sub Total", ""]

const props = defineProps({
    openDialog: bool(),
    data: object().def({})
})

const emit = defineEmits(['close'])
</script>

<template>
    <VDialog :showModal="openDialog" title="Detail Transaction" size="xl">
        <template v-slot:close>
            <button class="text-slate-400 hover:text-slate-500" @click="$emit('close')">
                <div class="sr-only">Close</div>
                <svg class="w-4 h-4 fill-current">
                    <path
                        d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                </svg>
            </button>
        </template>
        <template v-slot:content>
            <!-- Transaction Information -->
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <div class="font-medium text-sm text-slate-600 mb-1">Invoice</div>
                    <div class="font-normal text-sm text-slate-500">{{ data.invoice_code }}</div>
                </div>
                <div>
                    <div class="font-medium text-sm text-slate-600 mb-1">Date</div>
                    <div class="font-normal text-sm text-slate-500">{{ data.created_at }}</div>
                </div>
                <div>
                    <div class="font-medium text-sm text-slate-600 mb-1">Cash</div>
                    <div class="font-normal text-sm text-slate-500">Rp{{ data.cash_formatted }}</div>
                </div>
                <div>
                    <div class="font-medium text-sm text-slate-600 mb-1">Change</div>
                    <div class="font-normal text-sm text-slate-500">Rp{{ data.change_formatted }}</div>
                </div>
                <div>
                    <div class="font-medium text-sm text-slate-600 mb-1">Grand Total</div>
                    <div class="font-normal text-sm text-slate-500">Rp{{ data.grand_total_formatted }}</div>
                </div>
            </div>

            <!-- List Product -->
            <div class="font-semibold text-slate-800 text-base my-4">List Product</div>
            <VDataTable :heads="heads" wrapperClass="!px-0">
                <tr v-for="(data, index) in data.transaction_details" :key="index">
                    <td class="px-4 whitespace-nowrap h-16"> {{ data.product.name }} </td>
                    <td class="px-4 whitespace-nowrap h-16"> Rp{{ number_format(data.product.price, 2, ',', '.') }} </td>
                    <td class="px-4 whitespace-nowrap h-16"> {{ data.qty }} </td>
                    <td class="px-4 whitespace-nowrap h-16"> Rp{{ number_format(data.price, 2, ',', '.') }} </td>
                </tr>
            </VDataTable>
        </template>
        <template v-slot:footer>
            <div class="flex flex-wrap justify-end space-x-2">
                <VButton label="Cancel" type="default" @click="$emit('close')" />
            </div>
        </template>
    </VDialog>
</template>