import { defineStore } from "pinia";
import { 
    getUserFunc, 
    createUserFunc, 
    getUserDetailFunc, 
    editUserFunc,
    editUserPasswordFunc,
} from "@/api/api.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import { alert,loading } from '@/swal/default.js'

export const useUserStore = defineStore("user", {
    state: () => {
        return {
            userData: [],
        }
    },
    actions: {
        async fetchUser(page, data) {
            try {

                const response = await getUserFunc(page, data)
                this.userData = response

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.message,
                })
            }
        },
        async fetchCreateUser(data) {
            try {

                loading().growSpinner.fire({})
                const response = await createUserFunc(data)

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
        async fetchUserDetail(id) {
            try {

                const response = await getUserDetailFunc(id)
                return response.data

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.data.message,
                })
            }
        },
        async fetchEditUser(id, data) {
            try {

                const response = await editUserFunc(id, data)
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
        async fetchEditUserPassword(id, data) {
            try {

                loading().growSpinner.fire({})
                const response = await editUserPasswordFunc(id, data)
                await loading().growSpinner.close({})
                
                await Swal.fire({
                    icon: 'success',
                    title: '成功',
                    text: response.message,
                })

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error,
                })
            }
        },
    }
})