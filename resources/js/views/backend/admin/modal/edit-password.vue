<template lang="">
    <div id="editPasswordModal" ref="editPasswordModalRef" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">修改密碼</h5>
                </div>
                <div class="modal-body form-group">
                    <div class="row mt-1">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">密碼(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="password" v-model="adminData.password" placeholder="請輸入密碼" autocomplete="off" style="width: 100%;">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">確認密碼(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="password" v-model="adminData.password_confirmation" placeholder="請輸入確認密碼" autocomplete="off" style="width: 100%;">
                        </div>
                    </div>
                    <!-- <div class="row" style="margin-top: 3px;">
                        <div class="col-md-3">
                            <label class="md-col">權限(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <select class="md-select" v-model="adminData.verify_id" style="width:100%;">
                                <option v-for="(item, index) in verifyOptions" :value="item.id">{{item.name}}</option>
                            </select>
                        </div>
                    </div> -->
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
    import { useAdminStore } from "@/stores/backend/admin.js"

    var modalInstance = ref()
    const adminStore = useAdminStore()
    const adminData = reactive({
        password: '',
        password_confirmation: ''
    })

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

    const emit = defineEmits(['closeEditPasswordModal'])

    watch(() => props.isShow, (newVal, oldVal) => {
        if(newVal === true) {
            showModal()
        }
    })
    
    function showModal() {
        modalInstance = new Modal(document.getElementById('editPasswordModal'), {
            target: "#edit-admin-modal",
            backdrop: "static"
        })
        modalInstance.show()
    }
    
    function hideModal() {
        modalInstance.hide()
        emit('closeEditPasswordModal')
    }
    
    function submit() {
        var postData = {
            password: adminData.password,
            password_confirmation: adminData.password_confirmation
        }
        adminStore.fetchEditAdmin(props.id, postData)
        hideModal()
    }
    
</script>
