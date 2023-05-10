<template>
    <div
        class="col-span-full xl:col-span-6 bg-white shadow-lg rounded-sm border border-slate-200"
    >
        <header class="px-5 py-4 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Best Selling Product</h2>
        </header>
        <div class="p-3">
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <!-- Table header -->
                    <thead
                        class="text-xs uppercase text-slate-400 bg-slate-50 rounded-sm"
                    >
                        <tr>
                            <th class="p-2">
                                <div class="font-semibold text-center">
                                    Product Name
                                </div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">
                                    Category
                                </div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">
                                    Total Sales
                                </div>
                            </th>
                            <th class="p-2">
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
                        <tr>
                            <td class="p-2">
                                <div class="text-center">
                                    TV Elektro Samsung
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="text-center text-emerald-500">
                                    Elektronik
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">267 x</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center text-sky-500">
                                    Rp. 12,000,0000
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script></script>
