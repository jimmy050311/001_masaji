<template lang="">
    <div>
        <!-- BEGIN breadcrumb -->
		<ol class="breadcrumb float-xl-end">
		    <li class="breadcrumb-item"><a href="javascript:;">會員管理</a></li>
		    <li class="breadcrumb-item active">點數紀錄</li>
		</ol>
		<!-- END breadcrumb -->
		<!-- BEGIN page-header -->
		<h1 class="page-header">{{ userName }} 點數紀錄<small></small></h1>
		<!-- END page-header -->
        <!-- BEGIN panel -->
	    <panel>
	        <panel-body>
            <n-data-table
                size="small"
                class="mt-3"
                :columns="columns" 
                :data="tableData"
                :bordered="true"
                :single-line="false"
                striped
                @update:sorter="handleSorterChange"
            />
            <n-pagination class="mt-4 justify-content-center" v-model:page="currentPage" :page-count="page" />
	      	</panel-body>
		</panel>
		<!-- END panel -->
    </div>
</template>
<script setup>
    import { NDataTable, NPagination, NIcon, NInput } from "naive-ui"
    import { reactive, ref, computed, onMounted, watch, h } from 'vue'
    import { usePointLogStore } from "@/stores/backend/point-log.js"
    import { usePointStore } from "@/stores/backend/point.js"
    import { useRoute, useRouter } from "vue-router"
    import { useUserStore } from "@/stores/backend/user.js"

    const route = useRoute()
    const router = useRouter()
    const pointLogStore = usePointLogStore()
    const pointStore = usePointStore()
    const userStore = useUserStore()
    const currentPage = ref(1)
    const userName = ref("")
    const tableData = computed(() => {
        return pointLogStore.pointLogData.data
    })
    const page = computed(() => {
        return pointLogStore.pointLogData.dataPage
    })
    const userId = computed(() => {
        return route.params.id
    })

    const searchData = reactive({
        column: '',
        order: '',
    })

    onMounted(() => {
        userStore.fetchUserDetail(userId.value).then((response) => {
            userName.value = response.name
        })
        const data = {
            params: {
              paginate: 20,
              user_id: userId.value,
            }
        }
        pointLogStore.fetchPointLog(currentPage.value, data)
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
              user_id: userId.value,
              keyword: searchData.keyword,
              column: searchData.column,
              order: searchData.order
            }
        }
        pointLogStore.fetchPointLog(currentPage.value, data)
    }

    function handleSorterChange(sorter) {
      searchData.column = sorter.columnKey
      searchData.order = sorter.order
      search(1)
    }

    const columns =  [
        {
          title: "名稱",
          key: "name",
        },
        {
          title: "異動前點數",
          key: "before_point",
          sorter: 'default',
        },
        {
          title: "異動點數",
          key: "balance",
          sorter: 'default',
        },
        {
          title: "異動後點數",
          key: "after_point",
          sorter: 'default',
        },
        {
          title: "異動原因",
          key: "remark",
        },
        {
          title: "建立時間",
          key: "created_at",
          sorter: 'default',
        },
    ];
</script>