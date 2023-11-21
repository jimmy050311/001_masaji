@extends('base.base')

@section('main')

    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- section begin -->
        <section id="subheader" class="jarallax">
            <img class="jarallax-img" src="/images/background/subheader.jpg" alt="" />
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>會員中心</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->
        <!-- section begin -->
	    <section aria-label="section">
            <div class="container">
                <div class="row" id="detailView">
                    <div class="col-md-8 offset-md-2">
                        <h3>訂單詳情</h3>                            
                        <label>訂單編號:@{{orderData['number']}}</label></br>
                        <label>會員名稱:@{{orderData['user_name']}}</label></br>
                        <label>下單等級:@{{orderData['level_name']}}</label></br>
                        <label>小計:@{{orderData['total']}}</label></br>
                        <label>總折扣:@{{orderData['total_discount']}}</label></br>
                        <label>總金額:@{{orderData['final_total']}}</label></br>
                        <label v-if="orderData['status'] == 0">訂單狀態:未付款</label>
                        <label v-if="orderData['status'] == 1">訂單狀態:已付款</label>
                        <label v-if="orderData['status'] == 99">訂單狀態:已退貨</label></br>
                        <label>付款時間:@{{orderData['paid_at']}}</label></br>
                        <h3 style="margin-top:20px;">購買商品</h3>
                        <div class="table-responsive">
                            <table class="table border text-center mb-0 align-middle">
                                <thead class="bg-opacity-10">
                                    <tr style="white-space:nowrap;">
                                        <th>&nbsp;&nbsp;序號&nbsp;&nbsp;</th>
                                        <th>&nbsp;&nbsp;圖片&nbsp;&nbsp;</th>
                                        <th>&nbsp;&nbsp;商品名稱&nbsp;&nbsp;</th>
                                        <th>&nbsp;&nbsp;商品編號&nbsp;&nbsp;</th>
                                        <th>&nbsp;&nbsp;類別&nbsp;&nbsp;</th>
                                        <th>&nbsp;&nbsp;價格&nbsp;&nbsp;</th>
                                        <th>&nbsp;&nbsp;數量&nbsp;&nbsp;</th>
                                        <th>&nbsp;&nbsp;服務時間&nbsp;&nbsp;</th>
                                        <th>&nbsp;&nbsp;最終價格&nbsp;&nbsp;</th>
                                        <th>&nbsp;&nbsp;優惠券&nbsp;&nbsp;</th>
                                        <th>&nbsp;&nbsp;活動&nbsp;&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody style="white-space:nowrap;">
                                    <tr class="border-bottom" v-for="(item, index) in orderData['order_detail']">
                                        <td>
                                            <span>@{{index + 1}}</span>
                                        </td>
                                        <td>
                                            <img :src="'/storage/'+item.image" style="width:80px">
                                        </td>
                                        <td>
                                            <span>@{{item.name}}</span>
                                        </td>
                                        <td>
                                            <span>@{{item.number}}</span>
                                        </td>
                                        <td>
                                            <span>@{{item.category_name}}</span>
                                        </td>
                                        <td>
                                             <span>@{{item.price}}</span>
                                        </td>
                                        <td>
                                            <span>@{{item.amount}}</span>
                                        </td>
                                        <td>
                                            <span>@{{item.minute}}</span>
                                        </td>
                                        <td>
                                            <span>@{{item.final_price}}</span>
                                        </td>
                                        <td>
                                            <span>@{{item.coupon_name}}</span>
                                        </td>
                                        <td>
                                            <span>@{{item.event_name}}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- content close -->

    <script>

      new Vue({
        el: "#detailView",
        data: {
            orderData: []
        },
        mounted() {
            const id = window.location.href.split('/')[5];
            this.fetchOrder(id)
        },
        methods: {
            fetchOrder(id) {
                const config = {
   			    	headers: {
						'Content-Type': 'application/json',
   			    		'Authorization': localStorage.getItem('access_token')
   			    	}
				}
                const data = {
                    id: id
                }
                axios.post(`/api/front/order/show`, data, config).then((response) => {
                    this.orderData = response.data.data
                    console.log(this.orderData)
                })
            }
        },
        
      })

    </script>

    <style>
      .table-bordered, .table-bordered td {
          border: solid 1px #FFFFFF;
      }

      .table {
        color: #FFFFFF
      }
    </style>
@endsection