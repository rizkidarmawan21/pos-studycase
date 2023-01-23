<script setup>
import axios from "axios";
import { ref } from "vue";
import { bool, object } from "vue-types";
import { notify } from "notiwind";
import VDialog from '@/components/VDialog/index.vue';
import VButton from '@/components/VButton/index.vue';
import VInput from '@/components/VInput/index.vue';
import VSelect from '@/components/VSelect/index.vue';

const props = defineProps({
    openDialog: bool(),
    updateAction: bool().def(false),
    data: object().def({}),
    additional: object().def({})
})

const emit = defineEmits(['close', 'successSubmit'])

const isLoading = ref(false);
const formError = ref({})
const form = ref({})
const previewImage = ref('')

const openForm = () => {
    if (props.updateAction) {
        form.value = Object.assign(form.value, props.data)
        previewImage.value = props.data.preview_image
    } else {
        form.value = ref({})
    }
}

const closeForm = () => {
    form.value = ref({})
    formError.value = ref({})
    if (document.getElementById("productImage")) {
        document.getElementById("productImage").value = null
    }
    previewImage.value = ''
}

const fileSelected = (evt) => {
    formError.value.image = ''
    form.value.image = evt.target.files[0];
    previewImage.value = URL.createObjectURL(evt.target.files[0]);
}

const submit = async () => {
    const fd = new FormData();
    Object.keys(form.value).forEach(key => {
        fd.append(key, form.value[key]);
    })

    props.updateAction ? update(fd) : create(fd)
}

const update = async (fd) => {
    isLoading.value = true
    axios.post(route('product.update', { 'id': props.data.id }), fd)
        .then((res) => {
            emit('close')
            emit('successSubmit')
            form.value = ref({})
            notify({
                type: "success",
                group: "top",
                text: res.data.meta.message
            }, 2500)
        }).catch((res) => {
            // Handle validation errors
            const result = res.response.data
            const metaError = res.response.data.meta?.error
            if (result.hasOwnProperty('errors')) {
                formError.value = ref({});
                Object.keys(result.errors).map((key) => {
                    formError.value[key] = result.errors[key].toString();
                });
            }

            if (metaError) {
                notify({
                    type: "error",
                    group: "top",
                    text: metaError
                }, 2500)
            } else {
                notify({
                    type: "error",
                    group: "top",
                    text: result.message
                }, 2500)
            }
        }).finally(() => isLoading.value = false)
}

const create = async (fd) => {
    isLoading.value = true
    axios.post(route('product.create'), fd)
        .then((res) => {
            emit('close')
            emit('successSubmit')
            form.value = ref({})
            notify({
                type: "success",
                group: "top",
                text: res.data.meta.message
            }, 2500)
        }).catch((res) => {
            // Handle validation errors
            const result = res.response.data
            const metaError = res.response.data.meta?.error
            if (result.hasOwnProperty('errors')) {
                formError.value = ref({});
                Object.keys(result.errors).map((key) => {
                    formError.value[key] = result.errors[key].toString();
                });
            }

            if (metaError) {
                notify({
                    type: "error",
                    group: "top",
                    text: metaError
                }, 2500)
            } else {
                notify({
                    type: "error",
                    group: "top",
                    text: result.message
                }, 2500)
            }
        }).finally(() => isLoading.value = false)
}
</script>

<template>
    <VDialog :showModal="openDialog" :title="updateAction ? 'Update Product' : 'Create Product'" @opened="openForm" @closed="closeForm" size="xl">
        <template v-slot:close>
            <button class="text-slate-400 hover:text-slate-500" @click="$emit('close')">
                <div class="sr-only">Close</div>
                <svg class="w-4 h-4 fill-current">
                    <path
                        d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                </svg>
            </button>
        </template>
        <template v-slot:content>
            <div class="grid grid-cols-2 gap-3">
                <div class="col-span-2">
                    <VInput placeholder="Insert Name" label="Name" :required="true" v-model="form.name" :errorMessage="formError.name"
                        @update:modelValue="formError.name = ''" />
                </div>
                <div class="col-span-2">
                    <VInput placeholder="Insert Description" label="Description" :required="true" v-model="form.description" :errorMessage="formError.description"
                        @update:modelValue="formError.description = ''" />
                </div>
                <VInput placeholder="Insert Price" label="Price" :required="true" v-model="form.price" :errorMessage="formError.price"
                    @update:modelValue="formError.price = ''" type="number"/>
                <VInput placeholder="Insert Stock" label="Stock" :required="true" v-model="form.stock" :errorMessage="formError.stock"
                    @update:modelValue="formError.stock = ''" type="number"/>
                <div class="col-span-2">
                    <VSelect placeholder="Choose Category" :required="true" v-model="form.category_id"
                        :options="additional.category_list" label="Category" :errorMessage="formError.category_id"
                        @update:modelValue="formError.category_id = ''" />
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-slate-600 mb-1" for="productImage">Product Image
                        <span class="text-rose-500" v-if="!updateAction">*</span></label>
                    <img class="w-32 h-32 mb-1" :src="previewImage" v-if="previewImage" />
                    <input class="block w-full cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md"
                        type="file" id="productImage" accept=".jpg, .jpeg, .png" @change="fileSelected">
                    <div class="text-xs mt-1" 
                        :class="[{
                            'text-rose-500': formError.image
                        }]" v-if="formError.image">
                        {{ formError.image }}
                    </div>
                </div>
            </div>
        </template>
        <template v-slot:footer>
            <div class="flex flex-wrap justify-end space-x-2">
                <VButton label="Cancel" type="default" @click="$emit('close')" />
                <VButton :is-loading="isLoading" :label="updateAction ? 'Update' : 'Create'" type="primary" @click="submit" />
            </div>
        </template>
    </VDialog>
</template>