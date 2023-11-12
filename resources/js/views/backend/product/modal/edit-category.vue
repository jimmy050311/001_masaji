<template lang="">
    <div id="editCategoryModal" ref="editModalRef" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">編輯類別</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label col-form-label">類別圖片(必填)</label>
                            </div>
                            <div class="col-md-9">
                                <ImgUpload :imageList="imageData" :maxLimit=1 :maxSize=0.5 blockClass="col-md-12"></ImgUpload>
                                <div class="invalid-feedback">
                                    ※上傳作品照片，第一張照片為主圖，可拖拉移動(建議上傳JPG檔案，大小建議200kb以內，以最多5張照片為上限)。
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label class="form-label col-form-label">名稱(必填)</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" v-model="categoryData.name" placeholder="請輸入類別名稱" autocomplete="off" style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" v-if="true" @click="del()">刪除</button>
                    <button type="button" class="btn btn-default" @click="hideModal()">關閉</button>
                    <button type="button" class="btn btn-primary" @click="submit()">確認送出</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { Modal } from 'bootstrap'
    import { ref, watch, reactive } from 'vue'
    import { NImage, NModal, NUpload } from "naive-ui"
    import { useCategoryStore } from "@/stores/backend/category.js"
    import { useRouter } from "vue-router"
    import Swal from "sweetalert2/dist/sweetalert2.js"
    import ImgUpload from '@/components/imageUpload/default.vue'

    const router = useRouter()
    const imageData = ref([])
    const categoryStore = useCategoryStore()
    const categoryData = reactive({
        name: '',
        status: '',
        parent: '',
        sort: '',
    })
    var modalInstance = ref()

    const props = defineProps({
        isShow: {
            type: Boolean,
            default: false
        },
        id: {
            type: Number,
            default: 0
        },
    })

    const emit = defineEmits(['closeModal'])

    watch(() => props.isShow, (newVal, oldVal) => {
        imageData.value = []
        categoryStore.fetchGetCategoryDetail(props.id).then((response) => {
            console.log(response)
            imageData.value.push({
                image: response.image
            })
            categoryData.name = response.name
            categoryData.status = response.status
            categoryData.parent = response.parent
            categoryData.sort = response.sort
            if(newVal === true) {
                showModal()
            }
        })
    })

    function showModal() {
        modalInstance = new Modal(document.getElementById('editCategoryModal'), {
            target: "#edit-category-modal",
            backdrop: "static"
        })
        modalInstance.show()
    }

    function hideModal() {
        modalInstance.hide()
        emit('closeModal', false)
    }

    function submit() {
        var postData = {
            name: categoryData.name,
            image: imageData.value,
            status: categoryData.status,
            parent: categoryData.parent,
            sort: categoryData.sort
        }
        categoryStore.fetchEditCategoryDetail(props.id, postData).then(() => {
            window.location.reload()
        })
        hideModal()
    }

    function del() {
        Swal.fire({
            icon: 'info',
            title: '確定要刪除嗎？刪除後將無法回復此類別!',
            showCancelButton: true,
            confirmButtonText: '確定',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            categoryStore.fetchDeleteCategory(props.id).then(() => {
                categoryStore.fetchCategory()
            })
          }
        })
        
        hideModal()
    }
</script>
