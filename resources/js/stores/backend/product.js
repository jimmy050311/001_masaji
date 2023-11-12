import { defineStore } from "pinia";
import {
    getProductFunc,
    createProductFunc,
    getProductDetailFunc,
    editProductFunc,
    editProductLowAmountFunc,
    obtainProductFunc,
} from "@/api/api.js";
import Swal from "sweetalert2/dist/sweetalert2.js"
import { alert,loading } from '@/swal/default.js'

export const useProductStore = defineStore("product", {
    state: () => {
        return {
            productData: [],
        }
    },
    actions: {
        async fetchProduct(page, data) {
            try {

                const response = await getProductFunc(page, data)
                this.productData = response

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.message,
                })
            }
        },
        async fetchCreateProduct(data) {
            try {

                loading().growSpinner.fire({})
                const response = await createProductFunc(data)

                await Swal.fire({
                    icon: 'success',
                    title: '成功',
                    text: response.message,
                })

                return true

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.message,
                })
            }
        },
        async fetchProductDetail(id) {
            try {

                const response = await getProductDetailFunc(id)
                return response.data

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.data.message,
                })
            }
        },
        async fetchEditProduct(id, data) {
            try {

                const response = await editProductFunc(id, data)

                await Swal.fire({
                    icon: 'success',
                    title: '成功',
                    text: response.message,
                })

                return true
            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.message,
                })

                return false
            }
        },
        async fetchEditLowAmount(id, data) {
            try {
                
                loading().growSpinner.fire({})
                const response = await editProductLowAmountFunc(id, data)
                loading().growSpinner.close({})
                await Swal.fire({
                    icon: 'success',
                    title: '成功',
                    text: response.message,
                })
                return response

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.data.message
                })
            }
        },
        async fetchObtainProduct(data) {
            try {

                const response = await obtainProductFunc(data)
                this.productData = response
                return response.data

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.data.message,
                })
            }
        }
    }
})