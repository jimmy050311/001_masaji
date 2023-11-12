<template lang="">
  <div>
      <!-- BEGIN breadcrumb -->
      <ol class="breadcrumb float-xl-end">
          <li class="breadcrumb-item"><a href="javascript:;">會員管理</a></li>
          <li class="breadcrumb-item active">會員管理總表</li>
      </ol>
      <!-- END breadcrumb -->
      <!-- BEGIN page-header -->
      <h1 class="page-header">會員管理總表 <small></small></h1>
      <!-- END page-header -->
      <!-- BEGIN panel -->
      <panel>
        <panel-body>
          <p class="text-invers mb-2" style="text-align-center"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請輸入會員名稱、會員帳號篩選資料</p>
          <n-input
            class=""
            round
            clearable
            placeholder="搜索"
            v-model:value="searchData.keyword"
            >
            <template #suffix>
              <n-icon :component="Search"/>
            </template>
          </n-input>
          <div class="d-flex justify-content-between mt-2">
              <div>
                <label class="form-label col-form-label ms-1">狀態：</label>
                <select class="btn btn-success btn-xs dropdown-toggle mr-3 mb-1" v-model="searchData.status">
                    <option value="" selected="">全部</option>
                    <option value="1">開通</option>
                    <option value="0">停權</option>
                </select>
              </div>
          </div>
        </panel-body>
      </panel>
      <panel>
          <panel-body>
            <n-data-table
              size="small"
              :columns="columns" 
              :data="tableData"
              :scroll-x="1300"
              :bordered="false"
              :single-line="false"
              striped
              @update:sorter="handleSorterChange"
            />
            <n-pagination class="mt-4 justify-content-center" v-model:page="currentPage" :page-count="page" />
          </panel-body>
      </panel>
      <!-- END panel -->
    </div>
  <editUserPasswordModal @closeEditPasswordModal="editPasswordModal = false" :isShow="editPasswordModal" :id="selectId"/>
</template>
<script setup>
    import { Search } from "@vicons/ionicons5";
    import { NDataTable, NPagination, NInput, NIcon } from "naive-ui"
    import { ref, computed, onMounted, watch, h, reactive } from 'vue'
    import { useRouter } from "vue-router"
    import { useUserStore } from "@/stores/backend/user.js"
    import editUserPasswordModal from "@/views/backend/user/modal/edit-password.vue"

    const router = useRouter()
    const userStore = useUserStore()
    const currentPage = ref(1)
    const selectId = ref(0)
    var editPasswordModal = ref(false)
    const searchData =  reactive({
        keyword: '',
        status: '',
        column: '',
        order: '',
    })
    const tableData = computed(() => {
      return userStore.userData.data
    })
    const page = computed(() => {
      return userStore.userData.dataPage
    })

    onMounted(() => {
      const data = {
          params: {
            paginate: 20,
          }
      }
      userStore.fetchUser(currentPage.value, data)
    })

    watch(currentPage, (newVal) => {
      search(newVal)
    })

    watch(searchData, (newVal) => {
      search(1)
    })

    function handleSorterChange(sorter) {
      searchData.column = sorter.columnKey
      searchData.order = sorter.order
      search(1)
    }

    function edit(id) {
      router.push({ name: 'user-edit', params: { id: id } })
    }

    function editPassword(id) {
      editPasswordModal.value = true
      selectId.value = id
    }

    function search(val) {
      currentPage.value = val
      const data = {
        params: {
          paginate: 20,
          keyword: searchData.keyword,
          status: searchData.status,
          column: searchData.column,
          order: searchData.order
        }
      }
      userStore.fetchUser(currentPage.value, data)
    }

    const columns = [
      {
        title: "名稱",
        key: "name",
        width: 100,
        fixed: "left",
        sorter: 'default',
      },
      {
        title: "操作",
        key: "actions",
        width: 100,
        render(row) {
          return [h('a', {class: 'btn btn-warning btn-xs mb-1', onClick: () => edit(row.id)}, '編輯會員'), 
                  h('a', {class: 'btn btn-primary btn-xs mb-1', onClick: () => editPassword(row.id)}, '修改密碼')]
        }
      },
      {
        title: "狀態",
        key: "status",
        width: 80,
        render(row) {
          switch(row.status) {
            case 1:
              return h('span', {class: 'badge bg-lime me-1'},'開通')
            case 0:
              return h('span', {class: 'badge bg-danger me-1'},'停權')
          }
        },
        sorter: 'default',
      },
      {
        title: "帳號",
        key: "account",
        sorter: 'default',
      },
      {
        title: "手機",
        key: "phone",
        render (row, index) {
          return h('span', [row.phone])
        },
        sorter: 'default',
      },
      {
        title: "信箱",
        key: "email",
        render (row, index) {
          return h('span', [row.email])
        },
        sorter: 'default',
      },
      {
        title: "等級",
        key: "level_name",
        render (row, index) {
          return h('span', [row.level_name])
        },
      },
      {
        title: "建立時間",
        key: "created_at",
        width: 200,
        sorter: 'default',
      }
    ];

</script>