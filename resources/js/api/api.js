import axios from "axios";
import Swal from 'sweetalert2'
import { useRouter } from "vue-router";

const request = axios.create({
    withCredentials: true,

    headers: { 'Content-Type': 'application/json',
               'Authorization': localStorage.getItem('access_token'),
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
})

request.interceptors.response.use((response) => {

    // 有打api即更換access_token, 避免過期30分鐘
    if (response.headers['authorization']) {
        localStorage.setItem('access_token', response.headers['authorization']);
    }

    return Promise.resolve(response.data);

},error => {
    switch (error.response.data.success) {
        case 400:
            Swal.fire({
                title: '錯誤',
                text: error.response.data.message,
                icon: 'error',
                confirmButtonColor: '#d33',
                confirmButtonText: '確認'
            })
            return Promise.reject(error.response.data);
        case 401:
            Swal.fire({
                title: '驗證失敗',
                text: error.response.data.message,
                icon: 'error',
                confirmButtonColor: '#d33',
                confirmButtonText: '確認'
            }).then((result) => {
                if (result.isConfirmed || result.isDismissed) {

                    localStorage.removeItem("access_token")
                    window.location.href = error.response.data.url
                }
            });
            return Promise.reject(error.response.data)
        default:
            return Promise.reject(error.response.data)
      }
});

//登入
export const loginFunc = (data) => request.post(`/api/login`, data)

//登出
export const logoutFunc = () => request.post(`/api/logout`)

//總覽
export const getOverviewFunc = () => request.get(`/api/overview`)

//管理員管理
export const getAdminFunc = (page, data) => request.get(`/api/admin?page=${page}`, data)
export const createAdminFunc = (postData) => request.post(`/api/admin`, postData)
export const getAdminDetailFunc = (id) => request.get(`/api/admin/${id}`) 
export const editAdminFunc = (id, postData) => request.put(`/api/admin/${id}`, postData)

//會員
export const getUserFunc = (page, data) => request.get(`/api/user?page=${page}`, data)
export const createUserFunc = (data) => request.post(`/api/user`, data)
export const getUserDetailFunc = (id) => request.get(`/api/user/${id}`)
export const editUserFunc = (id, data) => request.put(`/api/user/${id}`, data)
export const editUserPasswordFunc = (id, data) => request.put(`/api/user/update-password/${id}`, data)
export const obtainUserFunc = (data) => request.get(`/api/user/get/obtain`, data)

//會員等級
export const obtainLevelFunc = (data) => request.get(`/api/level`, data)

//點數
export const getPointFunc = (page, data) => request.get(`/api/point?page=${page}`, data)
export const getPointDetailFunc = (id) => request.get(`/api/point/${id}`)
export const editPointFunc = (id, data) => request.put(`/api/point/${id}`, data)

//點數log
export const getPointLogFunc = (page, data) => request.get(`/api/point-log?page=${page}`, data)

//商品類別
export const getCategoryFunc = () => request.get(`/api/category`)
export const createCategoryFunc = (postData) => request.post(`/api/category`, postData)
export const getCategoryDetailFunc = (id) => request.get(`/api/category/${id}`)
export const editCategoryFunc = (id, postData) => request.put(`/api/category/${id}`, postData)
export const deleteCategoryFunc = (id) => request.delete(`/api/category/${id}`)

//商品
export const getProductFunc = (page, data) => request.get(`/api/product?page=${page}`, data)
export const createProductFunc = (data) => request.post(`/api/product`, data)
export const getProductDetailFunc = (id) => request.get(`/api/product/${id}`)
export const editProductFunc = (id, data) => request.put(`/api/product/${id}`, data)
export const obtainProductFunc = (data) => request.get(`/api/product/get/obtain`, data)
export const editProductLowAmountFunc = (id, data) => request.put(`/api/product/edit/${id}`, data)

//庫存
export const getInventoryFunc = (page, data) => request.get(`/api/inventory?page=${page}`, data)
export const createInventoryFunc = (data) => request.post(`/api/inventory`, data)

//活動
export const getEventFunc = (page, data) => request.get(`/api/event?page=${page}`, data)
export const createEventFunc = (data) => request.post(`/api/event`, data)
export const getEventDetailFunc = (id) => request.get(`/api/event/${id}`)
export const editEventFunc = (id, data) => request.put(`/api/event/${id}`, data)
export const obtainEventFunc = (data) => request.get(`/api/event/get/obtain`, data)

//優惠券
export const getCouponFunc = (page, data) => request.get(`/api/coupon?page=${page}`, data)
export const createCouponFunc = (data) => request.post(`/api/coupon`, data)
export const getCouponDetailFunc = (id) => request.get(`/api/coupon/${id}`)
export const editCouponFunc = (id, data) => request.put(`/api/coupon/${id}`, data)
export const obtainCouponFunc = (data) => request.get(`/api/coupon/get/obtain`, data)

//訂單
export const getOrderFunc = (page, data) => request.get(`/api/order?page=${page}`, data)
export const createOrderFunc = (data) => request.post(`/api/order`, data)
export const getOrderDetailFunc = (id) => request.get(`/api/order/${id}`)
export const editOrderFunc = (id, data) => request.put(`/api/order/${id}`, data)

//圖表
export const getBarChartFunc = (data) => request.get(`/api/chart/bar-chart`, data)
export const getPieChartFunc = (data) => request.get(`/api/chart/pie-chart`, data)