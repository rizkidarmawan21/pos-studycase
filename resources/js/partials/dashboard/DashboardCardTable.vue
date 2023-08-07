<script setup>
import { array } from "vue-types";

const props = defineProps({
    products: array().isRequired,
});
</script>
<template>
    <div
        class="col-span-full bg-white shadow-lg rounded-sm border border-slate-200"
    >
        <header class="px-5 py-4 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Best Selling Product</h2>
        </header>
        <div class="p-3 overflow-y-visible">
            <!-- Table -->
            <div class="overflow-x-auto max-h-[27vh]">
                <table class="table-auto w-full relative">
                    <!-- Table header -->
                    <thead
                        class="text-xs uppercase text-slate-400 bg-slate-50 rounded-sm relative"
                    >
                        <tr>
                            <th class="p-2 fixed-header" width="30%">
                                <div class="font-semibold text-center">
                                    Product Name
                                </div>
                            </th>
                            <th class="p-2 fixed-header">
                                <div class="font-semibold text-center">
                                    Category
                                </div>
                            </th>
                            <th class="p-2 fixed-header">
                                <div class="font-semibold text-center">
                                    Total Sales
                                </div>
                            </th>
                            <th class="p-2 fixed-header">
                                <div class="font-semibold text-center">
                                    Earnings
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody
                        class="text-sm font-medium divide-y divide-slate-100"
                    >
                        <!-- Row -->
                        <tr v-for="(data, index) in products" :key="index">
                            <td class="p-2">
                                <div class="">
                                    {{ data.name }}
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="text-center text-emerald-500">
                                    Elektronik
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">{{ data.total }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center text-sky-500">
                                   Rp. {{ data.earnings_formatted }}
                                </div>
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
