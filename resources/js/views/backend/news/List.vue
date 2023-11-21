<template lang="">
    <div>
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="javascript:;">前台管理</a></li>
            <li class="breadcrumb-item active">最新消息列表</li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <h1 class="page-header">最新消息列表<small></small></h1>
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
                :scroll-x="1000"
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
</template>
<script setup>
    import { Search } from "@vicons/ionicons5";
    import { NDataTable, NPagination, NInput, NIcon, NImage } from "naive-ui"
    import { ref, computed, onMounted, watch, h, reactive } from 'vue'
    import { useRouter } from "vue-router"
    import { useNewsStore } from "@/stores/backend/news.js"

    const router = useRouter()
    const newsStore = useNewsStore()
    const currentPage = ref(1)
    const selectId = ref(0)
    const searchData =  reactive({
        keyword: '',
        status: '',
        column: '',
        order: '',
    })
    const tableData = computed(() => {
      return newsStore.newsData.data
    })
    const page = computed(() => {
      return newsStore.newsData.dataPage
    })

    onMounted(() => {
      const data = {
          params: {
            paginate: 20,
          }
      }
      newsStore.fetchNews(currentPage.value, data)
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
                column: searchData.column,
                order: searchData.order
            }
        }
        newsStore.fetchNews(currentPage.value, data)
    }

    function edit(id) {
        router.push({ name: 'news-edit', params: { id: id } })
    }

    const columns = [
        {
            title: "操作",
            key: "actions",
            width: 100,
            render(row) {
              return [ h('a', {class: 'btn btn-warning btn-xs mb-1', onClick: () => edit(row.id)}, '編輯最新消息'),]
            }
        },
        {
            title: "狀態",
            key: "status",
            width: 80,
            render(row) {
                switch(row.status) {
                    case 1:
                      return h('span', {class: 'badge bg-primary me-1'},'上架中')
                    case 0:
                      return h('span', {class: 'badge bg-danger me-1'},'已下架')
                }
            },
            sorter: 'default',
        },
        {
            title: "圖片",
            key: "image",
            render(row) {
                return h(NImage,
                {
                  width: "100",
                  src: row.image
                })
            },
        },
        {
            title: "名稱",
            key: "title",
            sorter: 'default',
        },
        {
          title: "建立時間",
          key: "created_at",
          sorter: 'default',
        }
    ]

</script>