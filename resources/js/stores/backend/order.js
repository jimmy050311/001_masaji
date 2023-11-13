import { defineStore } from "pinia";
import { 
    getOrderFunc,
    createOrderFunc,
    getOrderDetailFunc,
    editOrderFunc,
} from "@/api/api.js";
import Swal from "sweetalert2/dist/sweetalert2.js"
import { alert,loading } from '@/swal/default.js'

export const useOrderStore = defineStore("order", {
    state: () => {
        return {
            orderData: []
        }
    },
    actions: {
        async fetchOrder(page, data) {
            try {

                const response = await getOrderFunc(page, data)
                this.orderData = response

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.message,
                })
            }
        },
        async fetchCreateOrder(data) {
            try {

                loading().growSpinner.fire({})
                const response = await createOrderFunc(data)

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
        async fetchOrderDetail(id) {
            try {

                const response = await getOrderDetailFunc(id)
                return response.data

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.data.message,
                })
            }
        },
        async fetchEditOrder(id, data) {
            try {

                const response = await editOrderFunc(id, data)
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
        }
    }
})