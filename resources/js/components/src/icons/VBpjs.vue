<script setup>
import { bool } from 'vue-types'

const props = defineProps({
    isActive: bool().def(false)
})
</script>

<template>
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'" d="M11.875 8.75H15" stroke-width="1.5"
            stroke-linecap="round" stroke-linejoin="round" />
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
            d="M11.875 11.25H15" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
            d="M7.19531 11.25C8.23085 11.25 9.07031 10.4105 9.07031 9.375C9.07031 8.33947 8.23085 7.5 7.19531 7.5C6.15978 7.5 5.32031 8.33947 5.32031 9.375C5.32031 10.4105 6.15978 11.25 7.19531 11.25Z"
            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
            d="M4.77344 13.125C4.91113 12.5873 5.22388 12.1106 5.66238 11.7702C6.10089 11.4299 6.64021 11.2451 7.19531 11.2451C7.75042 11.2451 8.28974 11.4299 8.72824 11.7702C9.16675 12.1106 9.4795 12.5873 9.61719 13.125"
            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path class="stroke-slate-400" :class="isActive && '!stroke-blue-500'"
            d="M16.875 3.75H3.125C2.77982 3.75 2.5 4.02982 2.5 4.375V15.625C2.5 15.9702 2.77982 16.25 3.125 16.25H16.875C17.2202 16.25 17.5 15.9702 17.5 15.625V4.375C17.5 4.02982 17.2202 3.75 16.875 3.75Z"
            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>

</template>
