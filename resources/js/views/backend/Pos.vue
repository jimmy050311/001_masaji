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
                            v-model:value="orderData.user_id"
                            @update:value="setUser"
                        />
                        <label class="text-danger" style="font-weight:bold;font-size:12px;">等級：{{orderData.level_name}}</label>
                        <label class="col-12 form-label col-form-label text-secondary" style="margin-top:10px;font-size:12px;">購買商品：</label>
                        <div class="border rounded" style="" v-for="(item, index) in cartData">
                            <div class="row" style="margin-start:0px;margin-end:0px;">
                                <div class="col-9 d-flex align-items-center">
                                    <button class="btn btn-danger w-25px h-26px d-flex justify-content-center" @click="remove(index)"><i class="fas fa-trash fa" style="padding-bottom:0px"></i></button>
                                    <label class="form-label col-form-label text-secondary" style="margin-start:5px;font-size:14px;">{{item.name}}</label>
                                </div>
                                <div class="col-3 d-flex align-items-center justify-content-end" style="margin-top:5px">
                                    <label class="form-label col-form-label text-secondary" style="margin-start:5px;margin-end:10px;font-size:14px;">x{{item.amount}}</label>
                                </div>
                            </div>
                            <div class="row" style="margin-start:0px;margin-end:0px;margin-bottom:0px">
                                <div class="col">
                                    <div style="height:22px" v-if="item.event_name != null">
                                        <span class="badge bg-warning" style="max-width:110px;font-size:10px">{{ item.event_name }}</span>
                                    </div>
                                    <div style="height:22px" v-if="item.coupon_name != null">
                                        <span class="badge bg-purple" style="max-width:110px;font-size:10px;">{{ item.coupon_name }}</span>
                                    </div>
                                    <div class="" style="height:22px">
                                        <span class="badge bg-primary" style="font-weight:bold;max-width: 110px;margin-bottom:0px;font-size:10px">${{item.final_price}}</span>
                                    </div>
                                </div>
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
                            <label class="form-label col-form-label text-primary" style="margin-top:10px;font-size:20px;">共{{final_amount}}件</label>
                            <label class="form-label col-form-label text-primary" style="margin-top:10px;font-size:20px;">${{final_total}}</label>
                        </div>
                        <button type="submit" class="col-md-6 btn btn-primary w-100px" @click="submit()">確認付款</button>
                    </div>
                </panel-body>
            </panel>
        </div>
        <div class="col-md-9">
            <panel>
                <panel-body>
                    <div class="row">
                        <div class="col">
                            <p class="text-invers mb-2" style="text-align-center"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請輸入產品名稱篩選資料</p>
                            <n-input
                                class=""
                                clearable
                                placeholder="搜索"
                                v-model:value="searchData.keyword"
                                >
                                <template #suffix>
                                  <n-icon :component="Search" />
                                </template>
                            </n-input>
                        </div>
                        <div class="col">
                            <p class="text-invers mb-2" style="text-align-center"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請選擇類別篩選資料</p>
                            <n-select
                                clearable
                                label-field="label"
                                value-field="value"
                                placeholder="請選擇類別"
                                filterable
                                :options="categoryOptions"
                                v-model:value="searchData.category_id"
                            />
                        </div>
                        <div style="margin-top:10px">
                            <n-grid :cols="3">
                                <n-gi v-for="(item, index) in tableData">
                                    <n-card>
                                        <div class="col-12 d-flex justify-content-between">
                                            <img :src="'/storage/' +item.image" class="col-12" alt="">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label col-form-label text-secondary" style="font-size:16px;">{{item.name}}<span v-if="item.type == 1">({{item.minute}}分鐘)</span></label>    
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label col-form-label text-secondary" style="font-size:16px;">${{item.price}}</label>
                                        </div>
                                        <div>
                                            <button type="submit" class="col-md-6 btn btn-primary w-100px h-35px" @click="openDrawer(item.id, item.name, item.price)">選擇商品</button>
                                        </div>
                                    </n-card>
                                </n-gi>
                            </n-grid>
                        </div>
                    </div>
                    <n-pagination class="mt-4 justify-content-center" v-model:page="currentPage" :page-count="page" />
                </panel-body>
            </panel>
            <n-drawer v-model:show="show" :width="380">
              <n-drawer-content :title="productName+'商品詳情確認'" closable :native-scrollbar="true">
                <div class="col-12">
                    <label class="form-label col-form-label text-secondary" style="font-size:12px;">輸入商品數量：</label>
                </div>
                <div class="col-md-12">
                    <n-input-number
                        v-model:value="amount" 
                        placeholder="商品數量"
                        clearable
                        :min=1
                    />
                </div>
                <div class="col-12">
                    <label class="form-label col-form-label text-secondary" style="font-size:12px;">選擇活動優惠：</label>
                </div>
                <n-select
                    clearable
                    label-field="label"
                    value-field="value"
                    placeholder="請選擇活動"
                    filterable
                    :options="eventOptions"
                    v-model:value="event_id"
                />
                <div class="col-12">
                    <label class="form-label col-form-label text-secondary" style="font-size:12px;">選擇優惠券優惠：</label>
                </div>
                <n-select
                    clearable
                    label-field="label"
                    value-field="value"
                    placeholder="請選擇優惠券"
                    filterable
                    :options="couponOptions"
                    v-model:value="coupon_id"
                />
                <label class="form-label col-form-label text-primary" style="margin-top:10px;font-size:16px;">小計：${{currentPrice}}</label>
                <div>
                    <button type="submit" class="col-md-6 btn btn-primary w-100px h-35px" style="margin-top:5px" @click="select()">加入訂單</button>
                </div>
              </n-drawer-content>
            </n-drawer>
        </div>
    </div>
    
