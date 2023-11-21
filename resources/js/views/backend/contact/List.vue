<template lang="">
    <div>
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="javascript:;">聯絡我們列表</a></li>
            <li class="breadcrumb-item active">訊息管理</li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <h1 class="page-header">聯絡我們列表 <small></small></h1>
        <!-- END page-header -->
        <!-- BEGIN panel -->
        <panel>
	      	<panel-body>
            <p class="text-invers" style="margin-bottom: 5px"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請選擇下方時間篩選資料</p>
            <label class="form-label">開始時間：</label>
            <n-date-picker 
              v-model:formatted-value="searchData.start_date"
              placeholder="請選擇起始時間"
              type="date" 
              value-format="yyyy-MM-dd"
              clearable
            />
            <label class="form-label mt-1">結束時間：</label>
            <n-date-picker 
              v-model:formatted-value="searchData.end_date"
              placeholder="請選擇結束時間"
              type="date" 
              value-format="yyyy-MM-dd"
              clearable 
            />
          </panel-body>
	      </panel>
        <panel>
          <panel-body>
            <n-data-table
                size="small"
                :columns="columns" 
                :data="tableData"
                :bordered="false"
                :single-line="false"
                striped
            />
            <n-pagination class="mt-4 justify-content-center" v-model:page="currentPage" :page-count="page" />
          </panel-body>
        </panel>
        <!-- END panel -->
    </div>
    <editContactModal @closeEditModal="editModal = false" :isShow="editModal" :id="selectId" :currentPage="currentPage"/>
</template>
<script setup>
  import { NDataTable, NPagination, NDatePicker } from "naive-ui"
  import { ref, computed, reactive, onMounted, watch, h } from 'vue'
  import "bootstrap"
  import { useContactStore } from "@/stores/backend/contact.js"
  import editContactModal from "@/views/backend/contact/modal/edit.vue"

  const contactStore = useContactStore()
  const currentPage = ref(1)
  const selectId = ref(0)
  var editModal = ref(false)
  const searchData =  reactive({
    start_date: null,
    end_date: null,
    column: '',
    order: '',
  })
  const tableData = computed(() => {
    return contactStore.contactData.data
  })
  const page = computed(() => {
    return contactStore.contactData.dataPage
  })

  onMounted(async() => {
    const data = {
      params: {
         paginate: 20
      }
    }
    contactStore.fetchContact(currentPage.value, data)
  })

  watch(currentPage, (newVal) => {
    search(newVal)
  })

  watch(searchData, (newVal) => {
      search(1)
  })

  function search(val) {
    currentPage.value = val
    const data = {
      params: {
        paginate: 20,
        start_date: searchData.start_date,
        end_date: searchData.end_date,
        column: searchData.column,
        order: searchData.order,
      }
    }
    contactStore.fetchContact(currentPage.value, data)
  }

  function edit(id) {
    editModal.value = true
    selectId.value = id
  }

  const columns =  [
    {
      title: "操作",
      key: "actions",
      render(row) {
          return [
              h('a', {class: 'btn btn-warning btn-xs mb-1', onClick: () => edit(row.id)}, [h('i', {class: ['fa-solid fa-gear']})], ' 編輯'),
          ]
      }
    },
    {
      title: "名稱",
      key: "name"
    },
    {
      title: "手機",
      key: "phone",
    },
    {
      title: "信箱",
      key: "email",
    },
    {
      title: "內容",
      key: "content",
    },
    {
      title: "備註",
      key: "remark"
    },
    {
      title: "創建時間",
      key: "created_at"
    }
  ];
</script>
