<template>
    <div ref="root" class="imgItem-area" :class="checkClass()" draggable="true">
        <div>
            <div class="main-img">
                <img class="img-wh" :src="props.image" />
            </div>
            <div class="main-tool mt-1 mb-1">
                <div class="tools">
                    <button v-if="props.removeBtn" style="width:100%;" class="btn btn-sm btn-danger" @click="remove()">
                        <i class="fa-solid fa-trash" ></i>
                        <span v-if="!props.typeRule.btnTextHidden"> 移除 </span>
                    </button>
                    <button  v-if="props.editBtn" class="btn btn-sm btn-success" @click="changeImage()">
                        <i class="fa-solid fa-hammer"></i> 
                        <span v-if="!props.typeRule.btnTextHidden"> 編輯 </span>
                    </button>
                    <button  v-if="props.linkBtn" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-link"></i> 
                        <span v-if="!props.typeRule.btnTextHidden"> 網址 </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
const root = ref(null);

// 設定是否有圖片
const props = defineProps({
    image: {
        type: String,
        default: "",
    },
    typeRule:{
        type: Object,
        default: () => {
        return {
          class: "col-auto",
          blockClass: null,
          btnText:true
        };
      },
    },
    arrayKey: {
        default: null,
    },
    removeBtn:{
        type: Boolean
    },
    editBtn:{
        type: Boolean
    },
    linkBtn:{
        type: Boolean
    }
});

const emit = defineEmits(["getStartKey", "getEndKey", "remove" ,"selectorItem","cancelSelectorItem"]);

onMounted(() => {
    // 建立後對該物件做拖拉監聽
    root.value.addEventListener("dragstart", ondragstart, false);
    root.value.addEventListener("dragenter", ondragenter, false);
    root.value.addEventListener("dragleave", ondragleave, false);
    root.value.addEventListener("dragover", ondragover, false);
    root.value.addEventListener("drop", ondrop, false);
});


const ondragstart = (e) => {
    emit("getStartKey", props.arrayKey);
    // 拿起的瞬間給予父組件訊息
};

const ondragenter = (e) => {
    root.value.classList.add("enter-border");
    e.stopPropagation(); //阻止當前事件繼續進行捕捉
    e.preventDefault(); //取消事件（即取消事件的預設行為）。但不會影響事件的傳遞，事件仍會繼續傳遞。
};

const ondragleave = (e) => {
    root.value.classList.remove("enter-border");
};

const ondragover = (e) => {
    e.stopPropagation(); //阻止當前事件繼續進行捕捉
    e.preventDefault(); //取消事件（即取消事件的預設行為）。但不會影響事件的傳遞，事件仍會繼續傳遞。
};

const ondrop = (e) => {
    e.stopPropagation();
    e.preventDefault();
    emit("getEndKey", props.arrayKey);
    root.value.classList.remove("enter-border");
};

const remove = () => {
    window.event.stopPropagation();      //阻止事件 冒泡传播
    emit("remove", props.arrayKey);
};

const checkClass = () => {
    if(props.typeRule.blockClass){
        return props.typeRule.blockClass
    }else{
        return props.typeRule.class
    }
}

// const changeImage = () => {
//     window.event.stopPropagation();      //阻止事件 冒泡传播
//     emit("remove", props.arrayKey);
// };

</script>

<style>
.imgItem-area {
    padding: 10px 5px;
    z-index: 3;
    pointer-events: auto;
}

.imgItem-area .card {
    height: 100%;
}

.main-tool {
    display: flex;
    flex-direction: column;
    /* height: 100%; */
    /* justify-content: flex-end; */
    /* background-color: #f7f7f7; */
}

.main-tool .tools {
    display: flex;
    justify-content: space-between;
}

.img-wh {
    width: 100%;
}

.enter-border {
    border: solid gray 2px;
}
</style>
