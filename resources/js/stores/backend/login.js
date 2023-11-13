import { defineStore } from "pinia"
import { loginFunc, logoutFunc } from "@/api/api.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import { alert,loading } from '@/swal/default.js'

export const useLoginStore = defineStore("login", {
    state: () => {

    },
    actions: {
        async fetchLogin(postData) {
            try {
                loading().growSpinner.fire({})
                const response = await loginFunc(postData)
                await loading().growSpinner.close({})

                return response
            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.data.message,
                })
            }
        },
        async fetchLogout() {
            try {
                loading().growSpinner.fire({})
                const response = await logoutFunc()
                await loading().growSpinner.close({})

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