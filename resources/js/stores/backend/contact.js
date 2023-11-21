import { defineStore } from "pinia"
import { 
    getContactFunc,
    getContactDetailFunc,
    editContactFunc,
} from "@/api/api.js"
import Swal from "sweetalert2/dist/sweetalert2.js"
import { alert,loading } from '@/swal/default.js'

export const useContactStore = defineStore("contact", {
    state: () => {
        return {
            contactData: [],
        }
    },
    actions: {
        async fetchContact(page, data) {
            try {

                const response = await getContactFunc(page, data)
                this.contactData = response
                return response

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.data.message,
                })
            }
        },
        async fetchContactDetail(id) {
            try {

                loading().growSpinner.fire({})
                const response = await getContactDetailFunc(id)
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
        async fetchEditContact(id, data) {
            try {

                loading().growSpinner.fire({})
                const response = await editContactFunc(id, data)
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
                    text: error.response.data.message,
                })
            }
        }
    }
})