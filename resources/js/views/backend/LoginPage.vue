<template lang="">
    <!-- BEGIN login -->
	<div class="login login-with-news-feed">
		<!-- BEGIN news-feed -->
		<div class="news-feed">
			<div class="news-image" style="background-image: url(/images/picture/picture_10.jpg)"></div>
			<div class="news-caption">
				<h4 class="caption-title"><b>GPOS</b> 後台系統</h4>
				<p>
					
				</p>
			</div>
		</div>
		<!-- END news-feed -->
		
		<!-- BEGIN login-container -->
		<div class="login-container">
			<!-- BEGIN login-header -->
			<div class="login-header mb-30px">
				<div class="brand">
					<div class="d-flex align-items-center">
						<img src="/images/picture/icon_young.jpg" style="height:40px; margin-right:10px"/>
						<b>GPOS</b> 
					</div>
					<small>後台系統</small>
				</div>
				<div class="icon">
					<i class="fa fa-sign-in-alt"></i>
				</div>
			</div>
			<!-- END login-header -->
			
			<!-- BEGIN login-content -->
			<div class="login-content">
					<div class="form-floating mb-15px">
						<input type="text" class="form-control h-45px fs-13px" placeholder="Email Address" v-model="data.account" />
						<label for="emailAddress" class="d-flex align-items-center fs-13px text-gray-600">請輸入帳號</label>
					</div>
					<div class="form-floating mb-15px">
						<input type="password" class="form-control h-45px fs-13px" placeholder="Password" v-model="data.password" />
						<label for="password" class="d-flex align-items-center fs-13px text-gray-600">請輸入密碼</label>
					</div>
					<div class="mb-15px">
						<button type="button" class="btn btn-success d-block h-45px w-100 btn-lg fs-14px" @click="login()">登入</button>
					</div>
					<div class="mb-40px pb-40px text-dark">
						<!-- Not a member yet? Click <router-link to="/user/register-v3" class="text-success">here</router-link> to register. -->
					</div>
					<!-- <hr class="bg-gray-600 opacity-2" /> -->
					<!-- <div class="text-gray-600 text-center text-gray-500-darker mb-0">
						&copy; Color Admin All Right Reserved 2022
					</div> -->
				
			</div>
			<!-- END login-content -->
		</div>
		<!-- END login-container -->
	</div>
	<!-- END login -->
</template>
<script setup>
    import { useAppOptionStore } from '@/stores/app-option';
    import { defineComponent, ref, computed, reactive, onMounted, watch, h } from 'vue'
    import Swal from "sweetalert2/dist/sweetalert2.js";
    import { useRouter, onBeforeRouteLeave } from "vue-router"
	import { useLoginStore } from '@/stores/backend/login.js'
	import { useAdminStore } from '@/stores/backend/admin.js';
	import axios from "axios";

	const loginStore = useLoginStore()
	const adminStore = useAdminStore()
    const router = useRouter()
    const appOption = useAppOptionStore()
    const data = reactive({
        account: '',
        password: '',
    })
	const captcha = ref("")

    onMounted(() => {
        appOption.appSidebarHide = true
        appOption.appHeaderHide = true
        appOption.appContentClass = "p-0"
    })

    onBeforeRouteLeave((to, from, next) => {
        appOption.appSidebarHide = false;
        appOption.appHeaderHide = false;
        appOption.appContentClass = "";
        next();
    })

    async function login() {
		const postData = {
            account: data.account,
            password: data.password,
        }
        await loginStore.fetchLogin(postData).then((response) => {
            if(response.success === 200) {
				//儲存token
				localStorage.setItem('access_token', response.access_token);

                Swal.fire({
                    title: '登入成功',
                    icon: 'success',
                    confirmButtonText: '確定',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
						window.location.href = "/manage/pos"
                        // router.push("/manage/overview")
                    }
                })
            }
        })
    }
</script>