<template lang="">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
    	<li class="breadcrumb-item"><a href="javascript:;">編輯商品</a></li>
    	<li class="breadcrumb-item active">商品管理</li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">編輯商品 <small></small></h1>
    <!-- END page-header -->
    <!-- BEGIN panel -->
    <panel>
        <panel-body>
            <p class="text-invers" style="margin-bottom: 5px"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請點擊下方按鈕編輯商品</p>
            <button type="submit" class="col-md-6 btn btn-primary w-100px" @click="submit()">編輯商品</button>
        </panel-body>
    </panel>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href="#default-tab-1" data-bs-toggle="tab" class="nav-link active">商品資訊</a>
      </li>
      <li class="nav-item">
        <a href="#default-tab-2" data-bs-toggle="tab" class="nav-link">商品圖片</a>
      </li>
      <li class="nav-item">
        <a href="#default-tab-3" data-bs-toggle="tab" class="nav-link">商品詳情</a>
      </li>
    </ul>
    <div class="tab-content panel rounded-0 p-3 m-0">
        <div class="tab-pane fade active show" id="default-tab-1">
            <label class="form-label col-form-label col-md-12 d-flex fs-7">名稱</label>
            <div class="col-md-12">
                <input class="form-control" placeholder="請輸入產品名稱" v-model="productData.name"/>
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7 mt-1">產品編號</label>
            <div class="col-md-12">
                <input class="form-control" placeholder="請輸入產品編號" v-model="productData.number"/>
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7 mt-1">類型</label>
            <div class="col-md-12">
                <n-select
                    label-field="label"
                    value-field="value"
                    placeholder="請選擇產品類型"
                    filterable
                    :options="typeOptions"
                    v-model:value="productData.type"
                />
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7 mt-1">類別</label>
            <div class="col-md-12">
                <n-select
                    label-field="label"
                    value-field="value"
                    placeholder="請選擇產品類別"
                    filterable
                    :options="categoryOptions"
                    v-model:value="productData.category_id"
                />
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7" v-if="productData.type == 2">庫存低水位警示</label>
            <div class="col-md-12" v-if="productData.type == 2">
                <n-input-number
                    v-model:value="productData.low_amount" 
                    placeholder="請輸入庫存低水位警示量"
                    clearable
                />
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7" v-if="productData.type == 1">時間(分鐘)</label>
            <div class="col-md-12" v-if="productData.type == 1">
                <n-input-number
                    v-model:value="productData.minute" 
                    placeholder="請輸入服務時間"
                    clearable
                />
            </div>
            <label class="form-label col-form-label col-md-12 d-flex fs-7">價格</label>
            <div class="col-md-12">
                <n-input-number
                    v-model:value="productData.price" 
                    placeholder="請輸入價格"
                    clearable
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
                    v-model:value="productData.status"
                />
            </div>
        </div>
        <div class="tab-pane fade" id="default-tab-2">
            <ImgUpload :imageList="imageData" :maxLimit=8 :maxSize=0.5 blockClass="col-md-2"></ImgUpload>
            <div class="invalid-feedback">
                ※上傳作品照片，第一張照片為主圖，可拖拉移動(建議上傳JPG檔案，大小建議200kb以內，以最多5張照片為上限)。
            </div>
        </div>
        <div class="tab-pane fade" id="default-tab-3">
            <label class="form-label col-form-label col-md-12 d-flex fs-7">規格</label>
            <n-input
                type="textarea"
                placeholder=""
                :autosize="{
                    minRows: 2
                }"
                v-model:value="productData.spec"
            />
            <label class="form-label col-form-label col-md-12 d-flex fs-7">簡述</label>
            <n-input
                type="textarea"
                placeholder=""
                :autosize="{
                    minRows: 2
                }"
                v-model:value="productData.desc"
            />
            <label class="form-label col-form-label col-md-12 d-flex fs-7">商品介紹</label>
            <CkEditor ref="ckeditorRef" :handleCkEditorChangeContent="handleCkEditorChangeContent" v-model="productData.introduction"></CkEditor>
        </div>
    </div>
</template>
<script setup>
    import { NButton, NImage, NModal, NUpload, NDataTable, NInputNumber, NSelect, NDatePicker, NInput } from "naive-ui"
    import { ref, reactive, onMounted, computed, watch, h } from "vue"
    import { useRoute, useRouter } from "vue-router"
    import CkEditor from '@/components/ckeditor/CkEditor.vue'
    import ImgUpload from '@/components/imageUpload/default.vue';
    import { useCategoryStore } from "@/stores/backend/category.js";
    import { useProductStore } from "@/stores/backend/product.js";

    const route = useRoute()
    const router = useRouter()
    const categoryStore = useCategoryStore()
    const productStore = useProductStore()
    const imageData = reactive([])
    const productData = reactive({
        name: '',
        number: '',
        category_id: null,
        low_amount: null,
        minute: null,
        price: null,
        spec: '',
        desc: '',
        introduction: '',
        status: 1,
        type: 1,
    })
    const productId = computed(() => {
        return route.params.id
    })
    const ckeditorRef = ref(null)
    const categoryData = computed(() => {
        return categoryStore.categoryData
    })
    const typeOptions = ref([
        {
            label: '服務',
            value: 1
        },
        {
            label: '商品',
            value: 2
        }
    ])
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
    
    onMounted(async() => {
        await categoryStore.fetchCategoryOriginal().then(() => {
            categoryData.value.forEach(item => {
                categoryOptions.value.push({
                    'value': item.id,
                    'label': item.name
                })
            })
            productData.category_id = categoryData.value[0].id
        })
        await productStore.fetchProductDetail(productId.value).then((response) => {
            productData.name = response.name
            productData.number = response.number
            productData.category_id = response.category_id
            productData.low_amount = response.low_amount
            productData.minute = response.minute
            productData.spec = response.spec
            productData.desc = response.desc.replace(/<br \/>/g, '')
            productData.introduction = response.introduction
            //初始化ckeditor
            ckeditorRef.value.showContent(productData.introduction)
            productData.status = response.status
            productData.price = response.price
            productData.type = response.type
            response.image_data.forEach(item => {
                imageData.push({image: item.image})
            })
        })
    })

    const handleCkEditorChangeContent = (val) => {
        productData.introduction = val;
    }

    function submit() {
        const data = {
            name: productData.name,
            number: productData.number,
            type: productData.type,
            category_id: productData.category_id,
            price: productData.price,
            spec: productData.spec,
            desc: productData.desc,
            introduction: productData.introduction,
            status: productData.status,
            type: productData.type,
            imageData: imageData,
        }
        if(productData.type == 1) {
            data.minute = productData.minute
        }else if(productData.type == 2) {
            data.low_amount = productData.low_amount
        }

        productStore.fetchEditProduct(productId.value, data).then((response) => {
            if(response) {
                router.push({ name: 'product-list', params: {} })
            }
        })
    }

</script>