import { defineStore } from "pinia";

export const useAppSidebarMenuStore = defineStore({
  id: "appSidebarMenu",
  state: () => {
    return [
		{
    		text: '功能列',
    		is_header: true
    	},
		{
			url: "/manage/pos",
			icon: "fa fa-lg fa-sitemap",
			title: "POS",
		},
		{
			url: "",
			icon: "fa fa-lg fa-user-gear",
			title: "管理員管理",
			children:[
				{
					url: "/manage/admin/list",
					title: "管理員列表",
				},
				// {
				//     url: "/manage/admin/verify",
				//     title: "權限列表",
				// }
			]
		},
		{
			url: "",
			icon: "fa fa-lg fa-user",
			title: "會員管理",
			children:[
				{
					url: "/manage/user/create",
					title: "建立會員",
				},
				{
					url: "/manage/user/list",
					title: "會員列表",
				},
				{
					url: "/manage/user/point",
					title: "點數錢包列表",
				},
			]
		},
		{
			url: "",
			icon: "fa fa-lg fa-bag-shopping",
			title: "商品管理",
			children:[
				{
					url: "/manage/product/category",
					title: "商品類別",
				},
				{
					url: "/manage/product/create",
					title: "建立商品",
				},
				{
					url: "/manage/product/list",
					title: "商品列表",
				},
			]
		},
		{
			url: "",
            icon: "fa fa-lg fa-warehouse",
            title: "庫存管理",
            children:[
                {
                    url: "/manage/inventory/list",
                    title: "庫存列表",
                },
				{
                    url: "/manage/inventory/purchase",
                    title: "建立進貨單",
                },
				{
                    url: "/manage/inventory/change",
                    title: "建立異動單",
                },
                {
                    url: "/manage/inventory/change-list",
                    title: "異動列表",
                },
            ]
		},
		{
			url: "",
            icon: "fa fa-lg fa-coins",
            title: "促銷管理",
			children:[
                {
                    url: "/manage/event/create",
                    title: "建立優惠活動",
                },
				{
                    url: "/manage/event/list",
                    title: "優惠活動列表",
                },
				{
                    url: "/manage/coupon/create",
                    title: "建立優惠券",
                },
                {
                    url: "/manage/coupon/list",
                    title: "優惠券列表",
                },
            ]
		},
		{
			url: "",
            icon: "fa fa-lg fa-file-circle-plus",
            title: "訂單管理",
            children:[
				{
                    url: "/manage/order/list",
                    title: "訂單列表",
                },
            ]
		},
		{
			url: "",
            icon: "fa fa-lg fa-line-chart",
            title: "業績管理",
            children:[
                {
                    url: "/manage/order/chart",
                    title: "統計圖表",
                },
            ]
		},
		{
			url: "",
            icon: "fa fa-lg fa-gear",
            title: "前台管理",
            children:[
                {
                    url: "/manage/contact/list",
                    title: "聯絡我們列表",
                },
				{
                    url: "/manage/news/create",
                    title: "建立最新消息",
                },
				{
                    url: "/manage/news/list",
                    title: "最新消息列表",
                },
            ]
		}
	]
  }
});