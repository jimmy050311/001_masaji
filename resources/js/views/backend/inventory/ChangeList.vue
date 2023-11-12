<template lang="">
    <div>
		<!-- BEGIN breadcrumb -->
		<ol class="breadcrumb float-xl-end">
			<li class="breadcrumb-item"><a href="javascript:;">異動總表</a></li>
			<li class="breadcrumb-item active">庫存管理</li>
		</ol>
		<!-- END breadcrumb -->
		<!-- BEGIN page-header -->
		<h1 class="page-header">異動總表<small></small></h1>
		<!-- END page-header -->
		<!-- BEGIN panel -->
		  <panel>
	    	<panel-body>
            <p class="text-invers mb-2" style="text-align-center"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請輸入產品名稱、異動單號篩選資料</p>
            <n-input
              class="mb-2"
              round
              clearable
              placeholder="搜索"
              v-model:value="searchData.keyword">
              <template #suffix>
                <n-icon :component="Search" />
              </template>
            </n-input>
            <div class="ms-1 md-1">
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
            </div>
            <div class="d-flex justify-content-between mt-2"> 
              <div>
                <label class="form-label col-form-label ms-1">狀態：</label>
                <select class="btn btn-success btn-xs dropdown-toggle mr-3 mb-1" v-model="searchData.type" @change="search()">
	    	    	    <option value="" selected="">無</option>
                  <option value="1">進貨</option>
                  <option value="2">異動(入倉)</option>
                  <option value="3">異動(出倉)</option>
                  <option value="4">銷貨</option>
                  <option value="5">退貨</option>
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
            scroll-x="1200"
            striped
            :bordered="false"
            :single-line="false"
          />
          <n-pagination class="mt-4 justify-content-center" v-model:page="currentPage" :page-count="page" />
		  	</panel-body>
		  </panel>
		<!-- END panel -->
	</div>
</template>
<script setup>
  import { Search } from "@vicons/ionicons5";
  import { NDataTable, NPagination, NInput, NIcon, NDatePicker } from "naive-ui"
  import { ref, computed, onMounted, watch, h, reactive } from 'vue'
  import { useInventoryStore } from "@/stores/backend/inventory.js"
  import { useRouter } from "vue-router"

  const router = useRouter()
  const inventoryStore = useInventoryStore()
  const currentPage = ref(1)
  const selectId = ref(0)
  const searchData =  reactive({
    keyword: '',
    type: '',
    start_date: null,
    end_date: null,
    column: '',
    order: '',
  })
  const tableData = computed(() => {
    return inventoryStore.inventoryData.data
  })
  const page = computed(() => {
    return inventoryStore.inventoryData.dataPage
  })

  onMounted(() => {
    const data = {
      params: {
         paginate: 20
      }
    }
    inventoryStore.fetchInventory(currentPage.value, data)
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
        keyword: searchData.keyword,
        start_date: searchData.start_date,
        end_date: searchData.end_date,
        type: searchData.type,
        column: searchData.column,
        order: searchData.order,
      }
    }
    inventoryStore.fetchInventory(currentPage.value, data)
  }

  function handleSorterChange(sorter) {
    searchData.column = sorter.columnKey
    searchData.order = sorter.order
    search(1)
  }

  const columns = [
      {
        title: "單號",
        key: "number",
        width: 210,
      },
      {
        title: "異動",
        key: "type",
        width: 120,
        render(row) {
          switch(row.type) {
            case 1:
              return h('span', {class: 'badge bg-lime me-1'},'進貨')
            case 2:
              return h('span', {class: 'badge bg-purple me-1'},'異動(入倉)')
            case 3:
              return h('span', {class: 'badge bg-warning me-1'},'異動(出倉)')
            case 4:
              return h('span', {class: 'badge bg-primary me-1'},'銷貨')
            case 5:
              return h('span', {class: 'badge bg-danger me-1'},'退貨')
          }
        },
        sorter: 'default'
      },
      {
        title: "商品名稱",
        key: "product_name",
        sorter: 'default',
        width: 200
      },
      {
        title: "異動前數量",
        key: "before_quantity",
        width: 110
      },
      {
        title: "數量",
        key: "quantity",
        width: 60
      },
      {
        title: "剩餘數量",
        key: "after_quantity",
        width: 110
      },
      {
        title: "備註",
        key: "remark"
      },
      {
        title: "更新時間",
        key: "updated_at",
        width: 200,
        sorter: 'default'
      }
  ];
</script>