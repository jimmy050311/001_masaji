<template lang="">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
    	<li class="breadcrumb-item"><a href="javascript:;">新增活動</a></li>
    	<li class="breadcrumb-item active">促銷管理</li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">新增活動<small></small></h1>
    <!-- END page-header -->
    <!-- BEGIN panel -->
    <panel>
        <panel-body>
            <p class="text-invers" style="margin-bottom: 5px"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請點擊下方按鈕新增活動</p>
            <button type="submit" class="col-md-6 btn btn-primary w-100px" @click="submit()">新增活動</button>
        </panel-body>
    </panel>
    <panel>
        <panel-body>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">名稱</label>
            <div class="col-md-12">
                <input class="form-control" placeholder="請輸入活動名稱" v-model="eventData.name"/>
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7 mt-1">開始時間：</label>
            <n-date-picker 
              v-model:formatted-value="eventData.start_date"
              placeholder="請選擇起始時間"
              type="date" 
              value-format="yyyy-MM-dd"
              clearable
            />
            <label class="form-label col-form-label col-md-12 d-flex fs-7 mt-1">結束時間：</label>
            <n-date-picker 
              v-model:formatted-value="eventData.end_date"
              placeholder="請選擇起始時間"
              type="date" 
              value-format="yyyy-MM-dd"
              clearable
            />
            <label class="form-label col-form-label col-md-12 d-flex fs-7 mt-1">產品類別</label>
            <div class="col-md-12">
                <n-select
                    label-field="label"
                    value-field="value"
                    placeholder="請選擇產品類別"
                    filterable
                    :options="categoryOptions"
                    v-model:value="eventData.category_id"
                />
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">折扣</label>
            <div class="col-md-12">
                <n-input-number
                    v-model:value="eventData.discount" 
                    placeholder="請輸入折扣"
                    clearable
                    :precision="2"
                />
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">狀態</label>
            <div class="col-md-12">
                <n-select
                    label-field="label"
                    value-field="value"
                    placeholder=""
                    filterable
                    :options="statusOptions"
                    v-model:value="eventData.status"
                />
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">簡述</label>
            <n-input
                type="textarea"
                placeholder=""
                :autosize="{
                    minRows: 2
                }"
                v-model:value="eventData.desc"
            />
        </panel-body>
    </panel>
</template>
<script setup>
    import { NButton, NImage, NModal, NUpload, NDataTable, NInputNumber, NSelect, NDatePicker, NInput } from "naive-ui"
    import { ref, reactive, onMounted, computed, watch, h } from "vue"
    import { useRoute, useRouter } from "vue-router"
    import { useCategoryStore } from "@/stores/backend/category.js"
    import { useEventStore } from "@/stores/backend/event.js"

    const router = useRouter()
    const categoryStore = useCategoryStore()
    const eventStore = useEventStore()

    const eventData = reactive({
        name: '',
        category_id: null,
        discount: 0,
        desc: '',
        status: 1,
        start_date: null,
        end_date: null,
    })
    const categoryData = computed(() => {
        return categoryStore.categoryData
    })
    const statusOptions = ref([
        {
          label: '下架',
          value: 0
        },
        {
          label: '上架中',
          value: 1
        },
    ])
    const categoryOptions = ref([])
    
    onMounted(() => {
        categoryStore.fetchCategoryOriginal().then(() => {
            categoryData.value.forEach(item => {
                categoryOptions.value.push({
                    'value': item.id,
                    'label': item.name
                })
            })
            eventData.category_id = categoryData.value[0].id
        })
    })

    function submit() {
        const data = {
            name: eventData.name,
            category_id: eventData.category_id,
            discount: eventData.discount,
            desc: eventData.desc,
            status: eventData.status,
            start_date: eventData.start_date,
            end_date: eventData.end_date,
        }

        eventStore.fetchCreateEvent(data).then((response) => {
            if(response) {
                router.push({ name: 'event-list', params: {} })
            }  
        })
    }

</script>