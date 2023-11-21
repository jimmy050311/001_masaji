@extends('base.base')

@section('main')

    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- section begin -->
        <section id="subheader" class="jarallax">
            <img class="jarallax-img" src="images/background/subheader.jpg" alt="" />
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
            <div class="row" id="memberView">
              <div class="col-md-8 offset-md-2">
                  <h3>會員中心</h3>                            
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="false" @click="orderShow(false)">會員資訊</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" @click="orderShow(false)">忘記密碼</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="true" @click="orderShow(true)">消費資訊</button>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                      <label>會員名稱:@{{name}}</label></br>
                      <label>帳號:@{{account}}</label></br>
                      <label>信箱:@{{email}}</label></br>
                      <label>手機:@{{phone}}</label></br>
                      <label>生日:@{{birth}}</label></br>
                      <label>性別:@{{gender}}</label></br>
                      <label>等級:@{{level}}</label></br>
                      <label>聯絡地址:@{{address}}</label></br>
                      <div class="col-md-12">
                          <p id='submit' class="mt20" style="display: flex; justify-content: left;" @click="fetchLogout()">
                              <input type='submit' id='send_message' value='登出' class="btn btn-main">
                          </p>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                      <div name="contactForm" id='contact_form' class="form-border" method="post">
                          <div class="row" style="justify-content: left;">
                              <div class="col-md-6">
                                  <label>舊密碼:</label>
                                  <div>
                                      <input type='password' class="form-control" placeholder="請輸入帳號" v-model="old_password" required>
                                  </div>
                                  <label>新密碼:</label>
                                  <div>
                                      <input type='password' class="form-control" placeholder="請輸入新密碼" v-model="password" required>
                                  </div>
                                  <label>確認新密碼:</label>
                                  <div>
                                      <input type='password' class="form-control" placeholder="請輸入新密碼" v-model="password_confirmation" required>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <p id='submit' class="mt20" style="display: flex; justify-content: left;" @click="fetchPassword">
                                      <input type='submit' id='send_message' value='修改密碼' class="btn btn-main">
                                  </p>
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="tab-pane fade active" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                      
                    </div>
                  </div>
              </div>
              <div v-if="show">
                <div class="table-responsive">
                  <table class="table border text-center mb-0">
                    <thead class="bg-opacity-10">
                      <tr style="white-space:nowrap;">
                        <th>&nbsp;&nbsp;序號&nbsp;&nbsp;</th>
                        <th>&nbsp;&nbsp;訂單編號&nbsp;&nbsp;</th>
                        <th>&nbsp;&nbsp;訂單狀態&nbsp;&nbsp;</th>
                        <th>&nbsp;&nbsp;會員等級&nbsp;&nbsp;</th>
                        <th>&nbsp;&nbsp;小計&nbsp;&nbsp;</th>
                        <th>&nbsp;&nbsp;折扣&nbsp;&nbsp;</th>
                        <th>&nbsp;&nbsp;總金額&nbsp;&nbsp;</th>
                        <th>&nbsp;&nbsp;建單時間&nbsp;&nbsp;</th>
                        <th>&nbsp;&nbsp;操作&nbsp;&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody style="white-space:nowrap;">
                      <tr class="border-bottom" v-for="(item, index) in orderData">
                          <td>
                            <span>@{{index + 1}}</span>
                          </td>
                          <td>
                            <span>@{{item.number}}</span>
                          </td>
                          <td>
                            <span v-if="item.status == 1">未付款</span>
                            <span v-if="item.status == 2">已付款</span>
                            <span v-if="item.status == 99">已退貨</span>
                          </td>
                          <td>
                            <span>@{{item.level_name}}</span>
                          </td>
                          <td>
                            <span>@{{item.total}}</span>
                          </td>
                          <td>
                            <span>@{{item.total_discount}}</span>
                          </td>
                          <td>
                            <span>@{{item.final_total}}</span>
                          </td>
                          <td>
                            <span>@{{item.created_at}}</span>
                          </td>
                          <td class="pe-3">
                              <a class="btn-solid text-nowrap fs-7" @click="repay(item.number, item.load_time)" v-if="item.pay_type == 2 && item.status == 1">重新付款</a>
                              <a class="btn-solid text-nowrap fs-7 ms-2" @click="orderDetail(item.id)">訂單詳情</a>
                          </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center mt-3">
                    <li class="page-item" v-if="currentPage > 1" @click="search(currentPage-1)"><a class="page-link">@{{currentPage - 1}}</a></li>
                    <li class="page-item active"><a class="page-link">@{{currentPage}}</a></li>
                    <li class="page-item" v-if="currentPage < dataPage" @click="search(currentPage+1)"><a class="page-link">@{{currentPage + 1}}</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </section>
    </div>
    <!-- content close -->

    <script>

      new Vue({
        el: "#memberView",
        data: {
          id: '',
          name: '',
          account: '',
          email: '',
          phone: '',
          birth: '',
          gender: '',
          level: '',
          address: '',

          old_password: '',
          password: '',
          password_confirmation: '',

          dataPage: 1,
          currentPage: 1,
          orderData: [],
          show: true,
        },
        async mounted() {
          await this.fetchUser()
          await this.fetchOrder()
        },
        methods: {
          fetchUser() {
            const config = {
   			    		headers: {
				    		'Content-Type': 'application/json',
   			    			'Authorization': localStorage.getItem('access_token')
   			    		}
				    }
            const data = {}
            axios.post(`/api/front/user`, data, config).then((response) => {
              this.id = response.data.data.id
              this.name = response.data.data.name
              this.account = response.data.data.account
              this.email = response.data.data.email
              this.phone = response.data.data.phone
              this.birth = response.data.data.birth
              this.gender = response.data.data.gender == 1 ? "男" : "女"
              this.level = response.data.data.level_name,
              this.address = response.data.data.address
            })
          },
          fetchLogout() {
            const config = {
   			    	headers: {
				    	  'Content-Type': 'application/json',
   			    		'Authorization': localStorage.getItem('access_token')
   			    	}
				    }
            const data = {}
            axios.post(`/api/front/logout`, data, config)
            .then((response) => {
              Swal.fire({
                icon: 'success',
                title: '<span style="color:black">成功</span>',
                text: response.data.message,
              }).then((result) => {
                if(result.isConfirmed) {
                  window.location.href = "/"
                }
              })
              localStorage.removeItem("access_token");
            })
            .catch((error) => {
  				    Swal.fire({
              	icon: 'error',
              	title: '<span style="color:black">錯誤</span>',
              	text: error.response.data.message,
              })
  			    })
          },
          fetchPassword() {
            const config = {
   			    		headers: {
				    		  'Content-Type': 'application/json',
   			    			'Authorization': localStorage.getItem('access_token')
   			    		}
				    }
            const data = {
              old_password: this.old_password,
              password: this.password,
              password_confirmation: this.password_confirmation
            }
            axios.post(`/api/front/user/update-password`, data, config)
            .then((response) => {
              Swal.fire({
                icon: 'success',
                title: '<span style="color:black">成功</span>',
                text: response.data.message,
              })
              this.old_password = ""
              this.password = ""
              this.password_confirmation = ""
            })
            .catch((error) => {
  				    Swal.fire({
              	icon: 'error',
              	title: '<span style="color:black">錯誤</span>',
              	text: error.response.data.message,
              })
  			    })
          },
          fetchOrder() {
            const config = {
   			    		headers: {
				    		  'Content-Type': 'application/json',
   			    			'Authorization': localStorage.getItem('access_token')
   			    		}
				    }
            const data = {
              paginate: 20,
            }
            axios.post(`/api/front/order`, data, config).then((response) => {
              this.dataPage = response.data.dataPage
              this.orderData = response.data.data
            })
          },
          orderDetail(val) {
            window.location.href = '/member/order/' + val
          },
          orderShow(val) {
            this.show = val
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