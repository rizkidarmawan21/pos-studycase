<script setup>
import { bool } from 'vue-types'

const props = defineProps({
    isActive: bool().def(false)
})
</script>

<template>
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
            d="M10 17.5C14.1421 17.5 17.5 14.1421 17.5 10C17.5 5.85786 14.1421 2.5 10 2.5C5.85786 2.5 2.5 5.85786 2.5 10C2.5 14.1421 5.85786 17.5 10 17.5Z"
            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
            d="M10 12.5C11.7259 12.5 13.125 11.1009 13.125 9.375C13.125 7.64911 11.7259 6.25 10 6.25C8.27411 6.25 6.875 7.64911 6.875 9.375C6.875 11.1009 8.27411 12.5 10 12.5Z"
            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
            d="M4.98438 15.5781C5.45462 14.6519 6.17216 13.874 7.05745 13.3306C7.94275 12.7872 8.96123 12.4995 10 12.4995C11.0388 12.4995 12.0572 12.7872 12.9425 13.3306C13.8278 13.874 14.5454 14.6519 15.0156 15.5781"
            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</template>
