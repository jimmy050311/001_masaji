import { defineStore } from "pinia";
import { 
    getEventFunc,
    createEventFunc,
    getEventDetailFunc,
    editEventFunc
} from "@/api/api.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import { alert,loading } from '@/swal/default.js'

export const useEventStore = defineStore("event", {
    state: () => {
        return {
            eventData: [],
        }
    },
    actions: {
        async fetchEvent(page, data) {
            try {

                const response = await getEventFunc(page, data)
                this.eventData = response

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.message,
                })
            }
        },
        async fetchCreateEvent(data) {
            try {

                loading().growSpinner.fire({})
                const response = await createEventFunc(data)

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
        async fetchEventDetail(id) {
            try {

                loading().growSpinner.fire({})
                const response = await getEventDetailFunc(id)
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
        async fetchEditEvent(id, data) {
            try {

                const response = await editEventFunc(id, data)
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