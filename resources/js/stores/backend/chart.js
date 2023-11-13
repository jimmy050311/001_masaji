import { defineStore } from "pinia";
import { 
    getBarChartFunc,
    getPieChartFunc,
} from "@/api/api.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import { alert,loading } from '@/swal/default.js'

export const useChartStore = defineStore("chart", {
    state: () => {
        return {
            xAxis: [],
            totalValue: [],
            piexAxis: [],
            pieValue: [],
        }
    },
    actions: {
        async fetchBarChart() {
            try {
                const response = await getBarChartFunc()
                this.xAxis = response.month_array
                this.totalValue = response.data
                return response
            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.message,
                })
            }
        },
        async fetchPieChart() {
            try {

                const response = await getPieChartFunc()
                this.piexAxis = response.product_array
                this.pieValue = response.data

                return response
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
