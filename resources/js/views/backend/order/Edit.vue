<template lang="">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
    	<li class="breadcrumb-item"><a href="javascript:;">訂單詳情</a></li>
    	<li class="breadcrumb-item active">訂單管理</li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">訂單詳情<small></small></h1>
    <!-- END page-header -->
    <panel v-if="orderData.status == 1">
        <panel-body>
            <p class="text-invers" style="margin-bottom: 5px"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請點擊下方按鈕退單</p>
            <button type="submit" class="col-md-6 btn btn-danger w-100px" @click="refund()">訂單退單</button>
        </panel-body>
    </panel>
    <panel>
        <panel-body>
            <n-card>
                <div class="row">
                    <div class="col">
                        <label class="form-label col-form-label col-md-12 d-flex fs-7">訂單編號：{{ orderData.number }}</label>
                        <label class="form-label col-form-label col-md-12 d-flex fs-7">會員名稱：{{ orderData.user_name }}</label>
                        <label class="form-label col-form-label col-md-12 d-flex fs-7">當下等級：{{ orderData.level_name }}</label>
                        <label class="form-label col-form-label col-md-12 d-flex fs-7">訂單小計：{{ orderData.total }}</label>
                        <label class="form-label col-form-label col-md-12 d-flex fs-7">訂單折扣：{{ orderData.total_discount }}</label>
                        <label class="form-label col-form-label col-md-12 d-flex fs-7">訂單總額：{{ orderData.final_total }}</label>
                        <label class="form-label col-form-label col-md-12 d-flex fs-7">訂單件數：{{ orderData.amount }}</label>
                    </div>
                    <div class="col">
                        <label class="form-label col-form-label col-md-12 d-flex fs-7" v-if="orderData.status == 0">訂單狀態：未付款</label>
                        <label class="form-label col-form-label col-md-12 d-flex fs-7" v-if="orderData.status == 1">訂單狀態：已付款</label>
                        <label class="form-label col-form-label col-md-12 d-flex fs-7" v-if="orderData.status == 99">訂單狀態：已退單</label>
                        <label class="form-label col-form-label col-md-12 d-flex fs-7">付款時間：{{ orderData.paid_at }}</label>
                        <label class="form-label col-form-label col-md-12 d-flex fs-7">退款時間：{{ orderData.refund_at }}</label>
                        <label class="form-label col-form-label col-md-12 d-flex fs-7">備註：{{ orderData.remark }}</label>
                    </div>
                </div>
            </n-card>
            <n-card style="margin-top:5px" v-for="(item, index) in orderData.order_detail">
                <div class="d-flex align-items-center">
                    <div class="col-2 flex-shrink-0">
                        <img :src="'/storage/' + item.image" class="col-12" alt="">
                    </div>
                    <div class="col-8 flex-grow-1 ms-3">
                        <div class="row d-flex align-items-center">
                            <div class="col">
                                <label class="form-label col-form-label col-md-12 d-flex fs-7">產品名稱：{{ item.name }}</label>
                                <label class="form-label col-form-label col-md-12 d-flex fs-7">產品編號：{{ item.number }}</label>
                                <label class="form-label col-form-label col-md-12 d-flex fs-7">產品類型：{{ item.type == 1 ? "服務" : "商品"}}</label>
                                <label class="form-label col-form-label col-md-12 d-flex fs-7">產品類別：{{ item.category_name }}</label>
                                <label class="form-label col-form-label col-md-12 d-flex fs-7">產品金額：{{ item.price }}</label>
                            </div>
                            <div class="col">
                                <label class="form-label col-form-label col-md-12 d-flex fs-7">時間：{{ item.minute }}</label>
                                <label class="form-label col-form-label col-md-12 d-flex fs-7">活動名稱：{{ item.event_name }}</label>
                                <label class="form-label col-form-label col-md-12 d-flex fs-7">活動折扣：-{{ 100 - (item.event_discount * 100) }}%</label>
                                <label class="form-label col-form-label col-md-12 d-flex fs-7">優惠券名稱：{{ item.coupon_name }}</label>
                                <label class="form-label col-form-label col-md-12 d-flex fs-7">優惠券折扣：-{{ 100 - (item.coupon_discount * 100) }}%</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 d-flex align-items-center">
                        <label class="form-label col-form-label col-md-12 d-flex fs-7">x{{item.amount}}</label>
                    </div>
                </div>
            </n-card>
        </panel-body>
    </panel>
</template>
<script setup>
    import { NButton, NImage, NModal, NUpload, NDataTable, NInputNumber, NSelect, NDatePicker, NCard } from "naive-ui"
    import { ref, reactive, onMounted, computed, watch, h } from "vue"
    import { useRoute, useRouter } from "vue-router"
    import { useOrderStore } from "@/stores/backend/order.js"
    import Swal from "sweetalert2/dist/sweetalert2.js"

    const route = useRoute()
    const router = useRouter()
    const orderStore = useOrderStore()
    const orderData = reactive({
        number: '',
        user_name: '',
        level_name: '',
        status: '',
        total: '',
        total_discount: '',
        final_total: '',
        amount: '',
        remark: '',
        paid_at: '',
        refund_at: '',
        order_detail: [],
    })
    const orderId = computed(() => {
        return route.params.id
    })

    onMounted(async() => {
        await orderStore.fetchOrderDetail(orderId.value).then((response) => {
            orderData.number = response.number
            orderData.user_name = response.user_name
            orderData.level_name = response.level_name
            orderData.status = response.status
            orderData.total = response.total
            orderData.total_discount = response.total_discount
            orderData.final_total = response.final_total
            orderData.amount = response.amount
            orderData.remark = response.remark
            orderData.paid_at = response.paid_at
            orderData.refund_at = response.refund_at
            orderData.order_detail = response.order_detail
        })
    })

    function refund() {
        Swal.fire({
            icon: 'info',
            title: '確定要退單嗎？刪除後將無法回復此類別!',
            showCancelButton: true,
            confirmButtonText: '確定',
        }).then((result) => {
            if (result.isConfirmed) {
                const data = {
                    status: 99,
                }
                orderStore.fetchEditOrder(orderId.value, data).then((response) => {
                    if(response) {
                        router.push({ name: 'order-list', params: {} })
                    }
                })
            }
        })
    }

</script>