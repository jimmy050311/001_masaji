import { defineStore } from "pinia";
import { 
    getCouponFunc,
    createCouponFunc,
    getCouponDetailFunc,
    editCouponFunc,
} from "@/api/api.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import { alert,loading } from '@/swal/default.js'

export const useCouponStore = defineStore("coupon", {
    state: () => {
        return {
            couponData: [],
        }
    },
    actions: {
        async fetchCoupon(page, data) {
            try {

                const response = await getCouponFunc(page, data)
                this.couponData = response

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.message,
                })
            }
        },
        async fetchCreateCoupon(data) {
            try {

                loading().growSpinner.fire({})
                const response = await createCouponFunc(data)

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
        async fetchCouponDetail(id) {
            try {

                loading().growSpinner.fire({})
                const response = await getCouponDetailFunc(id)
                await loading().growSpinner.close({})

                return response.data
            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.message,
                })
            }
        },
        async fetchEditCoupon(id, data) {
            try {

                const response = await editCouponFunc(id, data)
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