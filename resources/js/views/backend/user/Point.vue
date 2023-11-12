<template lang="">
    <div>
		<!-- BEGIN breadcrumb -->
		<ol class="breadcrumb float-xl-end">
			<li class="breadcrumb-item"><a href="javascript:;">會員管理</a></li>
			<li class="breadcrumb-item active">點數錢包總表</li>
		</ol>
		<!-- END breadcrumb -->
		<!-- BEGIN page-header -->
		<h1 class="page-header">點數錢包總表 <small></small></h1>
		<!-- END page-header -->
        <!-- BEGIN panel -->
        <panel>
          <panel-body>
                <p class="text-invers mb-2" style="text-align-center"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請輸入會員名稱、會員帳號篩選資料</p>
                <n-input
                    class="mb-2"
                    round
                    clearable
                    placeholder="搜索"
                    v-model:value="searchData.keyword"
                    >
                    <template #suffix>
                      <n-icon :component="Search" />
                    </template>
                </n-input>
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
                  @update:sorter="handleSorterChange"
                />
                <n-pagination class="mt-4 justify-content-center" v-model:page="currentPage" :page-count="page" />
	    	</panel-body>
		</panel>
		<!-- END panel -->
    </div>
    <editUserPointModal @closeEditPointModal="editPointModal = false" :isShow="editPointModal" :id="selectId"/>
</template>
<script setup>
    import { Search } from "@vicons/ionicons5";
    import { NDataTable, NPagination, NIcon, NInput } from "naive-ui"
    import { reactive, ref, computed, onMounted, watch, h } from 'vue'
    import { usePointStore } from "@/stores/backend/point.js"
    import { useRouter } from "vue-router"
    import editUserPointModal from "@/views/backend/user/modal/edit-point.vue"

    const router = useRouter()
    const pointStore = usePointStore()
    const currentPage = ref(1)
    const selectId = ref(0)
    const editPointModal = ref(false)
    const searchData = reactive({
        keyword: '',
        column: '',
        order: '',
    })
    const tableData = computed(() => {
        return pointStore.pointData.data
    })
    const page = computed(() => {
        return pointStore.pointData.dataPage
    })

    onMounted(() => {
        const data = {
            params: {
                paginate: 20,
            }
        }
        pointStore.fetchPoint(currentPage.value, data)
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

    function editPoint(id) {
        editPointModal.value = true
        selectId.value = id
    }

    function detail(id) {
        router.push({ name: 'user-point-detail', params: { id: id } })
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
        pointStore.fetchPoint(currentPage.value, data)
    }

    const columns =  [
        {
            title: "操作",
            key: "actions",
            width: 100,
            render(row) {
              return h('a', {class: 'btn btn-warning btn-xs mb-1', onClick: () => editPoint(row.user_id)}, '編輯點數') 
            }
        },
        {
            title: "名稱",
            key: "name",
        },
        {
            title: "帳號",
            key: "account",
        },  
        {
            title: "會員點數",
            key: "point",
        },
        {
            title: "詳情",
            key: "actions",
            width: 100,
            render(row) {
                return h('a', {class: 'btn btn-warning btn-xs mb-1', onClick: () => detail(row.id)}, '錢包詳情')
            }
        },
    ];

</script>