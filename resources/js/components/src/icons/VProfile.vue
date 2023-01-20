<script setup>
import { bool } from 'vue-types'

const props = defineProps({
    isActive: bool().def(false)
})
</script>

<template>
    <svg class="shrink-0 h-6 w-6" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'" 
            d="M1.25 16.875H18.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
            d="M11.25 16.875V3.125C11.25 2.95924 11.1842 2.80027 11.0669 2.68306C10.9497 2.56585 10.7908 2.5 10.625 2.5H3.125C2.95924 2.5 2.80027 2.56585 2.68306 2.68306C2.56585 2.80027 2.5 2.95924 2.5 3.125V16.875"
            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
            d="M17.5 16.875V8.125C17.5 7.95924 17.4342 7.80027 17.3169 7.68306C17.1997 7.56585 17.0408 7.5 16.875 7.5H11.25"
         stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'" 
            d="M5 5.625H7.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'" 
            d="M6.25 10.625H8.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'" 
            d="M5 13.75H7.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
            d="M13.75 13.75H15" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
            d="M13.75 10.625H15" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>

</template>
