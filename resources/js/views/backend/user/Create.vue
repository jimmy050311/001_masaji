<template lang="">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
    	<li class="breadcrumb-item"><a href="javascript:;">建立會員</a></li>
    	<li class="breadcrumb-item active">會員管理</li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">建立會員 <small></small></h1>
    <!-- END page-header -->
    <!-- BEGIN panel -->
    <panel>
        <panel-body>
            <p class="text-invers" style="margin-bottom: 5px"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請點擊下方按鈕新增會員</p>
            <button type="submit" class="col-md-6 btn btn-primary w-100px" @click="submit()">新增會員</button>
        </panel-body>
    </panel>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href="#default-tab-1" data-bs-toggle="tab" class="nav-link active">會員資訊</a>
      </li>
    </ul>
    <div class="tab-content panel rounded-0 p-3 m-0">
        <div class="tab-pane fade active show" id="default-tab-1">
            <label class="form-label col-form-label col-md-12 d-flex fs-7">名稱<span style="color:#ff5b57">*</span></label>
            <div class="col-md-12">
                <input class="form-control" v-model="userData.name"/>
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">帳號<span style="color:#ff5b57">*</span></label>
            <div class="col-md-12">
                <input class="form-control" v-model="userData.account"/>
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">密碼<span style="color:#ff5b57">*</span></label>
            <div class="col-md-12">
                <input class="form-control" type="password" v-model="userData.password"/>
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">確認密碼<span style="color:#ff5b57">*</span></label>
            <div class="col-md-12">
                <input class="form-control" type="password" v-model="userData.password_confirmation"/>
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7 mt-1">等級<span style="color:#ff5b57">*</span></label>
            <div class="col-md-12">
                <n-select
                    label-field="name"
                    value-field="id"
                    placeholder="請選擇等級"
                    filterable
                    :options="levelOptions"
                    v-model:value="userData.level_id"
                />
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">狀態<span style="color:#ff5b57">*</span></label>
            <div class="col-md-12">
                <n-select
                    label-field="label"
                    value-field="value"
                    placeholder=""
                    filterable
                    :options="statusOptions"
                    v-model:value="userData.status"
                />
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">信箱<span style="color:#ff5b57">*</span></label>
            <div class="col-md-12">
                <input class="form-control" v-model="userData.email"/>
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">手機<span style="color:#ff5b57">*</span></label>
            <div class="col-md-12">
                <input class="form-control" v-model="userData.phone"/>
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">生日<span style="color:#ff5b57">*</span></label>
            <div class="col-md-12">
                <n-date-picker 
                    v-model:formatted-value="userData.birth"
                    value-format="yyyy-MM-dd" type="date" 
                    :actions="['clear']"
                    placeholder="請輸入生日"/>
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">性別<span style="color:#ff5b57">*</span></label>
            <div class="col-md-12">
                <n-select
                    label-field="label"
                    value-field="value"
                    placeholder=""
                    filterable
                    :options="genderOptions"
                    v-model:value="userData.gender"
                />
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">地址<span style="color:#ff5b57">*</span></label>
            <div class="col-md-12">
                <input class="form-control" v-model="userData.address"/>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { NButton, NImage, NModal, NUpload, NDataTable, NInputNumber, NSelect, NDatePicker } from "naive-ui"
    import { ref, reactive, onMounted, computed, watch, h } from "vue"
    import { useRoute, useRouter } from "vue-router"
    import { useLevelStore } from "@/stores/backend/level.js"
    import { useUserStore } from "@/stores/backend/user.js"

    const router = useRouter()
    const levelStore = useLevelStore()
    const userStore = useUserStore()
    const userData = reactive({
        name: null,
        account: null,
        password: '',
        password_confirmation: null,
        email: null,
        phone: null,
        status: null,
        gender: null,
        birth: null,
        address: null,
        level_id: null,
    })
    const statusOptions = ref([
        {
          label: '停權',
          value: 0
        },
        {
          label: '開通',
          value: 1
        },
    ])
    const genderOptions = ref([
        {
            label: '男',
            value: 1,
        },
        {
            label: '女',
            value: 2,
        }
    ])

    const levelOptions = ref([])

    onMounted(() => {
        levelStore.fetchObtainLevel().then((response) => {
            levelOptions.value = response
        })
    })

    function submit() {
        const data = {
            name: userData.name,
            account: userData.account,
            password: userData.password,
            password_confirmation: userData.password_confirmation,
            email: userData.email,
            phone: userData.phone,
            status: userData.status,
            gender: userData.gender,
            birth: userData.birth,
            address: userData.address,
            level_id: userData.level_id,
        }
        userStore.fetchCreateUser(data).then((response) => {
            if(response) {
                router.push({ name: 'user-list', params: {} })
            }
        })
    }
</script>
