import { defineStore } from "pinia";
import { 
    obtainLevelFunc,
} from "@/api/api.js";
import Swal from "sweetalert2/dist/sweetalert2.js"
import { alert,loading } from '@/swal/default.js'

export const useLevelStore = defineStore("level", {
    state: () => {
        return {
            levelData: []
        }
    },
    actions: {
        async fetchObtainLevel() {
            try {

                const response = await obtainLevelFunc();
                return response.data

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