<template lang="">
    <div>
		<!-- BEGIN breadcrumb -->
		<ol class="breadcrumb float-xl-end">
			<li class="breadcrumb-item"><a href="javascript:;">促銷管理</a></li>
			<li class="breadcrumb-item active">活動列表</li>
		</ol>
		<!-- END breadcrumb -->
		<!-- BEGIN page-header -->
		<h1 class="page-header">活動列表<small></small></h1>
		<!-- END page-header -->
        <!-- BEGIN panel -->
        <panel>
          <panel-body>
            <p class="text-invers mb-2" style="text-align-center"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請輸入活動名稱篩選資料</p>
            <n-input
                class=""
                round
                clearable
                placeholder="搜索"
                v-model:value="searchData.keyword"
                >
                <template #suffix>
                  <n-icon :component="Search" />
                </template>
            </n-input>
            <div class="ms-1 md-1 mt-1">
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
    import { NDataTable, NPagination, NImage, NIcon, NInput, NDatePicker } from "naive-ui"
    import { defineComponent, ref, computed, reactive, onMounted, watch, h } from 'vue'
    import { useEventStore } from "@/stores/backend/event.js"
    import { useRouter } from "vue-router"

    const router = useRouter()
    const eventStore = useEventStore()
    const currentPage = ref(1)
    const selectId = ref(0)
    const searchData = reactive({
      keyword: '',
      status: '',
      start_date: null,
      end_date: null,
      column: '',
      order: '',
    })
    const tableData = computed(() => {
      return eventStore.eventData.data
    })
    const page = computed(() => {
      return eventStore.eventData.dataPage
    })

    onMounted(() => {
      const data = {
        params: {
          paginate: 20
        }
      }
      eventStore.fetchEvent(currentPage.value, data)
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
          status: searchData.status,
          start_date: searchData.start_date,
          end_date: searchData.end_date,
          column: searchData.column,
          order: searchData.order,
        }
      }
      eventStore.fetchEvent(currentPage.value, data)
    }

    function handleSorterChange(sorter) {
      searchData.column = sorter.columnKey
      searchData.order = sorter.order
      search(1)
    }

    function edit(id) {
        router.push({ name: 'event-edit', params: { id: id } })
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
          title: "活動名稱",
          key: "name",
        },
        {
          title: "活動碼",
          key: "code",
        },
        {
            title: "折扣",
            key: "discount",
            sorter: 'default'
        },
        {
          title: "產品類別",
          key: "category_name",
        },
        {
            title: "建立時間",
            key: "created_at",
            sorter: 'default',
        },
        {
            title: "開始時間",
            key: "start_date",
            sorter: 'default',
        },
        {
            title: "結束時間",
            key: "end_date",
            sorter: 'default',
        },
        {
          title: "建立時間",
          key: "created_at",
          sorter: 'default',
        }
    ];
</script>