<script setup>
import { bool } from 'vue-types'

const props = defineProps({
    isActive: bool().def(false)
})
</script>

<template>
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_11285_66533)">
            <path d="M11.875 8.75H15" stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round"
                stroke-linejoin="round" :class="isActive && '!stroke-blue-500'" />
            <path d="M11.875 11.25H15" stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round"
                stroke-linejoin="round" :class="isActive && '!stroke-blue-500'" />
            <path
                d="M7.19794 11.25C8.23347 11.25 9.07294 10.4105 9.07294 9.375C9.07294 8.33947 8.23347 7.5 7.19794 7.5C6.1624 7.5 5.32294 8.33947 5.32294 9.375C5.32294 10.4105 6.1624 11.25 7.19794 11.25Z"
                stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" :class="isActive && '!stroke-blue-500'" />
            <path
                d="M4.77606 13.124C4.91375 12.5863 5.2265 12.1096 5.66501 11.7693C6.10351 11.4289 6.64283 11.2441 7.19794 11.2441C7.75304 11.2441 8.29236 11.4289 8.73087 11.7693C9.16937 12.1096 9.48212 12.5863 9.61981 13.124"
                stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" :class="isActive && '!stroke-blue-500'" />
            <path
                d="M16.875 3.75H3.125C2.77982 3.75 2.5 4.02982 2.5 4.375V15.625C2.5 15.9702 2.77982 16.25 3.125 16.25H16.875C17.2202 16.25 17.5 15.9702 17.5 15.625V4.375C17.5 4.02982 17.2202 3.75 16.875 3.75Z"
                stroke="#94A3B8" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" :class="isActive && '!stroke-blue-500'" />
        </g>
        <defs>
            <clipPath id="clip0_11285_66533">
                <rect width="20" height="20" fill="white" />
            </clipPath>
        </defs>
    </svg>

</template>
