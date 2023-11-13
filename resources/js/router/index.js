import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/manage/login",
      name: "login",
      component: () => import("../views/backend/LoginPage.vue")
    },
    {
      path: "/manage/pos",
      name: "pos",
      component: () => import("../views/backend/Pos.vue")
    },
    {
      path: "/manage/admin/list",
      name: "admin-list",
      component: () => import("../views/backend/admin/List.vue")
    },
    {
      path: "/manage/user/create",
      name: "user-create",
      component: () => import("../views/backend/user/Create.vue")
    },
    {
      path: "/manage/user/edit/:id",
      name: "user-edit",
      component: () => import("../views/backend/user/Edit.vue")
    },
    {
      path: "/manage/user/list",
      name: "user-list",
      component: () => import("../views/backend/user/List.vue")
    },
    {
      path: "/manage/user/point",
      name: "user-point",
      component: () => import("../views/backend/user/Point.vue")
    },
    {
      path: "/manage/user/point/:id",
      name: "user-point-detail",
      component: () => import("../views/backend/user/PointDetail.vue")
    },
    {
      path: "/manage/product/category",
      name: "product-category",
      component: () => import("../views/backend/product/Category.vue")
    },
    {
      path: "/manage/product/create",
      name: "product-create",
      component: () => import("../views/backend/product/Create.vue")
    },
    {
      path: "/manage/product/list",
      name: "product-list",
      component: () => import("../views/backend/product/Product.vue")
    },
    {
      path: "/manage/product/edit/:id",
      name: "product-edit",
      component: () => import("../views/backend/product/Edit.vue")
    },
    {
      path: "/manage/inventory/list",
      name: "inventory-list",
      component: () => import("../views/backend/inventory/Inventory.vue")
    },
    {
      path: "/manage/inventory/purchase",
      name: "inventory-purchase",
      component: () => import("../views/backend/inventory/Purchase.vue")
    },
    {
      path: "/manage/inventory/change",
      name: "inventory-change",
      component: () => import("../views/backend/inventory/Change.vue")
    },
    {
      path: "/manage/inventory/change-list",
      name: "inventory-change-list",
      component: () => import("../views/backend/inventory/ChangeList.vue")
    },
    {
      path: "/manage/event/create",
      name: "event-create",
      component: () => import("../views/backend/event/Create.vue")
    },
    {
      path: "/manage/event/list",
      name: "event-list",
      component: () => import("../views/backend/event/List.vue")
    },
    {
      path: "/manage/event/edit/:id",
      name: "event-edit",
      component: () => import("../views/backend/event/Edit.vue")
    },
    {
      path: "/manage/coupon/create",
      name: "coupon-create",
      component: () => import("../views/backend/coupon/Create.vue")
    },
    {
      path: "/manage/coupon/list",
      name: "coupon-list",
      component: () => import("../views/backend/coupon/List.vue")
    },
    {
      path: "/manage/coupon/edit/:id",
      name: "coupon-edit",
      component: () => import("../views/backend/coupon/Edit.vue")
    },
    {
      path: "/manage/order/list",
      name: "order-list",
      component: () => import("../views/backend/order/List.vue")
    },
    {
      path: "/manage/order/edit/:id",
      name: "order-edit",
      component: () => import("../views/backend/order/Edit.vue")
    }
  ],
});

export default router;
