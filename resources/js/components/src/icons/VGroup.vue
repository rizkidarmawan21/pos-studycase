<script setup>
import { bool } from 'vue-types'

const props = defineProps({
    isActive: bool().def(false)
})
</script>

<template>
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_11285_66552)">
            <path
                d="M10 14.0625C11.7259 14.0625 13.125 12.6634 13.125 10.9375C13.125 9.21161 11.7259 7.8125 10 7.8125C8.27411 7.8125 6.875 9.21161 6.875 10.9375C6.875 12.6634 8.27411 14.0625 10 14.0625Z"
                stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                :class="isActive && '!stroke-blue-500'" />
            <path
                d="M15.3125 9.06251C16.0404 9.06129 16.7586 9.23018 17.4096 9.55572C18.0607 9.88126 18.6267 10.3544 19.0625 10.9375"
                stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                :class="isActive && '!stroke-blue-500'" />
            <path
                d="M0.9375 10.9375C1.37328 10.3544 1.93928 9.88126 2.59036 9.55572C3.24144 9.23018 3.95957 9.06129 4.6875 9.06251"
                stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                :class="isActive && '!stroke-blue-500'" />
            <path
                d="M5.50037 16.875C5.91195 16.0321 6.55199 15.3217 7.34759 14.8248C8.14319 14.3279 9.06235 14.0645 10.0004 14.0645C10.9384 14.0645 11.8575 14.3279 12.6531 14.8248C13.4487 15.3217 14.0888 16.0321 14.5004 16.875"
                stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                :class="isActive && '!stroke-blue-500'" />
            <path
                d="M4.68808 9.0625C4.21359 9.06298 3.74875 8.92842 3.34789 8.67453C2.94703 8.42064 2.62669 8.05792 2.42432 7.62874C2.22195 7.19956 2.1459 6.72165 2.20505 6.25085C2.2642 5.78006 2.45611 5.33581 2.75836 4.97003C3.06061 4.60426 3.46071 4.33205 3.91192 4.18521C4.36313 4.03838 4.84681 4.02298 5.30644 4.14083C5.76607 4.25867 6.18267 4.50489 6.50757 4.85071C6.83247 5.19653 7.05224 5.62767 7.14121 6.09375"
                stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                :class="isActive && '!stroke-blue-500'" />
            <path
                d="M12.86 6.09375C12.949 5.62767 13.1687 5.19653 13.4936 4.85071C13.8185 4.50489 14.2351 4.25867 14.6948 4.14083C15.1544 4.02298 15.6381 4.03838 16.0893 4.18521C16.5405 4.33205 16.9406 4.60426 17.2428 4.97003C17.5451 5.33581 17.737 5.78006 17.7961 6.25085C17.8553 6.72165 17.7792 7.19956 17.5769 7.62874C17.3745 8.05792 17.0542 8.42064 16.6533 8.67453C16.2524 8.92842 15.7876 9.06298 15.3131 9.0625"
                stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                :class="isActive && '!stroke-blue-500'" />
        </g>
        <defs>
            <clipPath id="clip0_11285_66552">
                <rect width="20" height="20" fill="white" />
            </clipPath>
        </defs>
    </svg>


</template>
