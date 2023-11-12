<template lang="">
    <div>
		<!-- BEGIN breadcrumb -->
		<ol class="breadcrumb float-xl-end">
			<li class="breadcrumb-item"><a href="javascript:;">商品管理</a></li>
			<li class="breadcrumb-item active">商品列表</li>
		</ol>
		<!-- END breadcrumb -->
		<!-- BEGIN page-header -->
		<h1 class="page-header">商品列表<small></small></h1>
		<!-- END page-header -->
		<!-- BEGIN panel -->
    <panel>
      <panel-body>
        <p class="text-invers mb-2" style="text-align-center"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請輸入產品名稱、產品編號篩選資料</p>
        <n-input
            class="mt-2"
            round
            clearable
            placeholder="搜索"
            v-model:value="searchData.keyword"
            >
            <template #suffix>
              <n-icon :component="Search" />
            </template>
        </n-input>
        <div class="d-flex justify-content-between mt-2">
          <div>
            <label class="form-label col-form-label ms-1">狀態：</label>
            <select class="btn btn-success btn-xs dropdown-toggle mr-3 mb-1" @change="search()" v-model="searchData.status">
	  	          <option value="" selected="">全部</option>
	  	          <option value="1">上架</option>
                <option value="0">下架</option>
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
          @update:sorter="handleSorterChange"
        />
        <n-pagination class="mt-4 justify-content-center" v-model:page="currentPage" :page-count="page" />
			</panel-body>
		</panel>
		<!-- END panel -->
	</div>
</template>
<script setup>
    import { Search } from "@vicons/ionicons5";
    import { NDataTable, NPagination, NImage, NIcon, NInput } from "naive-ui"
    import { defineComponent, ref, computed, reactive, onMounted, watch, h } from 'vue'
    import { useProductStore } from "@/stores/backend/product.js"
    import { useRouter } from "vue-router"

    const router = useRouter()
    const productStore = useProductStore()
    const currentPage = ref(1)
    const selectId = ref(0)
    const searchData = reactive({
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
          paginate: 20
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

    function edit(id) {
      router.push({ name: 'product-edit', params: { id: id } })
    }

    function search(val) {
      currentPage.value = val
      const data = {
        params: {
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

    const columns =  [
        {
          title: "操作",
          key: "actions",
          render(row) {
            return h('a', {class: 'btn btn-warning btn-xs' , onClick: () => edit(row.id)}, h('i', {class: 'fa-solid fa-gear'}), '編輯')
          }
        },
        {
          title: "狀態",
          key: "status",
          render(row) {
            switch(row.status) {
              case 1:
                return h('span', {class: 'badge bg-primary me-1'},'上架')
              case 0:
                return h('span', {class: 'badge bg-danger me-1'},'下架')
            }
          },
          sorter: 'default',
        },
        {
          title: "產品名稱",
          key: "name",
          sorter: 'default',
        },
        {
          title: "產品編號",
          key: "number",
          sorter: 'default',
        },
        {
          title: "圖片",
          key: "image",
          render(row) {
            return h(NImage,
            {
              width: "100",
              src: '/storage/' + row.image
            })
          },
          sorter: 'default',
        },
        {
          title: "產品類別",
          key: "category_name",
        },
        {
          title: "建立時間",
          key: "created_at",
          sorter: 'default',
        }
    ];
</script>
