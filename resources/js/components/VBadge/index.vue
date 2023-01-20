<script setup>
import { oneOf, string, any } from 'vue-types'

const props = defineProps({
    text: string(),
    size: oneOf(['xs','sm']).def('sm'),
    color: oneOf(['primary', 'danger', 'success', 'default', 'warning', 'primary-solid', 'yellow-solid', 'pink-solid', 'amber-solid', 'red-solid', 'cyan-solid']).def('primary'),
    icon: any()
})

const emit = defineEmits(['click'])
</script>

<template>
    <div class="inline-flex font-medium rounded-full text-center px-2.5 py-1"
    :class="[
        { 'text-xs': size === 'xs' },
        { 'text-sm': size === 'sm'},
        { 'bg-sky-100 text-sky-600': color === 'primary'},
        { 'bg-emerald-100 text-emerald-600': color === 'success' },
        { 'bg-amber-100 text-amber-600': color === 'warning' },
        { 'bg-rose-100 text-rose-600': color === 'danger' },
        { 'bg-slate-100 text-slate-500': color === 'default' },
        { 'bg-blue-500 text-white font-medium': color === 'primary-solid'},
        { 'bg-yellow-400 text-white font-medium': color === 'yellow-solid'},
        { 'bg-pink-500 text-white font-medium': color === 'pink-solid'},
        { 'bg-amber-500 text-white font-medium': color === 'amber-solid'},
        { 'bg-red-500 text-white font-medium': color === 'red-solid'},
        { 'bg-cyan-600 text-white font-medium': color === 'cyan-solid'}
    ]"> 
    <component :is="icon" v-if="icon" class="my-auto mr-1" />{{ text }} </div>
</template>