import { defineStore } from "pinia"
import {
    getInventoryFunc,
    createInventoryFunc,
} from "@/api/api.js"
import Swal from "sweetalert2/dist/sweetalert2.js"
import { alert,loading } from '@/swal/default.js'

export const useInventoryStore = defineStore("inventory", {
    state: () => {
        return {
            inventoryData: []
        }
    },
    actions: {
        async fetchInventory(page, data) {
            try {

                const response = await getInventoryFunc(page, data)
                this.inventoryData = response
                console.log(this.inventoryData)
            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.data.message,
                })
            }
        },
        async fetchCreateInventory(data) {
            try {

                loading().growSpinner.fire({})
                const response = await createInventoryFunc(data)
                await loading().growSpinner.close({})
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
        }
    }
})