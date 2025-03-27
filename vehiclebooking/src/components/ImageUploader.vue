<template>
    <a-upload-dragger
        v-model:fileList="fileList"
        name="file"
        :maxCount="5"
        :multiple="true"
        @drop="handleDrop"
        @preview="handlePreview"
        list-type="picture-card"
        class="upload-list-inline"
        :before-upload="beforeUpload"
        @change="onChange"
        @remove="removeImageFile"
    >
        <p class="ant-upload-drag-icon">
            <inbox-outlined />
        </p>
        <p class="ant-upload-text">Click or drag file to this area to upload</p>
        <p class="ant-upload-hint">
            Support for a single or bulk upload. Strictly prohibit from
            uploading company data or other band files
        </p>
    </a-upload-dragger>
    <a-modal
        :open="previewVisible"
        :title="previewTitle"
        :footer="null"
        @cancel="handleCancel"
    >
        <img alt="example" style="width: 100%" :src="previewImage" />
    </a-modal>
</template>

<script lang="ts" setup>
import { ref, defineProps } from 'vue';
import type { UploadProps } from 'ant-design-vue';
import { InboxOutlined } from '@ant-design/icons-vue';

// Định nghĩa props
const props = defineProps({
    initialFileList: {
        type: Array as () => UploadProps['fileList'],
        default: () => [],
    },
});

// Khai báo biến
const previewVisible = ref(false);
const previewImage = ref('');
const previewTitle = ref('');
const fileList = ref<UploadProps['fileList']>(props.initialFileList);

// Function to get base64
function getBase64(file: File) {
    return new Promise((resolve, reject) => {
        const validTypes = ['image/png', 'image/jpeg', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            return reject(new Error('File không phải là định dạng ảnh hợp lệ (png, jpg, webp).'));
        }

        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = (error) => reject(error);
    });
}

// Hàm trước khi upload
const beforeUpload: UploadProps['beforeUpload'] = (file) => {
    return true; // Cần thực hiện kiểm tra file ở đây
};

// Hàm xử lý thay đổi file
const onChange = (info) => {
    const validTypes = ['image/png', 'image/jpeg', 'image/webp'];
    fileList.value = info.fileList.map((file) => {
        const fileTypeLower = file.type.toLowerCase();
        if (validTypes.includes(fileTypeLower)) {
            file.status = 'done';
            fileList.value = [...(fileList.value || []), file];
        } else {
            file.status = 'error';
        }
        return file;
    });
};

// Hàm xử lý khi xóa file
const removeImageFile = (file) => {
    console.log('Xóa file:', file.name);
    fileList.value = fileList.value.filter((item) => item.uid !== file.uid);
};

// Hàm khi preview file
const handlePreview = async (file: UploadProps['fileList'][number]) => {
    if (!file.url && !file.preview) {
        file.preview = (await getBase64(file.originFileObj)) as string;
    }
    previewImage.value = file.url || file.preview;
    previewVisible.value = true;
    previewTitle.value = file.name || file.url.substring(file.url.lastIndexOf('/') + 1);
};

// Hàm khi cancel modal
const handleCancel = () => {
    previewVisible.value = false;
    previewTitle.value = '';
};

// Hàm kéo file vào
const handleDrop = (e: DragEvent) => {
    console.log('File dropped:', e);
};

</script>

<style>
/* Các kiểu CSS nếu cần */
</style>
