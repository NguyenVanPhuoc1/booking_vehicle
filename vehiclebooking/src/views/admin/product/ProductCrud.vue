<template>
    <div>
        <div class="productcrud-page mb-3">
            <h3 class="fw-bold px-3">Quản Lí Sản Phẩm</h3>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <ul class="d-flex list-unstyled m-0">
                            <li class="nav-item py-0 justify-content-sm-start">
                                <button class="btn btn-primary" @click="submitForm">
                                    <font-awesome-icon :icon="['fas', 'save']" />
                                    Lưu
                                </button>
                            </li>
                            <li class="nav-item py-0 ps-4">
                                <router-link class="btn btn-danger" :to="{ name: 'admin-product' }">
                                    <font-awesome-icon :icon="['fas', 'sign-out-alt']" />
                                    Thoát
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
                <a-breadcrumb class="my-4">
                    <a-breadcrumb-item>Bảng Điều Khiển</a-breadcrumb-item>
                    <a-breadcrumb-item><a class="text-primary text-decoration-none" href="">Thêm mới</a></a-breadcrumb-item>
                </a-breadcrumb>
            </div>
        </div>
    
        <section class="product-form">
            <form class="add-product" novalidate >
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline text-sm mb-0">
                            <div class="card-header">
                                <h4 class="card-title fw-bold">Nội dung Sản Phẩm</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8 col-12">
                                        <div class="card card-primary card-outline card-outline-tabs">
                                            <div class="card-header p-0 border-bottom-0">
                                                <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="tabs-lang" data-toggle="pill" href="#tabs-lang-vi" role="tab"
                                                            aria-controls="tabs-lang-vi" aria-selected="true">Tiếng Việt</a>
                                                    </li>                
                                                </ul>
                                            </div>
                                            <div class="card-body card-article">
                                                <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                                    <div class="tab-pane fade show active" id="tabs-lang-vi" role="tabpanel" aria-labelledby="tabs-lang">
                                                        <div class="form-group py-3">
                                                            <label class="d-block mb-2" for="slug_name_product">Đường dẫn mẫu (vi): <span class="text-danger">https://admin.com/san-pham</span></label>
                                                            <input v-model="formData.slug_name_product" class="form-control" type="text" name="slug_name_product" id="slug_name_product" placeholder="Đường dẫn" readonly>
                                                        </div>
                                                        <div class="form-group py-3">
                                                            <label for="product_name" class="mb-2">Tên Sản Phẩm (vi):</label>
                                                            <input v-model="formData.product_name" :class="{ 'is-invalid': errors['product_name'] }" type="text" class="form-control for-seo text-sm " placeholder="Tên Sản Phẩm" required>
                                                            <div v-if="errors['product_name']" class="invalid-feedback"> 
                                                                {{ errors['product_name'][0] }}
                                                            </div>
                                                        </div>
                                                        <p class="pt-3 m-1">Nội Dung :</p>
                                                        <div class="form-floating">
                                                            <textarea v-model="formData.product_desc" class="form-control h-auto" placeholder="Leave a comment here" id="product_desc"></textarea>
                                                            <label for="product_desc">Nội Dung</label>
                                                        </div>

                                                        <div class="row align-items-center">
                                                            <div class="col-6">
                                                                <div class="form-group py-3">
                                                                    <label for="product_price" class="mb-2">Giá Sản Phẩm :</label>
                                                                    <input v-model="formData.price" :class="{ 'is-invalid': errors['price'] }" type="text" class="form-control for-seo text-sm " name="product_price" id="product_price" placeholder="Giá Sản Phẩm" required>
                                                                    <div v-if="errors['price']" class="invalid-feedback"> 
                                                                        {{ errors['price'][0] }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <p>Nổi Bật</p>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"  value="" id="checknoibat" v-model="formData.noi_bat">
                                                                    <label class="form-check-label" for="checknoibat">
                                                                        Nổi Bật
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 h-auto">
                                        <div class="card card-primary card-outline card-outline-tabs h-auto">
                                            <div class="card-header p-0 border-bottom-0">
                                                <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="tabs-lang" data-toggle="pill" href="#tabs-lang-vi" role="tab"
                                                            aria-controls="tabs-lang-vi" aria-selected="true">Brand</a>
                                                    </li>                
                                                </ul>
                                            </div>
                                            <div class="card-body card-article">
                                                <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                                    <div class="tab-pane fade show active" id="tabs-lang-vi" role="tabpanel" aria-labelledby="tabs-lang">
                                                        <div class="p-1 d-flex align-items-center">
                                                            <span class="w-50">Brand:</span> 
                                                            <select v-model="formData.brand_id" class="my-3 w-100 form-select fw-bold">
                                                                <option value="" disabled selected>Select Brand</option>
                                                                <option class="fw-bold" v-for="option in brand_cars" :key="option._id" :value="option._id === formData.brand_id ? formData.brand_id : option._id">
                                                                    {{ option.brand_name }} 
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-primary card-outline card-outline-tabs h-auto">
                                            <div class="card-header p-0 border-bottom-0">
                                                <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="tabs-lang" data-toggle="pill" href="#tabs-lang-vi" role="tab"
                                                            aria-controls="tabs-lang-vi" aria-selected="true">Specifications</a>
                                                    </li>                
                                                </ul>
                                            </div>
                                            <div class="card-body card-article">
                                                <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                                    <div class="tab-pane fade show active" id="tabs-lang-vi" role="tabpanel" aria-labelledby="tabs-lang">
                                                        <div class="p-1 d-flex align-items-center">
                                                            <span class="w-50">Body:</span> 
                                                            <select v-model="formData.spec_body" class="my-3 w-100 form-select fw-bold">
                                                                <option value="" disabled selected>Select Body</option>
                                                                <option class="fw-bold" v-for="option in spec_body" :key="option.value">
                                                                    {{ option.name }} 
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="p-1 d-flex align-items-center">
                                                            <span class="w-50">Seats:</span> 
                                                            <select v-model="formData.spec_seat" class="my-3 w-100 form-select fw-bold">
                                                                <option value="" disabled selected>Select Seats</option>
                                                                <option class="fw-bold" v-for="option in spec_seat" :key="option.value" >
                                                                    {{ option.name }} 
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="p-1 d-flex align-items-center">
                                                            <span class="w-50">Door:</span> 
                                                            <select v-model="formData.spec_door" class="my-3 w-100 form-select fw-bold">
                                                                <option value="" disabled selected>Select Door</option>
                                                                <option class="fw-bold" v-for="option in spec_door" :key="option.value" >
                                                                    {{ option.name }} 
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="p-1 d-flex align-items-center">
                                                            <span class="w-50">InteriorColor:</span> 
                                                            <select v-model="formData.spec_interiorColor" class="my-3 w-100 form-select fw-bold">
                                                                <option value="" disabled selected>Select Color</option>
                                                                <option class="fw-bold" v-for="option in spec_interiorColor" :key="option.value" >
                                                                    {{ option.name }} 
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="card card-primary card-outline text-sm mb-0">
                            <div class="card-header">
                                <h4 class="card-title fw-bold">Image Product</h4>
                            </div>
                            <div class="card-body">
                                <div class="card card-primary card-outline card-outline-tabs">
                                    <div class="card-body card-article">
                                        <div class="clearfix">
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
                                                    <inbox-outlined></inbox-outlined>
                                                </p>
                                                <p class="ant-upload-text">Click or drag file to this area to upload</p>
                                                <p class="ant-upload-hint">
                                                    Support for a single or bulk upload. Strictly prohibit from uploading company data or other
                                                    band files
                                                </p>
                                            </a-upload-dragger>
                                            <a-modal :open="previewVisible" :title="previewTitle" :footer="null" @cancel="handleCancel">
                                                <img alt="example" style="width: 100%" :src="previewImage" />
                                            </a-modal>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</template>

<script lang="ts" setup>
import { ref,watch, onMounted, onUpdated } from 'vue';
import type { UploadProps } from 'ant-design-vue';
import { InboxOutlined } from '@ant-design/icons-vue';
import { message } from 'ant-design-vue';
// dùng vuex store
import { useStore } from 'vuex';
const store = useStore();
const apiClient = store.getters.apiClient;
import { useRoute, useRouter } from 'vue-router'; 
import { useToast } from 'vue-toastification';
import axios from 'axios';

const route = useRoute();
const router = useRouter();
const toast = useToast();
const spec_body = ref([
    { value: "1", name: "Sedan" },
    { value: "2", name: "Couple"},
    { value: "3", name: "Minivan" }
]);
const spec_seat = ref([
    { value: "1", name: "2 " },
    { value: "2", name: "4 "},
    { value: "3", name: "6" }
]);
const spec_door = ref([
    { value: "1", name: "2 " },
    { value: "2", name: "4"},
]);
const spec_interiorColor = ref([
    { value: "1", name: "Black" },
    { value: "2", name: "White"},
    { value: "3", name: "Blue" }
]);

const formData = ref({
    slug_name_product: '',
    product_name: '',
    product_desc: '',
    price: '',
    noi_bat: '',
    brand_id: '',
    spec_body: '',
    spec_seat: '',
    spec_door: '',
    spec_interiorColor: ''
});
const brand_cars = ref([]);
const onUdt = (e) => {
    console.log('udt')
};
const previewVisible = ref(false);
const previewImage = ref('');
const previewTitle = ref('');

const fileList = ref<UploadProps['fileList']>([]);
function getBase64(file: File) {
    return new Promise((resolve, reject) => {
        // Kiểm tra định dạng file
        const validTypes = ['image/png', 'image/jpeg', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            return reject(new Error('File không phải là định dạng ảnh hợp lệ (png, jpg, webp).'));
        }

        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

import { UploadFileStatus } from 'ant-design-vue/es/upload/interface'; // Import kiểu dữ liệu

const beforeUpload: UploadProps['beforeUpload'] = file => {
    return false; // File hợp lệ, cho phép tải lên
};

// Hàm xử lý khi có thay đổi (khi file được thêm hoặc xóa)
const onChange = (info) => {
    // Cập nhật danh sách file
    const validTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
    // console.log(fileList.value);
    fileList.value = info.fileList.map(file => {
        // console.log(file.type);
        const fileTypeLower = file.type.toLowerCase();
        if (validTypes.includes(fileTypeLower)) {
            
            file.status = 'done';
            fileList.value = [...(fileList.value || []), file];
        }
        else{
            file.status = 'error';
        }
        return file;
    }); 
    // console.log('Current file list:', fileList.value);
};
const onUpdate = (info) => {
    console.log('update');
}
//hàm xóa
const deleteUrl = ref([]);
const removeImageFile = () => {
    console.log('remove');
}
const handleCancel = () => {
    previewVisible.value = false;
    previewTitle.value = '';
};
const handlePreview = async (file: UploadProps['fileList'][number]) => {
    if (!file.url && !file.preview) {
        file.preview = (await getBase64(file.originFileObj)) as string;
    }
    previewImage.value = file.url || file.preview;
    previewVisible.value = true;
    previewTitle.value = file.name || file.url.substring(file.url.lastIndexOf('/') + 1);
};

function handleDrop(e: DragEvent) {
    // alert('aaaaaaaaaaaa' );
    // e.stopPropagation();
    console.log(e);
}
// Hàm tạo slug
function toSlug(str: string): string {
    // Chuyển đổi sang slug
    str = str.toLowerCase();
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');
    str = str.replace(/([^0-9a-z-\s])/g, '');
    str = str.replace(/(\s+)/g, '-');
    str = str.replace(/-+/g, '-');
    str = str.replace(/^-+/g, '');
    str = str.replace(/-+$/g, '');
    return str;
}
// Watch để theo dõi sự thay đổi của product_name và cập nhật slug
watch(
    () => formData.value.product_name,
    (newValue) => {
        formData.value.slug_name_product = toSlug(newValue);
    }
);
const errors = ref({});
const getFilesArray = (files) => {
    const filesArray = []; // Khởi tạo một mảng trống
    console.log(files);
    files.forEach((file) => {
        if (file.originFileObj) {
            // Nếu là file mới được chọn
            filesArray.push(file.originFileObj); // Thêm file gốc vào mảng
        } 
    });
    return filesArray; // Trả về mảng chứa các file
};

const submitForm = async () => {
    // Process formData and fileList as needed
    // console.log('Form Data:', formData.value);
    
    fileList.value = fileList.value.filter(function(item){
        return item.status === 'done'
    });
    try{
        if(fileList.value.length > 0){
            errors.value = {};
            // const payload = {
            //     formData: formData.value,
            //     url_img : getFilesArray(fileList.value),//lỗi hàm này
            // };
            const formDataToSend = new FormData();

            // Thêm các trường dữ liệu biểu mẫu
            for (const key in formData.value) {
                formDataToSend.append(key, formData.value[key]);
            }

            // Thêm các file vào FormData (cả file đã tồn tại và file mới)
            fileList.value.forEach(fileItem => {
                if (fileItem.url) {
                    // Nếu có URL, đây là file đã tải lên trước đó
                    formDataToSend.append('url_img[]', fileItem.url); 
                } else if (fileItem.originFileObj) {
                    // Nếu file mới (File hoặc Blob), thêm vào FormData
                    formDataToSend.append('url_img[]', fileItem.originFileObj); 
                }
            });
            console.log('File List Before Submit:', fileList.value); 
                //console.log(getFilesArray(fileList.value));
                if (route.params.slug) {
                    const response = await apiClient.postData(`/update-product/${route.params.slug}`, formDataToSend, {
                        headers: {
                            'Content-Type': 'multipart/form-data', 
                        },
                    });
                    // console.log('ket qua: ' + response.data);
                    toast.success("Cập nhật thành công!");
                } else {
                    // Nếu không có slug, thì là thêm mới
                    const response = await apiClient.postData('/add-product', formDataToSend, {
                        headers: {
                            'Content-Type': 'multipart/form-data', // hoặc 'multipart/form-data' nếu bạn sử dụng FormData
                        },
                    });
                    console.log('ket qua: ' + response.data);
                    toast.success("Thêm thành công!");
                }
            router.push('/admin/product');
        }else{
            alert('Sản Phẩm phải có ít nhất 1 ảnh !!');
        }
    }catch (error){
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
        } else {
            // console.log('An unexpected error occurred:', error);
        }
    }
};

const fetchProduct = async () => {
    try {
        const response = await apiClient.fetchData(`/car-detail/${route.params.slug}`);
        const product = response[0];
        // console.log(response);
        // Điền dữ liệu vào form
        formData.value.product_name = product.name;
        formData.value.slug_name_product = product.slug;
        formData.value.product_desc = product.description;
        formData.value.price = product.price_per_day;
        formData.value.noi_bat = product.noi_bat;
        formData.value.brand_id = product.brand_id;
        formData.value.spec_body = product.specification.body;
        formData.value.spec_seat = product.specification.seat ;
        formData.value.spec_door = product.specification.door;
        formData.value.spec_interiorColor = product.specification.interiorColor;
        // console.log(product.get_image_cars);
        // Dữ liệu từ API
        const images = product.get_image_cars;
        // Chuyển đổi dữ liệu từ API thành định dạng UploadFile
        fileList.value  = images.flatMap((image: any) => 
            image.url_img.map((img: string) => ({
                name: img.replace("http://127.0.0.1:8000/storage/images/", ""), // Tên file từ mảng url_img
                status: 'done',
                url: `${img}`, // URL thực tế của ảnh
                type: `image/${img.slice(-3)}`
                // url: 'http://127.0.0.1:8000/storage/images/1727357344_images (3).jpg',
            }))
        );
        // Cập nhật fileList
        // console.log('file : ' + response[0]);
        // fileList.value = updatedFileList;
        // console.log('Updated fileList:', fileList.value);
        
        
    } catch (error) {
        // if (error.status === 404) {
        //     // Nếu id không tồn tại, điều hướng về trang 404
        //     router.push('/404');
        // } 
    }
};
const getAllBrandName = async () => {
        try {
            const response = await apiClient.fetchData('/admin/get-all-brand',{});
            brand_cars.value = response;
            // console.log(brand_cars.value);
            // await new Promise(resolve => setTimeout(resolve, 2000));
            // return brand_cars.value;
        } catch (err) {
            // console.log('Error fetching brands cars:', err);
        }   
    };

// Khi component được mount, kiểm tra xem có id hay không
onMounted(async() => {
    await getAllBrandName();
    if (route.params.slug) {
        await fetchProduct();
    }
});
</script>

<style scoped>

.upload-list-inline :deep(.ant-upload-list-item) {
    float: left;
    width: 20%;
    margin-right: 8px;
}
@media (max-width: 576px) {
    .upload-list-inline :deep(.ant-upload-list-item){
        width: 100%;
    }
}
.upload-list-inline [class*='-upload-list-rtl'] :deep(.ant-upload-list-item) {
    float: right;
}
/* .ant-upload-wrapper .ant-upload-list .ant-upload-list-item-container{
    width: 20%!important;
} */
.ant-upload-select-picture-card i {
    font-size: 32px;
    color: #999;
}

.ant-upload-select-picture-card .ant-upload-text {
    margin-top: 8px;
    color: #666;
}
</style>
