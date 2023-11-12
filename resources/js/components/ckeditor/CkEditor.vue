<template>
    <textarea id="editor1" name="editor1" ></textarea>
</template>
<script setup>
    import {defineProps, computed, onMounted, ref} from 'vue';

    const props = defineProps({
        handleCkEditorChangeContent: {
            type: Function,
            required: true
        }
    })

    let ckEditor;

    const showContent = (content) => {
        ckEditor = window.CKEDITOR.replace('editor1', {
            filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
            filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        });
        ckEditor.setData(content);
        ckEditor.on('change', () => {
            props.handleCkEditorChangeContent(ckEditor.getData());
        })
    }

    defineExpose({
        showContent
    });

</script>