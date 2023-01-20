<script setup>
import { bool, string } from "vue-types";

const props = defineProps({
    modelValue: bool(),
    label: string()
});
const emit = defineEmits(["update:modelValue"]);
const updateValue = (event) => {
    emit("update:modelValue", event.target.checked);
};
</script>

<template>
    <label class="flex items-center">
        <input
            type="checkbox"
            class="form-checkbox"
            @change="updateValue"
            :checked="modelValue"
        />
        <span v-if="label" class="text-sm text-slate-600 ml-2">{{ label }}</span>
    </label>
</template>