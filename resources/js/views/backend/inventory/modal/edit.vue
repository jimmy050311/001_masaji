<template lang="">
    <div id="editLowAmountModal" ref="editLowAmountModalRef" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">修改最低庫存水位</h5>
                </div>
                <div class="modal-body form-group">
                    <div class="row mt-1">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">最低庫存水位<br>(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text" v-model="productData.low_amount" placeholder="請輸入最低庫存水位" autocomplete="off" style="width: 100%;">
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
    import { ref, watch, reactive, onMounted, computed } from 'vue'
    import { useProductStore } from "@/stores/backend/product.js"

    const productStore = useProductStore()
    const productData = reactive({
        low_amount: '',
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
        }
    })

    const emit = defineEmits(['closeEditLowAmountModal'])

    watch(() => props.isShow, (newVal, oldVal) => {
        console.log(props.id)
        if (newVal === true) {
            showModal()
        }
    })

    function showModal() {
        modalInstance = new Modal(document.getElementById('editLowAmountModal'), {
            target: "#edit-low-amount-modal",
            backdrop: "static"
        });
        modalInstance.show()
    }

    function hideModal() {
        modalInstance.hide()
        emit('closeEditLowAmountModal', false)
    }

    function submit() {
        const data = {
            low_amount: productData.low_amount,
        }
        productStore.fetchEditLowAmount(props.id, data).then(() => {
            const data = {
              params: {
                paginate: 20
              }
            }
            productStore.fetchProduct(1, data)
        })
        hideModal()
    }

</script>
