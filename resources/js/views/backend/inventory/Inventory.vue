<template lang="">
  <div>
		<!-- BEGIN breadcrumb -->
		<ol class="breadcrumb float-xl-end">
			<li class="breadcrumb-item"><a href="javascript:;">庫存列表</a></li>
			<li class="breadcrumb-item active">庫存管理</li>
		</ol>
		<!-- END breadcrumb -->
		<!-- BEGIN page-header -->
		<h1 class="page-header">庫存列表<small></small></h1>
		<!-- END page-header -->
		<!-- BEGIN panel -->
		  <panel>
	    	<panel-body>
          <p class="text-invers mb-2" style="text-align-center"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請輸入產品名稱、產品編號篩選資料</p>
          <n-input
            class=""
            round
            clearable
            placeholder="搜索"
            v-model:value="searchData.keyword">
            <template #suffix>
              <n-icon :component="Search" />
            </template>
          </n-input>
          <div class="d-flex justify-content-between mt-2">
            <div>
              <label class="form-label col-form-label ms-1">狀態：</label>
              <select class="btn btn-success btn-xs dropdown-toggle mr-3 mb-1" v-model="searchData.status" @change="search()">
			            <option value="" selected="">無</option>
			            <option value="1">上架中</option>
                  <option value="0">已下架</option>
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
          scroll-x="1100"
          striped
          :bordered="false"
          :single-line="false"
        />
        <n-pagination class="mt-4 justify-content-center" v-model:page="currentPage" :page-count="page" />
			</panel-body>
		</panel>
		<!-- END panel -->
	</div>
  <editInventoryLowAmountModal @closeEditLowAmountModal="editLowAmountModal = false" :isShow="editLowAmountModal" :id="selectId"/>
</template>
<script setup>
  import { Search } from "@vicons/ionicons5";
  import { NDataTable, NPagination, NInput, NIcon, NDatePicker } from "naive-ui"
  import { ref, computed, onMounted, watch, h, reactive } from 'vue'
  import { useProductStore } from "@/stores/backend/product.js"
  import { useRouter } from "vue-router"
  import editInventoryLowAmountModal from "@/views/backend/inventory/modal/edit.vue"

  const router = useRouter()
    const productStore = useProductStore()
    const currentPage = ref(1)
    const selectId = ref(0)
    var editLowAmountModal = ref(false)
    const searchData =  reactive({
      keyword: '',
      status: '',
      column: '',
      order: '',
    })
    const tableData = computed(() => {
      return productStore.productData.data
    })
    const page = computed(() => {
      return productStore.productData.dataPage
    })

    onMounted(() => {
      const data = {
        params: {
           paginate: 20,
           type: 2,
        }
      }
      productStore.fetchProduct(currentPage.value, data)
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
          type: 2,
          paginate: 20,
          keyword: searchData.keyword,
          status: searchData.status,
          column: searchData.column,
          order: searchData.order,
        }
      }
      productStore.fetchProduct(currentPage.value, data)
    }

    function handleSorterChange(sorter) {
      searchData.column = sorter.columnKey
      searchData.order = sorter.order
      search(1)
    }

    function edit(id) {
        editLowAmountModal.value = true
        selectId.value = id
    }

    const columns =  [
        {
          title: "操作",
          key: "actions",
          width: 120,
          render(row) {
            return [h('a', {class: 'btn btn-warning btn-xs mb-1', onClick: () => edit(row.id)}, '編輯最低水位')]
          }
        },
        {
          title: "狀態",
          key: "status",
          width: '6%',
          render(row) {
            switch(row.status) {
              case 1:
                return h('span', {class: 'badge bg-primary me-1'},'上架中')
              case 0:
                return h('span', {class: 'badge bg-danger me-1'},'已下架')
            }
          },
          sorter: 'default',
          width: '5%',
        },
        {
          title: "產品編號",
          key: "number",
          sorter: 'default',
        },
        {
          title: "商品名稱",
          key: "name",
        },
        {
          title: "最低庫存水位",
          key: "low_amount",
        },
        {
          title: "目前庫存",
          key: "amount",
        },
        {
          title: "創建時間",
          key: "created_at",
          sorter: 'default'
        }
    ];
</script>
