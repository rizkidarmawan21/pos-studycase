<script setup>
import { bool } from 'vue-types'

const props = defineProps({
    isActive: bool().def(false)
})
</script>

<template>
    <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="fill-current text-slate-400" :class="isActive && '!text-blue-500'"
            d="M17.6406 4.5375L14.4906 7.5L17.4906 15.75L15.2406 18L10.7594 11.4375L8.4906 13.5V15.75L6.2406 18L4.90935 14.0719L0.990601 12.75L3.2406 10.5H5.4906L7.7406 8.25L0.990601 3.75L3.2406 1.5L11.4906 4.5L14.4625 1.35937L14.3969 1.40625C14.8195 0.983558 15.3928 0.746094 15.9906 0.746094C16.5884 0.746094 17.1617 0.983558 17.5844 1.40625C18.007 1.82894 18.2445 2.40222 18.2445 3C18.2445 3.59777 18.007 4.17106 17.5844 4.59375L17.6406 4.5375Z"
            />
    </svg>
</template>
