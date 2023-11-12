<template lang="">
    <div id="createAdminModal" ref="createModalRef" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">新增管理員</h5>
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
    import { ref, watch, reactive, onMounted, computed } from 'vue'
    import { useAdminStore } from "@/stores/backend/admin.js"

    const adminStore = useAdminStore()
    const adminData = reactive({
        name: '',
        account: '',
        password: '',
        password_confirmation: '',
        phone: '',
        email: '',
        status: '1',
    })

    const verifyOptions = computed(() => {
        return verifyStore.verifyData
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
        console.log(newVal)
        if (newVal === true) {
            showModal()
        }
    })
    
    function showModal() {
        modalInstance = new Modal(document.getElementById('createAdminModal'), {
            target: "#create-admin-modal",
            backdrop: "static"
        });
        modalInstance.show()
    }

    function hideModal() {
        modalInstance.hide()
        emit('closeModal', false)
    }

    function submit() {
        
        var data = {
            name: adminData.name,
            account: adminData.account,
            password: adminData.password,
            password_confirmation: adminData.password_confirmation,
            phone: adminData.phone,
            email: adminData.email,
            verify_id: 1,
            status: adminData.status
        }
        adminStore.fetchCreateAdmin(data).then(() => {
            const data = {
              params: {
                 paginate: 20
              }
            }
            adminStore.fetchAdmin(1, data)
        })
        hideModal()
    }   

</script>
