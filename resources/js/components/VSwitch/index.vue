<script setup>
import { bool, string, oneOf } from "vue-types";
import VTooltip from '@/components/VTooltip/index.vue';

const props = defineProps({
    modelValue: bool(),
    label: string(),
    tooltip: bool().def(false),
    type: oneOf(['inline', 'block', 'default']).def('default'),
    id: string().def('')
});
const emit = defineEmits(["update:modelValue"]);
const updateValue = (event) => {
    emit("update:modelValue", event.target.checked);
};
</script>

<template>
    <div class="flex" v-if="type === 'inline'">
        <div class="form-switch">
            <input type="checkbox" :id="label + id" class="sr-only" @change="updateValue" :checked="modelValue" />
            <label class="bg-slate-400" :for="label + id">
                <span class="bg-white shadow-sm" aria-hidden="true"></span>
                <span class="sr-only">Enable smart sync</span>
            </label>
        </div>
        <div class="ml-2" :class="{'flex items-center' : tooltip, 'block' : !tooltip}">
            <div class="text-sm font-medium text-slate-600">{{label}}</div>
            <VTooltip size="lg" v-if="tooltip" class="ml-1">
                <slot name="tooltip" />
            </VTooltip>
        </div>
    </div>

    <div class="block" v-else-if="type === 'block'">
        <div class="mb-1" :class="{'flex items-center' : tooltip, 'block' : !tooltip}">
            <div class="text-sm font-medium text-slate-600">{{label}}</div>
            <VTooltip size="lg" v-if="tooltip" class="ml-1">
                <slot name="tooltip" />
            </VTooltip>
        </div>
        <div class="form-switch">
            <input type="checkbox" :id="label" class="sr-only" @change="updateValue" :checked="modelValue" />
            <label class="bg-slate-400" :for="label">
                <span class="bg-white shadow-sm" aria-hidden="true"></span>
                <span class="sr-only">Enable smart sync</span>
            </label>
        </div>
    </div>
   
    <div class="form-switch" v-else>
        <input type="checkbox" :id="label" class="sr-only" @change="updateValue" :checked="modelValue" />
        <label class="bg-slate-400" :for="label">
            <span class="bg-white shadow-sm" aria-hidden="true"></span>
            <span class="sr-only">Enable smart sync</span>
        </label>
    </div>
</template>