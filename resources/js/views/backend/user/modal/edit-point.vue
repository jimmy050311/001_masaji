<template lang="">
    <div id="editPointModal" ref="editPointModalRef" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">修改點數</h5>
                </div>
                <div class="modal-body form-group">
                    <div class="row mt-1">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">目前點數</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="number" v-model="pointData.point" placeholder="" autocomplete="off" style="width: 100%;" disabled="disabled">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">操作(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <n-select
                                label-field="label"
                                value-field="value"
                                placeholder=""
                                filterable
                                :options="operateOptions"
                                v-model:value="pointData.operate"
                            />
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">更改點數(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="number" v-model="pointData.after_point" placeholder="請輸入確認密碼" autocomplete="off" style="width: 100%;">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-3">
                            <label class="form-label col-form-label">更改點數(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" type="text" v-model="pointData.remark" placeholder="請輸入備註" autocomplete="off" style="width: 100%;"></textarea>
                        </div>
                    </div>
                    <!-- <div class="row" style="margin-top: 3px;">
                        <div class="col-md-3">
                            <label class="md-col">權限(必填)</label>
                        </div>
                        <div class="col-md-9">
                            <select class="md-select" v-model="userData.verify_id" style="width:100%;">
                                <option v-for="(item, index) in verifyOptions" :value="item.id">{{item.name}}</option>
                            </select>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="hideModal()">關閉</button>
                    <button type="button" class="btn btn-primary" @click="submit()">確認送出</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { NButton, NImage, NModal, NUpload, NDataTable, NInputNumber, NSelect, NDatePicker } from "naive-ui"
    import { Modal } from 'bootstrap'
    import { ref, watch, reactive } from 'vue'
    import { usePointStore } from "@/stores/backend/point.js"

    var modalInstance = ref()
    const pointStore = usePointStore()
    const pointData = reactive({
        point: 0,
        after_point: 0,
        remark: '',
        operate: 1,
    })
    const operateOptions = ref([
        {
            label: '增加',
            value: 1,
        },
        {
            label: '扣除',
            value: 2,
        }
    ])
    const props = defineProps({
        isShow: {
            type: Boolean,
            default: false
        },
        id: {
            type: Number,
            default: 0
        },
    })

    const emit = defineEmits(['closeEditPointModal'])

    watch(() => props.isShow, (newVal, oldVal) => {
        pointStore.fetchPointDetail(props.id).then((response) => {
            pointData.point = response.point
        })
        if(newVal === true) {
            showModal()
        }
    })

    function showModal() {
        modalInstance = new Modal(document.getElementById('editPointModal'), {
            target: "#edit-point-modal",
            backdrop: "static"
        })
        modalInstance.show()
    }

    function hideModal() {
        modalInstance.hide()
        emit('closeEditPointModal')
    }

    function submit() {
        var finalPoint = 0
        if(pointData.operate == 1) {
            finalPoint = pointData.point + pointData.after_point
        }else {
            finalPoint = pointData.point - pointData.after_point
        }
        pointData.point - pointData.after_point
        var data = {
            point:  finalPoint,
            remark: pointData.remark,
        }
        pointStore.fetchEditPoint(props.id, data).then(() => {
            const data = {
                params: {
                    paginate: 20
                }
            }
            pointStore.fetchPoint(props.currentPage, data)
            pointData.after_point = 0
            pointData.remark = ""
        })
        hideModal()
    }
</script>