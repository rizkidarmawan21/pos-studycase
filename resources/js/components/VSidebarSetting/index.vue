<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import VProfile from "@/components/src/icons/VProfile.vue";
import VNpwp from "@/components/src/icons/VNpwp.vue";
import VDesignation from "@/components/src/icons/VDesignation.vue";
import VMapsPin from "@/components/src/icons/VMapsPin.vue";
import VEmploymentStatus from "@/components/src/icons/VEmploymentStatus.vue";
import VGroup from "@/components/src/icons/VGroup.vue";
import VBpjs from "@/components/src/icons/VBpjs.vue";
import VBook from "@/components/src/icons/VBook.vue";
import VList from "@/components/src/icons/VList.vue";
import VGeneral from "@/components/src/icons/VGeneral.vue";
import VMoney from "@/components/src/icons/VMoney.vue";
import VSystemGeneral from "@/components/src/icons/VSystemGeneral.vue";
import VAuthentication from "@/components/src/icons/VAuthentication.vue";
import VGear from "@/components/src/icons/VGear.vue";
import VRole from "@/components/src/icons/VRole.vue";
import VCalendar from "@/components/src/icons/VCalendar.vue";
import VAttendance from "@/components/src/icons/VAttendance.vue";
import VAttendanceLog from "@/components/src/icons/VAttendanceLog.vue";
import VDetailInformation from "@/components/src/icons/VDetailInformation.vue";
import { array } from "vue-types";

// List Icon Used
const icons = {
    VProfile,
    VNpwp,
    VMapsPin,
    VBook,
    VDesignation,
    VGroup,
    VEmploymentStatus,
    VBpjs,
    VList,
    VGeneral,
    VMoney,
    VSystemGeneral,
    VAuthentication,
    VCalendar,
    VGear,
    VRole,
    VAttendance,
    VDetailInformation,
    VAttendanceLog
}

const props = defineProps({
    module: array().isRequired
})

const getUrlPathName = (route) => {
    return new URL(route).pathname;
};
</script>

<template>
    <div
        class="flex flex-nowrap overflow-x-scroll no-scrollbar md:block md:overflow-auto px-3 py-6 border-b md:border-b-0 md:border-r border-slate-200 min-w-60 md:space-y-3">
        <div>
            <ul class="flex flex-nowrap md:block mr-3 md:mr-0">
                <div v-for="(route, index) in module" :key="index">
                    <div v-if="route.header" class="mb-4">
                        <li class="last:mb-0 rounded">
                            <span class="text-sm font-semibold text-slate-500">{{ route.text }}</span>
                        </li>
                    </div>
                    <Link :href="route.url" v-else>
                    <li class="mb-[18px] last:mb-0 rounded">
                        <div class="flex items-center px-2.5 py-2 whitespace-nowrap rounded"
                            :class="$page.url.split('/')[4] === getUrlPathName(route.url).split('/')[4] && 'bg-indigo-50'">
                            <component :is="icons[route.icon]"
                                :isActive="$page.url.split('/')[4] === getUrlPathName(route.url).split('/')[4]" />
                            <span class="text-sm font-medium text-slate-600 ml-4"
                                :class="$page.url.split('/')[4] === getUrlPathName(route.url).split('/')[4] ? 'text-blue-500' : 'hover:text-slate-700'">{{
                                        route.text
                                }}</span>
                        </div>
                    </li>
                    </Link>
                </div>
            </ul>
        </div>
    </div>
</template>