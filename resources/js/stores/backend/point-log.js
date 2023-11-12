import { defineStore } from "pinia";
import {
    getPointLogFunc
} from "@/api/api.js"
import Swal from "sweetalert2/dist/sweetalert2.js"
import { alert,loading } from '@/swal/default.js'

export const usePointLogStore = defineStore("point-log", {
    state: () => {
        return {
            pointLogData: []
        }
    },
    actions: {
        async fetchPointLog(page, data) {
            try {

                const response = await getPointLogFunc(page, data)
                this.pointLogData = response

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.message,
                })
            }
        }
    }
})