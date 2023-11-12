<template lang="">
    <div id="createCategoryModal" ref="createModalRef" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">新增類別</h5>
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
    import ImgUpload from '@/components/imageUpload/default.vue'

    const imageData = ref([])
    const categoryStore = useCategoryStore();
    const categoryData = reactive({
        name: '',
    })
    var modalInstance = ref()

    const props = defineProps({
        isShow: {
            type: Boolean,
            default: false
        }
    })

    const emit = defineEmits(['closeModal'])

    watch(() => props.isShow, (newVal, oldVal) => {
        if(newVal === true) {
            showModal()
        }
    })

    function showModal() {
        modalInstance = new Modal(document.getElementById('createCategoryModal'), {
            target: "#create-category-modal",
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
            status: 1,
            parent: 0,
            sort: 0
        }
        categoryStore.fetchCreateCategory(postData).then(() => {
            categoryStore.fetchCategory()
            categoryData.name = ''
            imageData.value = []
        })
        hideModal()
    }

</script>