</template>
<script setup>
    import { Search } from "@vicons/ionicons5";
    import { NButton, NImage, NInputNumber, NSelect, NDatePicker, NInput, NCard, NGi, NGrid, NIcon, NPagination, NDrawer, NDrawerContent } from "naive-ui"
    import { ref, reactive, onMounted, computed, watch, h } from "vue"
    import { useUserStore } from "@/stores/backend/user.js"
    import { useProductStore } from "@/stores/backend/product.js"
    import { useCategoryStore } from "@/stores/backend/category.js"
    import { useEventStore } from "@/stores/backend/event.js"
    import { useCouponStore } from "@/stores/backend/coupon.js"
    import { useOrderStore } from "@/stores/backend/order.js"

    const userStore = useUserStore()
    const productStore = useProductStore()
    const categoryStore = useCategoryStore()
    const eventStore = useEventStore()
    const couponStore = useCouponStore()
    const orderStore = useOrderStore()
    const currentPage = ref(1)
    const show = ref(false)
    //產品資料
    const productName = ref("")
    const productPrice = ref(0)
    const currentPrice = ref(0)
    const amount = ref(1)
    const event_id = ref()
    const coupon_id = ref()
    const productId = ref()
    const eventDiscount = ref(0)
    const couponDiscount = ref(0)
    const eventName = ref("")
    const couponName = ref("")
    const cartData = ref([])
    const total = ref(0)
    const final_total = ref(0)
    const final_amount = ref(0)

    //回傳資料
    const orderData = reactive({
        user_id: 1,
        level_id: null,
        level_name: null,
        remark: null,
    })
    const userOptions = ref([])
    const categoryOptions = ref([])
    const eventOptions = ref([])
    const couponOptions = ref([])
    const searchData = reactive({
      keyword: '',
      category_id: null,
    })
    const tableData = computed(() => {
      return productStore.productData.data
    })
    const page = computed(() => {
      return productStore.productData.dataPage
    })
    const categoryData = computed(() => {
        return categoryStore.categoryData
    })

    onMounted(async() => {
        categoryStore.fetchCategoryOriginal().then(() => {
            categoryData.value.forEach(item => {
                categoryOptions.value.push({
                    'value': item.id,
                    'label': item.name
                })
            })
        })
        const productData = {
            params: {
              paginate: 6,
              status: 1,
            }
        }
        productStore.fetchProduct(currentPage.value, productData)
        const data = {
            params: {
                status: 1
            }
        }
        await userStore.fetchObtainUser(data).then((response) => {
            response.forEach(item => {
                userOptions.value.push({
                    'label': item.name,
                    'value': item.id,
                })  
            })
        })
        await userStore.fetchUserDetail(orderData.user_id).then((response) => {
            orderData.level_id = response.level_id
            orderData.level_name = response.level_name
        })
    })

    watch(currentPage, (newVal) => {
      search(newVal)
    })

    watch(searchData, (newVal) => {
        search(1)
    })

    watch(event_id, (newVal) => {
        if(newVal != null) {
            const index = eventOptions.value.findIndex( x => x.value == newVal)
            eventDiscount.value = eventOptions.value[index].discount
            eventName.value = eventOptions.value[index].label
        }else {
            eventDiscount.value = 0
        }
        cal()
    })

    watch(coupon_id, (newVal) => {
        if(newVal != null) {
            const index = couponOptions.value.findIndex( x => x.value == newVal)
            couponDiscount.value = couponOptions.value[index].discount
            couponName.value = couponOptions.value[index].label
        }else {
            couponDiscount.value = 0
        }
        cal()
    })

    watch(amount, (newVal) => {
        cal()
    })

    function cal() {
        currentPrice.value = productPrice.value * amount.value
        if(couponDiscount.value != 0) {
            currentPrice.value = currentPrice.value - productPrice.value * amount.value * (1 - parseFloat(couponDiscount.value))
        }
        if(eventDiscount.value != 0) {
            currentPrice.value = currentPrice.value - productPrice.value * amount.value * (1 - parseFloat(eventDiscount.value))
        }
    }

    function search(val) {
        currentPage.value = val
        const data = {
          params: {
            paginate: 3,
            keyword: searchData.keyword,
            category_id: searchData.category_id,
            status: searchData.status,
          }
        }
        productStore.fetchProduct(currentPage.value, data)
    }


    function setUser() {
        userStore.fetchUserDetail(orderData.user_id).then((response) => {
            orderData.level_id = response.level_id
            orderData.level_name = response.level_name
        })
    }

    function openDrawer(id, name, price) {
        eventOptions.value = []
        couponOptions.value = []
        currentPrice.value = 0
        amount.value = 1
        coupon_id.value = null
        event_id.value = null
        couponDiscount.value = 0
        eventDiscount.value = 0
        couponName.value = null
        eventName.value = null
        const eventData = {
            params: {
                status: 1,
            }
        }
        eventStore.fetchObtainEvent(eventData).then((response) => {
            response.forEach(item => {
                eventOptions.value.push({
                    'label': item.name,
                    'value': item.id,
                    'discount': item.discount,
                })
            });
        })
        const couponData = {
            params: {
                status: 1,
            }
        }
        couponStore.fetchObtainCoupon(couponData).then((response) => {
            response.forEach(item => {
                couponOptions.value.push({
                    'label': item.name,
                    'value': item.id,
                    'discount': item.discount,
                })
            });
        })
        productId.value = id
        productName.value = name
        productPrice.value = price
        currentPrice.value = productPrice.value
        show.value = true
    }

    function select() {

        cartData.value.push({
            product_id: productId.value,
            name: productName.value,
            price: productPrice.value,
            amount: amount.value,
            coupon_id: coupon_id.value,
            event_id: event_id.value,
            coupon_discount: couponDiscount.value,
            event_discount: eventDiscount.value,
            coupon_name: couponName.value,
            event_name: eventName.value,
            final_price: currentPrice.value,
        })

        total.value = 0
        final_total.value = 0
        final_amount.value = 0
        cartData.value.forEach(item => {
            total.value += item.price
            final_total.value += item.final_price
            final_amount.value += item.amount
        })

        show.value = false
    }

    function remove(index) {
        total.value = 0
        final_total.value = 0
        final_amount.value = 0
        cartData.value.splice(index, 1)
        cartData.value.forEach(item => {
            total.value += item.price
            final_total.value += item.final_price
            final_amount.value += item.amount
        })
    }

    function submit() {
        const data = {
            user_id: orderData.user_id,
            level_id: orderData.level_id,
            amount: final_amount.value,
            total: total.value,
            final_total: final_total.value,
            status: 1,
            remark: orderData.remark,
            cartData: cartData.value,
        }
        orderStore.fetchCreateOrder(data).then((response) => {
            if(response) {
                window.location.href = "/manage/pos"
            }
        })
    }

</script>