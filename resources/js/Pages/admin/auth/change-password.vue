<script>
import AuthLayout from "@/layouts/auth.vue"
export default {
    layout: AuthLayout,
}
</script>
<script setup>
import axios from "axios";
import { notify } from "notiwind";
import { Inertia } from '@inertiajs/inertia'
import VInput from "@/components/VInput/index.vue";
import VButton from "@/components/VButton/index.vue";
import { reactive, ref } from "vue";
import { string } from "vue-types";
import { Head } from "@inertiajs/inertia-vue3";

const show = ref(false);
const showRetype = ref(false);
const isLoading = ref(false)
const reset = () => {
    isLoading.value = true

    if (form.password !== form.password_confirmation) {
        notify({
            type: "error",
            group: "top",
            text: "Password and password confirmation are not the same"
        }, 2500)
        isLoading.value = false
    } else {
        axios.post(route('resetpassword'), {
            email: props.email,
            token: props.token,
            password: form.password,
            password_confirmation: form.password_confirmation
        }).then((res) => {
            notify({
                type: "success",
                group: "top",
                text: res.data.message
            }, 2500)

            console.log('Yahaha');
            Inertia.visit(route('successreset'))
        }).catch((res) => {
            notify({
                type: "error",
                group: "top",
                text: "Something Wrong, Please try again later"
            }, 2500)
        }).finally(() => isLoading.value = false)
    }
};
const props = defineProps({
    title: string(),
    email: string(),
    token: string(),
})
const form = reactive({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

</script>
<template>

    <Head :title="title"></Head>
    <div class="min-h-screen h-full flex flex-col after:flex-1">
        <div class="flex-1" />
        <div class="max-w-sm mx-auto p-8 w-full border rounded-md shadow-md">
            <h1 class="text-3xl text-slate-800 font-bold mb-6">
                Reset your Password
            </h1>
            <form>
                <div class="space-y-4">
                    <VInput :disabled="true" v-model="form.email" label="Email Address" placeholder="Email Address">
                        <template v-slot:icon>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_10914_84957)">
                                        <path
                                            d="M4 5.45231V4.78564C4 3.72478 4.42143 2.70736 5.17157 1.95722C5.92172 1.20707 6.93913 0.785645 8 0.785645C9.06087 0.785645 10.0783 1.20707 10.8284 1.95722C11.5786 2.70736 12 3.72478 12 4.78564V5.45231H13.3333C13.5101 5.45231 13.6797 5.52255 13.8047 5.64757C13.9298 5.7726 14 5.94217 14 6.11898V14.119C14 14.2958 13.9298 14.4654 13.8047 14.5904C13.6797 14.7154 13.5101 14.7856 13.3333 14.7856H2.66667C2.48986 14.7856 2.32029 14.7154 2.19526 14.5904C2.07024 14.4654 2 14.2958 2 14.119V6.11898C2 5.94217 2.07024 5.7726 2.19526 5.64757C2.32029 5.52255 2.48986 5.45231 2.66667 5.45231H4ZM12.6667 6.78564H3.33333V13.4523H12.6667V6.78564ZM7.33333 10.607C7.07914 10.4602 6.88048 10.2337 6.76816 9.96252C6.65584 9.69135 6.63613 9.3907 6.7121 9.10719C6.78807 8.82367 6.95546 8.57315 7.18832 8.39447C7.42118 8.21579 7.70649 8.11894 8 8.11894C8.29351 8.11894 8.57882 8.21579 8.81168 8.39447C9.04454 8.57315 9.21193 8.82367 9.2879 9.10719C9.36387 9.3907 9.34416 9.69135 9.23184 9.96252C9.11952 10.2337 8.92086 10.4602 8.66667 10.607V12.119H7.33333V10.607ZM5.33333 5.45231H10.6667V4.78564C10.6667 4.0784 10.3857 3.40012 9.88562 2.90003C9.38552 2.39993 8.70724 2.11898 8 2.11898C7.29276 2.11898 6.61448 2.39993 6.11438 2.90003C5.61428 3.40012 5.33333 4.0784 5.33333 4.78564V5.45231Z"
                                            fill="#94A3B8" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_10914_84957">
                                            <rect width="16" height="16" fill="white"
                                                transform="translate(0 0.119141)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                        </template>
                    </VInput>
                    <VInput :type="show ? 'text' : 'password'" placeholder="Password" label="Password"
                        v-model="form.password">
                        <template v-slot:icon>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 cursor-pointer"
                                @click="show = !show">
                                <svg v-if="!show" width="24" height="24" viewBox="0 0 12 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.5 7L10 15.25" stroke="#475569" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M7.51074 12.5123C7.16664 12.8275 6.71645 13.0016 6.2498 12.9998C5.87136 12.9998 5.50179 12.8852 5.18968 12.6712C4.87756 12.4572 4.63751 12.1537 4.50108 11.8008C4.36465 11.4478 4.33823 11.0617 4.42529 10.6935C4.51235 10.3252 4.70882 9.99185 4.98886 9.7373"
                                        stroke="#475569" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M3.71875 8.34082C1.80625 9.30645 1 11.1252 1 11.1252C1 11.1252 2.5 14.5002 6.25 14.5002C7.12871 14.5074 7.99645 14.3049 8.78125 13.9096"
                                        stroke="#475569" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M10.0277 13.0516C11.0496 12.1375 11.4996 11.125 11.4996 11.125C11.4996 11.125 9.99961 7.75001 6.24961 7.75001C5.92451 7.74937 5.59993 7.77603 5.2793 7.8297"
                                        stroke="#475569" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M6.60156 9.2832C7.0003 9.35875 7.36365 9.56195 7.63677 9.86213C7.90989 10.1623 8.07797 10.5432 8.11563 10.9473"
                                        stroke="#475569" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <svg v-else width="24" height="24" viewBox="0 0 12 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 7.625C2.25 7.625 0.75 11 0.75 11C0.75 11 2.25 14.375 6 14.375C9.75 14.375 11.25 11 11.25 11C11.25 11 9.75 7.625 6 7.625Z"
                                        stroke="#475569" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M6 12.875C7.03553 12.875 7.875 12.0355 7.875 11C7.875 9.96447 7.03553 9.125 6 9.125C4.96447 9.125 4.125 9.96447 4.125 11C4.125 12.0355 4.96447 12.875 6 12.875Z"
                                        stroke="#475569" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </template>
                    </VInput>
                    <VInput :type="showRetype ? 'text' : 'password'" placeholder="Confirm Password"
                        label="Confirm Password" v-model="form.password_confirmation">
                        <template v-slot:icon>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 cursor-pointer"
                                @click="showRetype = !showRetype">
                                <svg v-if="!showRetype" width="24" height="24" viewBox="0 0 12 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.5 7L10 15.25" stroke="#475569" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M7.51074 12.5123C7.16664 12.8275 6.71645 13.0016 6.2498 12.9998C5.87136 12.9998 5.50179 12.8852 5.18968 12.6712C4.87756 12.4572 4.63751 12.1537 4.50108 11.8008C4.36465 11.4478 4.33823 11.0617 4.42529 10.6935C4.51235 10.3252 4.70882 9.99185 4.98886 9.7373"
                                        stroke="#475569" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M3.71875 8.34082C1.80625 9.30645 1 11.1252 1 11.1252C1 11.1252 2.5 14.5002 6.25 14.5002C7.12871 14.5074 7.99645 14.3049 8.78125 13.9096"
                                        stroke="#475569" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M10.0277 13.0516C11.0496 12.1375 11.4996 11.125 11.4996 11.125C11.4996 11.125 9.99961 7.75001 6.24961 7.75001C5.92451 7.74937 5.59993 7.77603 5.2793 7.8297"
                                        stroke="#475569" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M6.60156 9.2832C7.0003 9.35875 7.36365 9.56195 7.63677 9.86213C7.90989 10.1623 8.07797 10.5432 8.11563 10.9473"
                                        stroke="#475569" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <svg v-else width="24" height="24" viewBox="0 0 12 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 7.625C2.25 7.625 0.75 11 0.75 11C0.75 11 2.25 14.375 6 14.375C9.75 14.375 11.25 11 11.25 11C11.25 11 9.75 7.625 6 7.625Z"
                                        stroke="#475569" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M6 12.875C7.03553 12.875 7.875 12.0355 7.875 11C7.875 9.96447 7.03553 9.125 6 9.125C4.96447 9.125 4.125 9.96447 4.125 11C4.125 12.0355 4.96447 12.875 6 12.875Z"
                                        stroke="#475569" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </template>
                    </VInput>
                </div>
                <div class="flex mt-6 justify-end">
                    <VButton label="Reset Password" :is-loading="isLoading" @click="reset" />
                </div>
            </form>
        </div>
    </div>
</template>


