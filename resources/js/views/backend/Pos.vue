<template lang="">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
    	<li class="breadcrumb-item"><a href="javascript:;">POS</a></li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">POS<small></small></h1>
    <!-- END page-header -->
    <div class="row">
        <div class="col-md-3">
            <panel>
                <panel-body>
                    <div>
                        <label class="form-label col-form-label text-primary" style="font-size:16px;">新增訂單</label>
                        <div class="col-12">
                            <label class="form-label col-form-label text-secondary" style="font-size:12px;">選擇會員：</label>
                        </div>
                        <n-select
                            label-field="label"
                            value-field="value"
                            placeholder="請選擇會員"
                            filterable
                            :options="userOptions"
                            v-model:value="user_id"
                        />
                        <label class="form-label col-form-label text-secondary" style="margin-top:10px;font-size:12px;">購買商品：</label>
                        <div class="row border rounded" style="margin-start:0px;margin-end:0px;">
                            <div class="col">
                                <label class="form-label col-form-label text-secondary" style="margin-start:5px;font-size:14px;">按摩商品</label>
                            </div>
                            <div class="col d-flex align-items-center justify-content-end">
                                <label class="form-label col-form-label text-secondary" style="margin-start:5px;margin-end:10px;font-size:14px;">x2</label>
                                <button class="btn btn-danger w-30px h-30px d-flex justify-content-center" @click="remove()"><i class="fas fa-trash fa"></i></button>
                            </div>
                        </div>
                        <div class="row border rounded" style="margin-start:0px;margin-end:0px;">
                            <div class="col">
                                <label class="form-label col-form-label text-secondary" style="margin-start:5px;font-size:14px;">按摩商品</label>
                            </div>
                            <div class="col d-flex align-items-center justify-content-end">
                                <label class="form-label col-form-label text-secondary" style="margin-start:5px;margin-end:10px;font-size:14px;">x2</label>
                                <button class="btn btn-danger w-30px h-30px d-flex justify-content-center" @click="remove()"><i class="fas fa-trash fa"></i></button>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="row" style="margin-start:0px;margin-end:0px;">
                                <div class="col d-flex align-items-center">
                                    <label class="form-label col-form-label text-secondary" style="margin-start:5px;font-size:14px;">按摩商品</label>
                                </div>
                                <div class="col d-flex align-items-center justify-content-end">
                                    <label class="form-label col-form-label text-secondary" style="margin-start:5px;margin-end:10px;font-size:14px;">x2</label>
                                    <button class="btn btn-danger w-30px h-30px d-flex justify-content-center" @click="remove()"><i class="fas fa-trash fa"></i></button>
                                </div>
                            </div>
                            <div style="h-30px">
                                <span class="badge bg-warning" style="max-width: 50px;">優惠活動優惠活動優惠活動優惠活動</span>
                                <span class="badge bg-purple" style="max-width: 50px;">優惠活動</span>
                            </div>
                        </div>
                        
                        <label class="form-label col-form-label text-secondary" style="margin-top:10px;font-size:12px;">備註：</label>
                        <n-input
                            type="textarea"
                            placeholder="備註"
                            :autosize="{
                                minRows: 3
                            }"
                            v-model:value="orderData.remark"
                        />
                        <div class="d-flex justify-content-between">
                            <label class="form-label col-form-label text-primary" style="margin-top:10px;font-size:20px;">共6件</label>
                            <label class="form-label col-form-label text-primary" style="margin-top:10px;font-size:20px;">$490</label>
                        </div>
                        <button type="submit" class="col-md-6 btn btn-primary w-100px" @click="submit()">確認付款</button>
                    </div>
                </panel-body>
            </panel>
        </div>
        <div class="col-md-9">
            <panel>
                <panel-body>
                    
                </panel-body>
            </panel>
        </div>
    </div>
    
</template>
<script setup>
    import { NButton, NImage, NInputNumber, NSelect, NDatePicker, NInput, NCard } from "naive-ui"
    import { ref, reactive, onMounted, computed, watch, h } from "vue"

    const orderData = reactive({
        user_id: 1,
        remark: null,
    })
    const userOptions = ref([
        {
          label: '陌生客',
          value: 0
        },
        {
          label: '測試會員',
          value: 1
        },
    ])
    const test = ref("測試 x1")
</script>