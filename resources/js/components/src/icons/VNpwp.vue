<script setup>
import { bool } from 'vue-types'

const props = defineProps({
    isActive: bool().def(false)
})
</script>

<template>
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
            d="M17.5 4.375H2.5C2.15482 4.375 1.875 4.65482 1.875 5V15C1.875 15.3452 2.15482 15.625 2.5 15.625H17.5C17.8452 15.625 18.125 15.3452 18.125 15V5C18.125 4.65482 17.8452 4.375 17.5 4.375Z"
            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'" 
            d="M1.875 7.57031H18.125" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</template>
