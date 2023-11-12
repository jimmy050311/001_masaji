<template lang="">
    <div>
          <!-- BEGIN breadcrumb -->
		  <ol class="breadcrumb float-xl-end">
		  	<li class="breadcrumb-item"><a href="javascript:;">管理員列表</a></li>
		  	<li class="breadcrumb-item active">管理員管理</li>
		  </ol>
		  <!-- END breadcrumb -->
		  <!-- BEGIN page-header -->
		  <h1 class="page-header">管理員列表 <small></small></h1>
		  <!-- END page-header -->
		  <!-- BEGIN panel -->
		  <panel>
		  	<panel-body>
          <div class="row" style="margin-bottom: 15px;">
              <div class="col-md-6"></div>
              <div class="col-md-6" style="text-align: right">
                <n-button type="info" @click="createModal = true">新增管理員</n-button>
              </div>
          </div>
          <n-data-table
              size="small"
              :columns="columns" 
              :data="tableData"
              :bordered="false"
              :single-line="false"
              scroll-x="1200"
              striped
          />
          <n-pagination class="mt-4 justify-content-center" v-model:page="currentPage" :page-count="page" />
		  	</panel-body>
		  </panel>
		  <!-- END panel -->
    </div>
    <createAdminModal @closeModal="createModal = false" :isShow="createModal"/>
    <editAdminModal @closeEditModal="editModal = false" :isShow="editModal" :id="selectId" :currentPage="currentPage"/>
    <editAdminPasswordModal @closeEditPasswordModal="editPasswordModal = false" :isShow="editPasswordModal" :id="selectId"/>
</template>
<script setup>
    import { NDataTable, NButton, NPagination } from "naive-ui"
    import { ref, computed, onMounted, watch, h, reactive } from 'vue'
    import { useAdminStore } from "@/stores/backend/admin.js"
    import "bootstrap"
    import createAdminModal from "@/views/backend/admin/modal/create.vue"
    import editAdminModal from "@/views/backend/admin/modal/edit.vue"
    import editAdminPasswordModal from "@/views/backend/admin/modal/edit-password.vue"

    const adminStore = useAdminStore()
    const currentPage = ref(1)
    const selectId = ref(0)
    var createModal = ref(false)
    var editModal = ref(false)
    var editPasswordModal = ref(false)

    const tableData = computed(() => {
      return adminStore.adminData.data
    })

    const page = computed(() => {
      return adminStore.adminData.dataPage
    })

    onMounted(async() => {
      const data = {
        params: {
           paginate: 20
        }
      }
      adminStore.fetchAdmin(currentPage.value, data)
    })

    function edit(id) {
      editModal.value = true
      selectId.value = id
    }

    function editPassword(id) {
        editPasswordModal.value = true
        selectId.value = id
    }

    const columns =  [
    {
      title: "操作",
      key: "actions",
      width: '10%', 
      render(row) {
          return [
            h('a', {class: 'btn btn-warning btn-xs mb-1', onClick: () => edit(row.id)}, [h('i', {class: ['fa-solid fa-gear']})], ' 編輯'),
            h('br'),
            h('a', {class: 'btn btn-info btn-xs mb-1', onClick: () => editPassword(row.id)}, '修改密碼'),
          ]
      }
    },
    {
      title: "名稱",
      key: "name",
    },
    {
      title: "帳號",
      key: "account",
      resizable: true,
    },
    {
      title: "狀態",
      key: "status",
      render(row) {
        switch(row.status) {
          case 1:
            return h('span', {class: 'badge bg-primary me-1'},'開通')
          case 0:
            return h('span', {class: 'badge bg-danger me-1'},'停權')
        }
      },
    },
    {
      title: "手機",
      key: "phone",
    },
    {
      title: "信箱",
      key: "email",
    },
    // {
    //   title: "權限",
    //   key: "verify_name",
    // },
    {
      title: "更新時間",
      key: "updated_at",
    }
    ];
</script>