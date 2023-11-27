<template lang="">
    <h1 class="page-header">業績總覽</h1>
    <div class="row">
        <!-- BEGIN col-3 -->
		<div class="col-xl-6 col-md-6">
			<div class="widget widget-stats bg-orange">
				<div class="stats-icon"><i class="fa fa-users"></i></div>
				<div class="stats-info">
					<h4>會員總數</h4>
					<p>{{userAmount}} 人</p>
				</div>
			</div>
		</div>
		<!-- END col-3 -->
		<!-- BEGIN col-3 -->
		<div class="col-xl-6 col-md-6">
			<div class="widget widget-stats bg-blue">
				<div class="stats-icon"><i class="fa fa-user-circle"></i></div>
				<div class="stats-info">
					<h4>總營業額</h4>
					<p>$ {{orderTotal}}</p>	
				</div>
			</div>
		</div>
		<!-- END col-3 -->
		<div class="col-xl-6 col-md-12">
			<panel>
        	    <panel-header>
        	        <panel-title>每月營業額表</panel-title>
        	        <!-- <panel-toolbar /> -->
        	    </panel-header>
        	    <panel-body>
					<Bar
						id="my-chart-id"
						:data="barChart"
					/>
				</panel-body>
			</panel>
		</div>
        <div class="col-xl-6 col-md-12">
			<panel>
        	    <panel-header>
        	        <panel-title>每月營業額表</panel-title>
        	        <!-- <panel-toolbar /> -->
        	    </panel-header>
        	    <panel-body>
					<Pie
						id="my-chart-id"
						:data="pieChart"
					/>
				</panel-body>
			</panel>
		</div>
	</div>
</template>
<script setup>
	import { ref, reactive, onMounted, computed, watch, h } from "vue"
	import { useChartStore } from "@/stores/backend/chart.js"
	import { Bar } from 'vue-chartjs'
    import { Pie } from 'vue-chartjs'
    import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement } from 'chart.js'
    ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement)
    import { useAppVariableStore } from '@/stores/app-variable';

    const appVariable = useAppVariableStore();
    const chartStore = useChartStore()
	const userAmount = ref(0)
	const orderTotal = ref(0)

	onMounted(() => {
		chartStore.fetchBarChart().then((response) => {
			userAmount.value = response.user_amount
			orderTotal.value = response.order_total
		})
        chartStore.fetchPieChart().then((response) => {

        })
	})

	const barChart = computed(() => {
		return {
			labels: chartStore.xAxis,
			datasets: [
				{
					label: '金額',
					backgroundColor: '#FFAF60',
					data: chartStore.totalValue,
				}
			]
		}
	})

    const pieChart = computed(() => {
        return {
            labels: chartStore.piexAxis,
            datasets: [{
                data: chartStore.pieValue,
                backgroundColor: [
                    'rgba(113, 199, 226, 1) ',
                    'rgba(225, 206, 96, 1)',
                    'rgba(241, 129, 92, 1)',
                    'rgba(191, 226, 214, 1)',
                    'rgba(196, 200, 216, 1)',
                    'rgba(210, 207, 200, 1)',
                    'rgba(250, 222, 125, 1)',
                    'rgba(207, 160, 190, 1)',
                    'rgba(150, 210, 207, 1)',
                    'rgba(249, 162, 191, 1)',
                ],
                hoverBackgroundColor: [
                    'rgba(35, 175, 214, 1)',
                    'rgba(213, 182, 13, 1)',
                    'rgba(241, 106, 64, 1)',
                    'rgba(138, 209, 186, 1)',
                    'rgba(153, 159, 193, 1)',
                    'rgba(177, 156, 137, 1)',
                    'rgba(238, 193, 81, 1)',
                    'rgba(173, 91, 143, 1)',
                    'rgba(99, 184, 179, 1)',
                    'rgba(223, 89, 112, 1)',
                ],
                borderWidth: 0
            }]
        }
    })
</script>