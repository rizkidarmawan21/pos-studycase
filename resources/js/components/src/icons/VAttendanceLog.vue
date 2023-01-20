<script setup>
import { bool } from 'vue-types'

const props = defineProps({
    isActive: bool().def(false)
})
</script>

<template>
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_11465_79815)">
            <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
                d="M10 17.5C14.1421 17.5 17.5 14.1421 17.5 10C17.5 5.85786 14.1421 2.5 10 2.5C5.85786 2.5 2.5 5.85786 2.5 10C2.5 14.1421 5.85786 17.5 10 17.5Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
                d="M10 6V10.375H14.375"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </g>
        <defs>
            <clipPath id="clip0_11465_79815">
                <rect width="20" height="20" fill="white" />
            </clipPath>
        </defs>
    </svg>
</template>
