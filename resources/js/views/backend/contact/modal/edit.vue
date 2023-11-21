<template lang="">
    <div id="editContactModal" ref="editModalRef" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">聯絡我們詳情</h5>
                </div>
                <div class="modal-body form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">名稱(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text" v-model="contactData.name" autocomplete="off" style="width: 100%" disabled="disabled">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">手機(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text" v-model="contactData.phone" autocomplete="off" style="width: 100%;" disabled="disabled">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">信箱(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text" v-model="contactData.email" autocomplete="off" style="width: 100%;" disabled="disabled">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">內容(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" type="text" v-model="contactData.content" autocomplete="off" style="width: 100%;" disabled="disabled"></textarea>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">備註</label>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" type="text" v-model="contactData.remark" placeholder="請輸入備註" autocomplete="off" style="width: 100%;"></textarea>
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
    import { ref, watch, reactive, computed, onMounted } from 'vue'
    import { useContactStore } from "@/stores/backend/contact.js"

    var modalInstance = ref()
    const contactStore = useContactStore()
    const contactData = reactive({
        name: '',
        title: '',
        phone: '',
        email: '',
        content: '',
        remark: '',
    })

    const props = defineProps({
        isShow: {
            type: Boolean,
            default: false
        },
        id: {
            type: Number,
            default: 0
        },
        currentPage: {
            type: Number,
            default: 1
        }
    })

    const emit = defineEmits(['closeEditModal'])

    watch(() => props.isShow, (newVal, oldVal) => {
        contactStore.fetchContactDetail(props.id).then((response) => {
            contactData.name = response.name
            contactData.phone = response.phone
            contactData.email = response.email
            contactData.content = response.content
            contactData.remark = response.remark
        })
        if(newVal === true) {
            showModal()
        }
    })

    function showModal() {
        modalInstance = new Modal(document.getElementById('editContactModal'), {
            target: "#edit-contact-modal",
            backdrop: "static"
        })
        modalInstance.show()
    }

    function hideModal() {
        modalInstance.hide()
        emit('closeEditModal')
    }

    function submit() {
        var data = {
            remark: contactData.remark,
        }
        contactStore.fetchEditContact(props.id, data).then(() => {
            const contactData = {
              params: {
                paginate: 20
              }
            }
            contactStore.fetchContact(1, contactData)
            hideModal()
        })
    }

</script>
