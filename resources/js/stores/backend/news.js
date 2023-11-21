import { defineStore } from "pinia";
import { 
    getNewsFunc, 
    createNewsFunc,
    getNewsDetailFunc,
    editNewsFunc,
    deleteNewsFunc,
} from "@/api/api.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import { alert,loading } from '@/swal/default.js'

export const useNewsStore = defineStore("news", {
    state: () => {
        return {
            newsData: []
        }
    },
    actions: {
        async fetchNews(page, data) {
            try {

                const response = await getNewsFunc(page, data)
                this.newsData = response

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.data.message,
                })
            }
        },
        async fetchCreateNews(data) {
            try {

                loading().growSpinner.fire({})
                const response = await createNewsFunc(data)
                loading().growSpinner.close({})
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
                    text: error.response.data.message,
                })
                return false
            }
        },
        async fetchNewsDetail(id) {
            try {

                loading().growSpinner.fire({})
                const response = await getNewsDetailFunc(id)
                loading().growSpinner.close({})
                return response.data

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.data.message,
                })
            }
        },
        async fetchEditNews(id, data) {
            try {

                loading().growSpinner.fire({})
                const response = await editNewsFunc(id, data)
                loading().growSpinner.close({})
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
                    text: error.response.data.message
                })
                return false
            }
        },
        async fetchDeleteNews(id) {
            try {
                loading().growSpinner.fire({})
                const response = await deleteNewsFunc(id)
                loading().growSpinner.close({})
                await Swal.fire({
                    icon: 'success',
                    title: '成功',
                    text: response.message,
                })

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.data.message
                })
            }
        }
    }
})