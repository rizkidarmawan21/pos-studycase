<script setup>
import axios from "axios";
import { notify } from "notiwind";
import { object } from "vue-types";
import { ref, onMounted } from "vue";
import VInput from '@/components/VInput/index.vue';
import VSelect from '@/components/VSelect/index.vue';
import VButton from '@/components/VButton/index.vue';

const props = defineProps({
    additional: object().def({})
})

const emit = defineEmits(['successSubmit'])

const form = ref({})
const formError = ref({})
const categorySelectHandle = ref()
const productOptions = ref([])
const productPlaceholder = ref('Select Product')
const productSelectHandle = ref()
const productLoading = ref(true)
const isLoading = ref(false)

const categorySelected = () => {
    formError.value.category_id = ''
    productLoading.value = true
    productSelectHandle.value.clearSelected()
    getProductPlaceholder()

    productLoading.value = true
    getProduct()
}

const getProductPlaceholder = () => {
    if (productLoading.value) {
        productPlaceholder.value = 'Loading...';
    } else {
        productPlaceholder.value = 'Select Product';
    }
}

const getProduct = async () => {
    axios.get(route('transaction.getproductdata'), {
        params: {
            category_id: form.value.category_id
        }
    }).then((res) => {
        productOptions.value = res.data
    }).catch((res) => {
        notify({
            type: "error",
            group: "top",
            text: res.response.data.message
        }, 2500)
    }).finally(() => {
        productLoading.value = false
        getProductPlaceholder()
    })
};

const submit = async () => {
    isLoading.value = true
    axios.post(route('transaction.addtocart'), form.value)
        .then((res) => {
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

onMounted(() => {
    getProduct();
});
</script>

<template>
    <div class="w-full md:w-1/3 rounded-lg bg-white px-4 py-6 border drop-shadow-sm h-fit">
        <div class="grid grid-cols-1 gap-3">
            <VSelect placeholder="Select Category" v-model="form.category_id" :options="additional.category_list"
                label="Category" :errorMessage="formError.category_id" @update:modelValue="categorySelected" ref="categorySelectHandle"/>
            <VSelect :placeholder="productPlaceholder" :required="true" v-model="form.product_id" :options="productOptions"
                label="Product" :errorMessage="formError.product_id" @update:modelValue="formError.product_id = ''"
                ref="productSelectHandle" :disabled="productLoading" />
            <VInput placeholder="Input Qty" label="Qty" :required="true" v-model="form.qty"
                :errorMessage="formError.qty" @update:modelValue="formError.qty = ''" type="number" />
        </div>
        <div class="flex flex-wrap justify-end space-x-2 mt-3">
            <VButton :is-loading="isLoading" label="Add to Cart" type="primary" @click="submit" />
        </div>
    </div>
</template>