<template lang="">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
    	<li class="breadcrumb-item"><a href="javascript:;">建立最新消息</a></li>
    	<li class="breadcrumb-item active">前台管理</li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">建立最新消息 <small></small></h1>
    <!-- END page-header -->
    <!-- BEGIN panel -->
    <panel>
        <panel-body>
            <p class="text-invers" style="margin-bottom: 5px"><i class="fas fa-bullhorn fa-fw"></i>&nbsp;請點擊下方按鈕新增最新消息</p>
            <button type="submit" class="col-md-6 btn btn-primary w-100px" @click="submit()">新增最新消息</button>
        </panel-body>
    </panel>
    <panel>
        <panel-body>
            <div class="row">
                <label class="form-label col-form-label col-md-12 d-flex fs-7">標題</label>
                <div class="col-md-12">
                    <input class="form-control" placeholder="請輸入輪播名稱" v-model="newsData.title"/>
                </div>
                <label class="form-label col-form-label col-md-12 d-flex fs-7">狀態</label>
                <div class="col-md-12">
                    <n-select
                        label-field="label"
                        value-field="value"
                        placeholder="請選擇狀態"
                        filterable
                        :options="statusOptions"
                        v-model:value="newsData.status"
                    />
                </div>
                <label class="form-label col-form-label col-md-12 d-flex fs-7">圖片</label>
                <div class="col-md-12">
                    <ImgUpload :imageList="image" :maxLimit=1 :maxSize=0.5 blockClass="col-md-12"></ImgUpload>
                    <div class="invalid-feedback">
                        ※上傳作品照片，第一張照片為主圖，可拖拉移動(建議上傳JPG檔案，大小建議200kb以內，以最多5張照片為上限)。
                    </div>
                </div>
                <label class="form-label col-form-label col-md-12 d-flex fs-7">內容</label>
                <div class="col-md-12">
                    <CkEditor ref="ckeditorRef" :handleCkEditorChangeContent="handleCkEditorChangeContent" v-model="newsData.content"></CkEditor>
                </div>
            </div>
        </panel-body>
    </panel>
</template>
<script setup>
    import { NButton, NImage, NModal, NUpload, NDataTable, NInputNumber, NSelect, NDatePicker, NInput } from "naive-ui"
    import { ref, reactive, onMounted, computed, watch, h } from "vue"
    import { useRoute, useRouter } from "vue-router"
    import ImgUpload from '@/components/imageUpload/default.vue'
    import CkEditor from '@/components/ckeditor/CkEditor.vue'
    import { useNewsStore } from "@/stores/backend/news.js"

    const router = useRouter()
    const newsStore = useNewsStore()
    const image = reactive([])
    const newsData = reactive({
        title: null,
        status: null,
        content: '',
    })
    const statusOptions = ref([
        {
          label: '下架',
          value: 0
        },
        {
          label: '上架中',
          value: 1
        },
    ])
    const ckeditorRef = ref(null)

    onMounted(() => {
        //初始化ckeditor
        ckeditorRef.value.showContent()
    })

    const handleCkEditorChangeContent = (val) => {
        newsData.content = val;
    }

    function submit() {
        const data = {
            title: newsData.title,
            status: newsData.status,
            content: newsData.content,
            image: image,
        }
        newsStore.fetchCreateNews(data).then((response) => {
            if(response) {
                router.push({ name: 'news-list', params: {} })
            }
        })
    }

</script>
