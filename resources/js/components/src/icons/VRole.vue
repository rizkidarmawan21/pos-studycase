<script setup>
import { bool } from 'vue-types'

const props = defineProps({
    isActive: bool().def(false)
})
</script>

<template>
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_11429_75247)">
            <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
                d="M17.5 10.625V9.0625" stroke-width="1.875" stroke-linecap="round"
                stroke-linejoin="round" />
            <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
                d="M17.4973 10.625L16.0129 10.1406" stroke-width="1.875" stroke-linecap="round"
                stroke-linejoin="round" />
            <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
                d="M17.5005 10.625L16.5786 11.8906" stroke-width="1.875" stroke-linecap="round"
                stroke-linejoin="round" />
            <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
                d="M17.5 10.625L18.4219 11.8906" stroke-width="1.875" stroke-linecap="round"
                stroke-linejoin="round" />
            <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
                d="M17.5 10.625L18.9844 10.1406" stroke-width="1.875" stroke-linecap="round"
                stroke-linejoin="round" />
            <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
                d="M8.4375 12.5C11.0263 12.5 13.125 10.4013 13.125 7.8125C13.125 5.22367 11.0263 3.125 8.4375 3.125C5.84867 3.125 3.75 5.22367 3.75 7.8125C3.75 10.4013 5.84867 12.5 8.4375 12.5Z"
                stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round" />
            <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
                d="M1.73486 15.6259C2.55616 14.647 3.58187 13.8599 4.73991 13.3199C5.89795 12.7799 7.16022 12.5 8.43799 12.5C9.71576 12.5 10.978 12.7799 12.1361 13.3199C13.2941 13.8599 14.3198 14.647 15.1411 15.6259"
                stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round" />
        </g>
        <defs>
            <clipPath id="clip0_11429_75247">
                <rect width="20" height="20" fill="white" />
            </clipPath>
        </defs>
    </svg>
</template>
