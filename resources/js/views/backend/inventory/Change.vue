<template lang="">
    <div>
    	<!-- BEGIN breadcrumb -->
    	<ol class="breadcrumb float-xl-end">
    		<li class="breadcrumb-item"><a href="javascript:;">建立異動單</a></li>
    		<li class="breadcrumb-item active">庫存管理</li>
    	</ol>
    	<!-- END breadcrumb -->
    	<!-- BEGIN page-header -->
    	<h1 class="page-header">建立異動單 <small></small></h1>
    	<!-- END page-header -->
    	<!-- BEGIN panel -->
    	<panel>
    	    <panel-body>
                <div class="row">
                    <label class="form-label col-form-label col-md-12 d-flex fs-7">商品名稱</label>
                    <n-select
                       placeholder="請選擇產品"
                       filterable
                       :options="productOptions"
                       v-model:value="productData.product_id"
                    />
                    <label class="form-label col-form-label col-md-12 d-flex fs-7">異動</label>
                    <n-select
                        placeholder="請選擇異動項目"
                        filterable
                        :options="typeOptions"
                        v-model:value="productData.type"
                    />
                    <label class="form-label col-form-label col-md-12 d-flex fs-7 mt-1">數量</label>
                    <div class="col-md-12">
                        <n-input-number
                            placeholder="請輸入異動數量"
                            min=1 
                            v-model:value="productData.amount"
                        />
                        </div>
                    <label class="form-label col-form-label col-md-12 d-flex fs-7 mt-1">備註</label>
                    <div class="col-md-12">
                       <n-input class="" type="textarea" 
                           placeholder="請輸入備註"
                           min=1 
                           v-model:value="productData.remark"
                       />
                    </div>
                     <div class="mt-3 col-md-12 d-flex justify-content-center">
                         <button type="submit" class="col-md-6 btn btn-primary w-100px" @click="submit">異動商品</button>
                     </div>
                </div>
    		</panel-body>
    	</panel>
    	<!-- END panel -->
    </div>
</template>
<script setup>
    import { NButton, NModal, NInputNumber, NSelect, NInput } from "naive-ui"
    import { ref, reactive, onMounted, computed, watch, h } from "vue"
    import { useProductStore } from "@/stores/backend/product.js"
    import { useInventoryStore } from "@/stores/backend/inventory.js"
    import { useRoute, useRouter } from "vue-router"

    const router = useRouter()
    const productStore = useProductStore()
    const inventoryStore = useInventoryStore()
    const productData = reactive({
        product_id: null,
        remark: '',
        amount: 1,
        type: null,
    })
    const productOptions = reactive([])
    const typeOptions = ref([
        {
          label: '異動(入倉)',
          value: 2
        },
        {
          label: '異動(出倉)',
          value: 3
        },
    ])

    onMounted(() => {
        const data = {
            params: {
                type: 2,
            }
        }
        productStore.fetchObtainProduct(data).then((response) => {
          response.forEach(item => {
                productOptions.push({
                    label: item.name,
                    value: item.id,
                })
          })
        })
    })

    function submit() {
        const data = {
            product_id: productData.product_id,
            amount: productData.amount,
            remark: productData.remark,
            type: productData.type,
        }
        inventoryStore.fetchCreateInventory(data).then((response) => {
            if(response) {
                router.push({ name: 'inventory-change-list', params: {} })
            }
        })
    }

</script>
