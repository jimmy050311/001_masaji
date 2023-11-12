<template lang="">
    <div>
    	<!-- BEGIN breadcrumb -->
    	<ol class="breadcrumb float-xl-end">
    		<li class="breadcrumb-item"><a href="javascript:;">建立進貨單</a></li>
    		<li class="breadcrumb-item active">庫存管理</li>
    	</ol>
    	<!-- END breadcrumb -->
    	<!-- BEGIN page-header -->
    	<h1 class="page-header">建立進貨單 <small></small></h1>
    	<!-- END page-header -->
    	<!-- BEGIN panel -->
    	<panel>
    	    <panel-body>
                   <div class="row">
                        <label class="form-label col-form-label col-md-12 d-flex fs-7">商品名稱</label>
                        <n-select
                            placeholder="請選擇商品"
                            filterable
                            :options="productOptions"
                            v-model:value="productData.product_id"
                        />
                        <label class="form-label col-form-label col-md-12 d-flex fs-7 mt-1">數量</label>
                        <div class="col-md-12">
                            <n-input-number class="" type="number" 
                                v-model:value="productData.amount"
                                placeholder="請輸入數量"
                                min=1 />
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
                            <button type="submit" class="col-md-6 btn btn-primary w-100px" @click="submit">進貨商品</button>
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
    import { useRoute, useRouter } from "vue-router"
    import { useProductStore } from "@/stores/backend/product.js"
    import { useInventoryStore } from "@/stores/backend/inventory.js"

    const router = useRouter()
    const productStore = useProductStore()
    const inventoryStore = useInventoryStore()
    const productData = reactive({
        product_id: '',
        remark: '',
        amount: 1,
    })
    const productOptions = reactive([])

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
            type: 1,
        }
        inventoryStore.fetchCreateInventory(data).then((response) => {
            if(response) {
                router.push({ name: 'inventory-list', params: {} })
            }
        })
    }

</script>
