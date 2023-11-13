<template lang="">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
    	<li class="breadcrumb-item"><a href="javascript:;">編輯優惠券</a></li>
    	<li class="breadcrumb-item active">促銷管理</li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">編輯優惠券<small></small></h1>
    <!-- END page-header -->
    <!-- BEGIN panel -->
    <panel>
        <panel-body>
            <p class="text-invers" style="margin-bottom: 5px"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請點擊下方按鈕編輯優惠券</p>
            <button type="submit" class="col-md-6 btn btn-primary w-100px" @click="submit()">編輯優惠券</button>
        </panel-body>
    </panel>
    <panel>
        <panel-body>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">名稱</label>
            <div class="col-md-12">
                <input class="form-control" placeholder="請輸入活動名稱" v-model="couponData.name"/>
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7 mt-1">開始時間：</label>
            <n-date-picker 
              v-model:formatted-value="couponData.start_date"
              placeholder="請選擇起始時間"
              type="date" 
              value-format="yyyy-MM-dd"
              clearable
            />
            <label class="form-label col-form-label col-md-12 d-flex fs-7 mt-1">結束時間：</label>
            <n-date-picker 
              v-model:formatted-value="couponData.end_date"
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
                    v-model:value="couponData.category_id"
                />
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">折扣</label>
            <div class="col-md-12">
                <n-input-number
                    v-model:value="couponData.discount" 
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
                    v-model:value="couponData.status"
                />
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">活動碼</label>
            <div class="col-md-12">
                <input class="form-control" placeholder="請輸入活動名稱" v-model="couponData.code"/>
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">簡述</label>
            <n-input
                type="textarea"
                placeholder=""
                :autosize="{
                    minRows: 2
                }"
                v-model:value="couponData.desc"
            />
        </panel-body>
    </panel>
</template>
<script setup>
    import { NButton, NImage, NModal, NUpload, NDataTable, NInputNumber, NSelect, NDatePicker, NInput } from "naive-ui"
    import { ref, reactive, onMounted, computed, watch, h } from "vue"
    import { useRoute, useRouter } from "vue-router"
    import { useCategoryStore } from "@/stores/backend/category.js"
    import { useCouponStore } from "@/stores/backend/coupon.js"

    const route = useRoute()
    const router = useRouter()
    const categoryStore = useCategoryStore()
    const couponStore = useCouponStore()
    const couponData = reactive({
        name: '',
        category_id: null,
        discount: 0,
        desc: '',
        status: 1,
        start_date: null,
        end_date: null,
        code: '',
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
    const couponId = computed(() => {
        return route.params.id
    })


    onMounted(async() => {
        categoryStore.fetchCategoryOriginal().then(() => {
            categoryData.value.forEach(item => {
                categoryOptions.value.push({
                    'value': item.id,
                    'label': item.name
                })
            })
            couponData.category_id = categoryData.value[0].id
        })
        couponStore.fetchCouponDetail(couponId.value).then((response) => {
            couponData.name = response.name
            couponData.category_id = response.category_id
            couponData.discount = parseFloat(response.discount)
            couponData.desc = response.desc
            couponData.status = response.status
            couponData.start_date = response.start_date
            couponData.end_date = response.end_date
            couponData.code = response.code
        })
    })

    function submit() {
        const data = {
            name: couponData.name,
            category_id: couponData.category_id,
            discount: couponData.discount,
            desc: couponData.desc,
            status: couponData.status,
            start_date: couponData.start_date,
            end_date: couponData.end_date,
            code: couponData.code,
        }

        couponStore.fetchEditCoupon(couponId.value, data).then((response) => {
            if(response) {
                router.push({ name: 'coupon-list', params: {} })
            }
        })
    }

</script>