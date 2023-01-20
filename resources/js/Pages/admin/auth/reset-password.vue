<script>
import AuthLayout from "@/layouts/auth.vue"
export default {
    layout: AuthLayout,
}
</script>
<script setup>
import axios from "axios";
import { notify } from "notiwind";
import { Link } from "@inertiajs/inertia-vue3";
import VInput from "@/components/VInput/index.vue";
import VButton from "@/components/VButton/index.vue";
import { string } from "vue-types";
import { reactive, ref } from "vue";

const form = reactive({})
const isLoading = ref(false)
const reset = () => {
    isLoading.value = true
    axios.post(route('sendresetlinkemail'), form).then((res) => {
        notify({
            type: "success",
            group: "top",
            text: res.data.message
        }, 2500)
    }).catch((res) => {
        notify({
            type: "error",
            group: "top",
            text: res.response.data.message
        }, 2500)
    }).finally(() => isLoading.value = false)
};

const props = defineProps({
    title: string()
})
</script>

<template>
    <div class="min-h-screen h-full flex flex-col after:flex-1">
        <div class="flex-1" />
        <div class="max-w-sm mx-auto p-8 w-full border rounded-md shadow-md">
            <h1 class="text-3xl text-slate-800 font-bold mb-6">
                Reset your Password
            </h1>
            <form>
                <div class="space-y-4">
                    <VInput label="Email Address" placeholder="Insert Email Address" v-model="form.email" type="email" />
                </div>
                <div class="flex justify-between items-center mt-6">
                    <div class="text-sm">
                        <Link class="font-medium text-primary hover:text-primary-hover" :href="route('login')">Back to Log in</Link>
                    </div>
                    <VButton label="Send Reset Link" @click="reset" :is-loading="isLoading" />
                </div>
            </form>
        </div>
    </div>
</template>

