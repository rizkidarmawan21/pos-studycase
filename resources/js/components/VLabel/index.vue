<script setup>
import { string,bool} from 'vue-types'
import VTooltip from '@/components/VTooltip/index.vue';

const props = defineProps({
    label: string(),
    placeholder: string().isRequired.def('Input ...'),
    required: bool().def(false),
    tooltip: bool().def(false),
})

</script>

<template>
    <div class="mb-1" :class="{ 'flex items-center': tooltip, 'block': !tooltip }">
        <label class="block text-sm font-medium text-slate-600" :for="placeholder" v-if="label">{{ label }} <span
                class="text-rose-500" v-if="required">*</span> </label>
        <VTooltip size="lg" bg="dark" v-if="tooltip" class="ml-2">
            <slot name="tooltip" />
        </VTooltip>
    </div>
</template>