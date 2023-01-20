<script setup>
import { bool, string } from 'vue-types'

const props = defineProps({
    isActive: bool().def(false),
    color: string().def('primary')
})
</script>

<template>
    <font-awesome-icon icon="fa-solid fa-gear" class="w-5 h-5" :class="{ 
        '!text-blue-500': isActive, 
        'text-slate-400': color === 'primary',
        'text-amber-500': color === 'warning'
    }"/>
</template>
 