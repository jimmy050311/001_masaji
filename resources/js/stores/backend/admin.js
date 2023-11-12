import { defineStore } from "pinia";
import { 
    getAdminFunc, 
    createAdminFunc, 
    getAdminDetailFunc, 
    editAdminFunc,
} from "@/api/api.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import { alert,loading } from '@/swal/default.js'

export const useAdminStore = defineStore("admin", {

    state: () => {
        return {
            adminData: [],
        }
    },
    actions: {
        async fetchAdmin(page, data) {
            try {

                const response = await getAdminFunc(page, data)
                this.adminData = response
                
            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.message,
                })
            }
        },
        async fetchCreateAdmin(data) {
            try {
                const response = await createAdminFunc(data)
                this.response = response.data
                await Swal.fire({
                    icon: 'success',
                    title: '成功',
                    text: response.message,
                })
            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.message,
                })
            }
        },
        async fetchAdminDetail(id) {
            try {

                const response = await getAdminDetailFunc(id)
                return response.data
                
            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.data.message,
                })
            }
        },
        async fetchEditAdmin(id, data) {
            try {
                const response = await editAdminFunc(id, data)

                await Swal.fire({
                    icon: 'success',
                    title: '成功',
                    text: response.message,
                })

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.message,
                })
            }
        },
        async fetchEditPassword(id, data) {
            try {

                const response = await editAdminFunc(id, data)
                this.response = response
                await Swal.fire({
                    icon: 'success',
                    title: '成功',
                    text: response.message,
                })

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.data.message,
                })
            }
        },
    }
})