<script setup>
import { bool } from 'vue-types'

const props = defineProps({
    isActive: bool().def(false)
})
</script>

<template>

    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_11285_66841)">
            <path
                d="M10 12.5C11.7259 12.5 13.125 11.1009 13.125 9.375C13.125 7.64911 11.7259 6.25 10 6.25C8.27411 6.25 6.875 7.64911 6.875 9.375C6.875 11.1009 8.27411 12.5 10 12.5Z"
                stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                :class="isActive && '!stroke-blue-500'" />
            <path
                d="M4.98456 15.5786C5.4548 14.6524 6.17234 13.8744 7.05764 13.331C7.94294 12.7876 8.96142 12.5 10.0002 12.5C11.0389 12.5 12.0574 12.7876 12.9427 13.331C13.828 13.8744 14.5456 14.6524 15.0158 15.5786"
                stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                :class="isActive && '!stroke-blue-500'" />
            <path d="M15.625 10L17.5 11.875L19.375 10" stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round"
                stroke-linejoin="round" :class="isActive && '!stroke-blue-500'" />
            <path d="M0.625 10L2.5 8.125L4.375 10" stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round"
                stroke-linejoin="round" :class="isActive && '!stroke-blue-500'" />
            <path
                d="M17.5002 11.8754V10.0004C17.502 8.37996 16.9789 6.80255 16.0092 5.50427C15.0396 4.20598 13.6755 3.25665 12.1213 2.79837C10.567 2.3401 8.90614 2.39753 7.38724 2.96207C5.86835 3.52661 4.57314 4.5679 3.6955 5.93006"
                stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                :class="isActive && '!stroke-blue-500'" />
            <path
                d="M2.5 8.125V10C2.49824 11.6204 3.02132 13.1978 3.99096 14.4961C4.9606 15.7944 6.32464 16.7437 7.8789 17.202C9.43317 17.6603 11.094 17.6028 12.6129 17.0383C14.1318 16.4738 15.427 15.4325 16.3047 14.0703"
                stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                :class="isActive && '!stroke-blue-500'" />
        </g>
        <defs>
            <clipPath id="clip0_11285_66841">
                <rect width="20" height="20" fill="white" />
            </clipPath>
        </defs>
    </svg>


</template>
