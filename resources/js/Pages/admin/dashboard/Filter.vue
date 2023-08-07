<script setup>
import { ref } from "vue"
import dayjs from "dayjs"
import { any } from "vue-types";
import VFilter from '@/components/VFilter/index.vue';

const filter = ref({})

const props = defineProps({
    additional: any()
})

const handleDateRange = () => {
    const dateStart = new Date(filter.value.date[0].getFullYear(), filter.value.date[0].getMonth(), filter.value.date[0].getDate())
    const dateEnd = new Date(filter.value.date[1].getFullYear(), filter.value.date[1].getMonth(), filter.value.date[1].getDate())

    filter.value.start_date = dayjs(dateStart).format('YYYY-MM-DD')
    filter.value.end_date = dayjs(dateEnd).format('YYYY-MM-DD')
}

const applyFilter = () => {
    emit('apply', filter.value)
}

const clearFilter = () => {
    filter.value = ref({})
    emit('clear', filter.value)
}

const emit = defineEmits(['apply', 'clear'])
</script>

<template>
    <!-- Filter Section -->
    <VFilter align="right" @apply="applyFilter" @clear="clearFilter">
        <div class="grid grid-cols-1 gap-3 px-4 pb-4 pt-1.5">
            <div>
                <div class="text-xs font-semibold text-slate-400 uppercase mb-1">Filter by Date</div>
                <Datepicker v-model="filter.date" @update:modelValue="handleDateRange" range :partial-range="false"
                    :enableTimePicker="false" position="left" :clearable="false" format="dd MMMM yyyy" previewFormat="dd MMMM yyyy"
                    placeholder="Select Date Range"/>
            </div>
        </div>
    </VFilter>
</template>