import { defineStore } from "pinia";
import {
    getPointFunc,
    getPointDetailFunc,
    editPointFunc,
} from "@/api/api.js"
import Swal from "sweetalert2/dist/sweetalert2.js"
import { alert,loading } from '@/swal/default.js'

export const usePointStore = defineStore("point", {
    state: () => {
        return {
            pointData: []
        }
    },
    actions: {
        async fetchPoint(page, data) {
            try {

                const response = await getPointFunc(page, data)
                this.pointData = response

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.message,
                })
            }
        },
        async fetchPointDetail(id) {
            try {

                const response = await getPointDetailFunc(id)
                return response.data

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.data.message,
                })
            }
        },
        async fetchEditPoint(id, data) {
            try {

                const response = await editPointFunc(id, data)
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