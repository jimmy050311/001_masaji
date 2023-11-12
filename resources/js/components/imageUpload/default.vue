<template>
    <div ref="root" class="upload-input" >
        <input ref="inputFile"
            style="display: none;"
            type="file"
            hidden
            accept="image/gif, image/jpeg, image/png"
            multiple
            @change="handleFiles($event.target.files, $event.target)"
        />
        <div
            :class="[
                { 'upload-zone': !props.imageList.length },
                { 'upload-img row': props.imageList.length },
            ]"
        >
            <div v-if="!props.imageList.length" class="upload-zone-text">
                <h3><b>拖曳檔案到這裡</b> 或 <b>點擊此區</b></h3>
                ( Drag and drop files here or click here )
                <div v-if="props.type === 'single'"># 僅能上傳 1 張</div>
                <div v-else>
                    <div v-if="typeRule[props.type].maxLimit !==-1"># 最多上傳 {{typeRule[props.type].maxLimit}} 張</div>
                    <div v-else># 無限制上傳張數</div>
                </div>
                <div v-if="props.maxSize !== -1"># 每張圖片不能超過 {{props.maxSize}} MB </div>
            </div>
            <Imageitem
                v-for="(item, key) in props.imageList"
                :key="key"
                :arrayKey="key"
                :image="item.image"
                :removeBtn="props.removeBtn"
                :editBtn="props.editBtn"
                :linkBtn="props.linkBtn"
                :typeRule="typeRule[props.type]"
                @getStartKey="getStartKey"
                @getEndKey="getEndKey"
                @remove="remove"
            >
            </Imageitem>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref, reactive } from "vue";
import Imageitem from "@/components/imageUpload/imageitem.vue";
// 設定是否有圖片
const props = defineProps({
    imageList: {
        type: Array,
        default: [],
    },
    type: {
        type: String,
        default: 'multiple',
    },
    maxLimit:{
        type: Number,
        default: -1
    },
    maxSize:{
        type: Number,
        default: -1
    },
    removeBtn:{
        type: Boolean,
        default: true
    },
    editBtn:{
        type: Boolean,
        default: false,
    },
    linkBtn:{
        type: Boolean,
        default: false
    },
    blockClass:{
        type: String,
        default: null
    },
    btnTextHidden:{
        type: Boolean,
        default: false
    }
});

const root = ref(null);
const inputFile = ref(null);
const typeRule = reactive({
    single:{
        maxLimit:1, //最大張數
        class:"col-12",
        blockClass:props.blockClass,
        btnTextHidden:props.btnTextHidden
    },
    multiple:{
        maxLimit:props.maxLimit,  //最大張數
        class:"col-2",
        blockClass:props.blockClass,
        btnTextHidden:props.btnTextHidden
    }
});

const startKey = ref();
const endKey = ref();

const getStartKey = (val) => {
    startKey.value = "";
    startKey.value = val;
};

const getEndKey = (val) => {
    endKey.value = "";
    endKey.value = val;
    refreshImageList();
};

const refreshImageList = () => {
    [props.imageList[startKey.value], props.imageList[endKey.value]] = [
        props.imageList[endKey.value],
        props.imageList[startKey.value],
    ];
};

const remove = (val) => {
    props.imageList.splice(val, 1);
};

onMounted(() => {
    root.value.addEventListener("click", clickUpload, false); //監聽拉進
    root.value.addEventListener("dragenter", dragenter, false); //監聽拉進
    root.value.addEventListener("dragleave", dragleave, false); //監聽拉出
    root.value.addEventListener("dragover", dragover, false); //監聽在物件上
    root.value.addEventListener("drop", drop, false); //監聽放下
});

const clickUpload = (e) => {
    inputFile.value.click();
};
const dragenter = (e) => {
    root.value.classList.add("upload-zone-enter");
    e.stopPropagation();
    e.preventDefault();
};

const dragleave = () => root.value.classList.remove("upload-zone-enter");

const dragover = (e) => {
    e.stopPropagation();
    e.preventDefault();
};

const drop = (e) => {
    e.stopPropagation();
    e.preventDefault();
    const dropFileData = e.dataTransfer;
    const dropFiles = dropFileData.files;
    handleFiles(dropFiles, false);
};

// 因為拖曳和點擊的方式不同，點擊會多帶第2變數去把已有的值消除掉
const handleFiles = async (files, file_input) => {

    if(files.length > typeRule[props.type].maxLimit && Number(typeRule[props.type].maxLimit >= 0)){
        alert(`請勿上傳超過 ${props.maxLimit} 張圖片`);
        return;
    }


    if(props.maxSize !== -1 && check_size(files))
    {
        alert(`請勿上傳超過 ${props.maxSize} mb 的圖片`);
        return;
    }

    
    for (let i = 0; i < files.length; i++) {

        if(Number(props.imageList.length) >= Number(typeRule[props.type].maxLimit) && Number(typeRule[props.type].maxLimit >= 0)) {
            alert(`請勿上傳超過 ${typeRule[props.type].maxLimit} 張圖片`);
            return;
        }

        const file = files[i];
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = async (e) => {
            await props.imageList.push({ image: e.target.result });
        };
    }

    // 目的是為了點擊事件而把重複帶值的部分移除
    if (file_input) {
        file_input.value = "";
    }
};

const check_size = (files) => {

    for (var i = 0; i < files.length; i++) {

        if(files[i].size > (Number(props.maxSize) * 1000 * 1000 )) {
            return 1;
        }
    }

    return 0;
}

</script>

<style>
.upload-input {
    z-index: 2;
}

.flex-item {
    flex-wrap: wrap-reverse;
}

.upload-zone-enter {
    background-color: rgba(238, 238, 238, 0.5);
}

.upload-zone {
    width: 100%;
    height: 200px;
    border: dashed 3px rgb(219, 219, 219);
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
}
.upload-zone-text {
    text-align: center;
}

.upload-img {
    border: dashed 3px rgb(219, 219, 219);
    cursor: pointer;
    display: flex;
    min-height: 200px;
    justify-content: flex-start;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    flex-wrap: wrap;
    margin: 0px;
    padding: 0px 5px;
}

.upload-img.row [class="col-"] {
    display: flex;
    flex-direction: column;
}
</style>
