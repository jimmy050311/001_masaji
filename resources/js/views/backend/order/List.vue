<template lang="">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="javascript:;">訂單管理</a></li>
        <li class="breadcrumb-item active">訂單列表</li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">訂單列表 <small></small></h1>
    <!-- END page-header -->
    <panel>
        <panel-body>
            <p class="text-invers mb-2" style="text-align-center"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請輸入會員名稱、訂單編號篩選資料</p>
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
            <div class="ms-1 mt-1">
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
                <select class="btn btn-success btn-xs dropdown-toggle mr-3 mb-1" v-model="searchData.status">
                    <option value="" selected="">全部</option>
                    <option value="0">未付款</option>
                    <option value="1">已付款</option>
                    <option value="99">已退單</option>
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
              :scroll-x="1200"
              :bordered="false"
              :single-line="false"
              striped
              @update:sorter="handleSorterChange"
            />
            <n-pagination class="mt-4 justify-content-center" v-model:page="currentPage" :page-count="page" />
          </panel-body>
      </panel>
</template>
<script setup>
    import { Search } from "@vicons/ionicons5";
    import { NDataTable, NPagination, NInput, NIcon, NDatePicker } from "naive-ui"
    import { ref, computed, onMounted, watch, h, reactive } from 'vue'
    import { useRouter } from "vue-router"
    import { useOrderStore } from "@/stores/backend/order.js"

    const router = useRouter()
    const orderStore = useOrderStore()
    const currentPage = ref(1)
    const searchData =  reactive({
        keyword: '',
        status: '',
        start_date: null,
        end_date: null,
        column: '',
        order: '',
    })
    const tableData = computed(() => {
      return orderStore.orderData.data
    })
    const page = computed(() => {
      return orderStore.orderData.dataPage
    })

    onMounted(() => {
        const data = {
            params: {
              paginate: 20,
            }
        }
        orderStore.fetchOrder(currentPage.value, data)
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

    function search(val) {
      currentPage.value = val
      const data = {
        params: {
          paginate: 20,
          keyword: searchData.keyword,
          status: searchData.status,
          start_date: searchData.start_date,
          end_date: searchData.end_date,
          column: searchData.column,
          order: searchData.order
        }
      }
      orderStore.fetchOrder(currentPage.value, data)
    }

    function edit(id) {
        router.push({ name: 'order-edit', params: { id: id } })
    }

    const columns = [
      {
        title: "操作",
        key: "actions",
        width: 100,
        render(row) {
          return [h('a', {class: 'btn btn-warning btn-xs mb-1', onClick: () => edit(row.id)}, '訂單詳情')]
        }
      },
      {
        title: "訂單編號",
        key: "number",
        sorter: 'default',
      },
      {
        title: "狀態",
        key: "status",
        width: 80,
        render(row) {
          switch(row.status) {
            case 0:
              return h('span', {class: 'badge bg-secondary me-1'},'未付款')
            case 1:
              return h('span', {class: 'badge bg-lime me-1'},'已付款')
            case 99:
              return h('span', {class: 'badge bg-danger me-1'},'已退單')
          }
        },
        sorter: 'default',
      },
      {
        title: "會員名稱",
        key: "user_name",
      },
      {
        title: "當下等級",
        key: "level_name",
      },
      {
        title: "訂單總額",
        key: "final_total",
      },
      {
        title: "建立時間",
        key: "paid_at",
        width: 200,
        sorter: 'default',
      }
    ];

</script>