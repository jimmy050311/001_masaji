<template lang="">
    <div id="editAdminModal" ref="editModalRef" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">編輯管理員</h5>
                </div>
                <div class="modal-body form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">名稱(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text" v-model="adminData.name" placeholder="請輸入使用者名稱" autocomplete="off" style="width: 100%">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">帳號(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text" v-model="adminData.account" placeholder="請輸入帳號" autocomplete="off" style="width: 100%;">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">手機(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text" v-model="adminData.phone" placeholder="請輸入手機" autocomplete="off" style="width: 100%;">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">信箱(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text" v-model="adminData.email" placeholder="請輸入信箱" autocomplete="off" style="width: 100%;">
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
                    <div class="row" style="margin-top: 3px;">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">狀態(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" v-model="adminData.status" style="width:100%;">
                                <option :value="1">開通</option>
                                <option :value="0">停權</option>
                            </select>
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
    import { useAdminStore } from "@/stores/backend/admin.js"

    var modalInstance = ref()
    const adminStore = useAdminStore()
    const adminData = reactive({
        name: '',
        account: '',
        phone: '',
        email: '',
        status: '',
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
        adminStore.fetchAdminDetail(props.id).then((response) => {
            adminData.name = response.name
            adminData.account = response.account
            adminData.phone = response.phone
            adminData.email = response.email
            adminData.verify_id = response.verify_id
            adminData.status = response.status
        })
        if(newVal === true) {
            showModal()
        }
    })
    
    function showModal() {
        modalInstance = new Modal(document.getElementById('editAdminModal'), {
            target: "#edit-admin-modal",
            backdrop: "static"
        })
        modalInstance.show()
    }

    function hideModal() {
        modalInstance.hide()
        emit('closeEditModal')
    }

    function submit() {
        var postData = {
            name: adminData.name,
            account: adminData.account,
            phone: adminData.phone,
            email: adminData.email,
            verify_id: adminData.verify_id,
            status: adminData.status
        }
        adminStore.fetchEditAdmin(props.id, postData).then(() => {
            const data = {
              params: {
                 paginate: 20
              }
            }
            adminStore.fetchAdmin(props.currentPage, data)
        })
        hideModal()
    }
    
</script>
