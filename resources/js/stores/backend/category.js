import { defineStore } from "pinia";
import { 
    getCategoryFunc, 
    editCategoryFunc, 
    createCategoryFunc, 
    getCategoryDetailFunc, 
    deleteCategoryFunc } from "@/api/api.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import { alert,loading } from '@/swal/default.js'

export const useCategoryStore = defineStore("category", {
    state: () => {
        return {
            categoryData: [],
        }
    },
    actions: {
        async fetchCategory() {
            try {
                const arr = []
                const response = await getCategoryFunc()
                response.data.forEach(function(item, index) {
                    if(item.parent === 0) {
                        arr.push({
                            label: item.name,
                            key: item.id,
                            image: item.image,
                            //children: [], (多層)
                            children: null
                        })
                        response.data.forEach(function(val) {
                            if(val.parent === item.id) {
                                arr[arr.length-1].children.push({
                                    label: val.name,
                                    key: val.id,
                                    image: item.image,
                                    children: null
                                })
                            }
                        })
                    }
                })
                this.categoryData = arr

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error,
                })
            }
        },
        async fetchCategoryOriginal() {
            const response = await getCategoryFunc()
            this.categoryData = response.data
        },
        async fetchCreateCategory(postData) {
            try {

                const response = await createCategoryFunc(postData)
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
        async fetchEditCategory(data) {
            try {
                const postData = []
                await JSON.parse(JSON.stringify(data.value)).forEach(async function(val, index) {
                    postData.push({
                        id: val.key,
                        name: val.label,
                        image: val.image,
                        status: 1,
                        parent: 0,
                        sort: index
                    })
                    //多層才用
                    // JSON.parse(JSON.stringify(val['children'])).forEach(async function(item, i) {
                    //     postData.push({
                    //         id: item.key,
                    //         name: item.label,
                    //         image: item.image,
                    //         status: 1,
                    //         parent: val.key,
                    //         sort: i
                    //     })
                    // })
                })
                loading().growSpinner.fire({})

                //0 => 全部清除並全部重新建立
                const response = editCategoryFunc(0, postData).then((response) => {
                    loading().growSpinner.close({})
                    Swal.fire({
                        icon: 'success',
                        title: '成功',
                        text: response.message,
                    })
                })

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error,
                })
            }
        },
        async fetchGetCategoryDetail(id) {
            try {

                const response = await getCategoryDetailFunc(id)
                return response.data

            }catch(error) {
                await Swal.fire({
                    icon: 'error',
                    title: '錯誤',
                    text: error.response.data.message,
                })
            }
        },
        async fetchEditCategoryDetail(id, postData) {
            try {

                const response = await editCategoryFunc(id, postData)
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
        async fetchDeleteCategory(id) {
            try {

                const response = await deleteCategoryFunc(id)
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