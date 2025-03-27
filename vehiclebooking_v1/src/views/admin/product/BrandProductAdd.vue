<template>
    <div>
        <div class="brandmane-page mb-3">
            <h3 class="fw-bold px-3">Quản Lí</h3>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <ul class="d-flex list-unstyled m-0">
                            <li class="nav-item py-0 justify-content-sm-start">
                                <button type="submit" class="btn btn-primary" @click.prevent="addBrandSubmit">
                                    <font-awesome-icon :icon="['fas', 'save']" />
                                    Lưu
                                </button>
                            </li>
                            <li class="nav-item py-0 ps-4">
                                <router-link class="btn btn-danger" :to="{ name: 'admin-brand-product' }">
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
    
        <section class="brand-form">
            <form class="add_brand" ref="addbrandForm">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="card card-primary card-outline text-sm mb-0">
                            <div class="card-header">
                                <h4 class="card-title fw-bold">Nội dung </h4>
                            </div>
                            <div class="card-body">
                                <div class="card card-primary card-outline card-outline-tabs">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="tabs-lang" data-toggle="pill" href="#tabs-lang-vi" role="tab"
                                                    aria-controls="tabs-lang-vi" aria-selected="true">Tiếng Việt</a>
                                            </li>                
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-body card-article">
                                                <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                                    <div class="tab-pane fade show active" id="tabs-lang-vi" role="tabpanel" aria-labelledby="tabs-lang">
                                                        <div class="form-group py-3">
                                                            <label for="cate_name ">Tên Hãng (vi):</label>
                                                            <input type="text" class="form-control for-seo text-sm my-3" name="cate_name" :class="{ 'is-invalid': errors.brand_name }"
                                                            id="cate_name" placeholder="Tên Danh Mục" v-model="cateName" @input="updateSlug" required />
                                                            <div v-if="errors.brand_name" class="invalid-feedback">
                                                                {{ errors.brand_name[0] }}
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
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="card card-primary card-outline text-sm">
                            <div class="card-header">
                                <h4 class="card-title fw-bold">Đường Dẫn </h4>
                                <p class="text-danger">Vui lòng không nhập trùng</p>
                            </div>
                            <div class="card-body">
                                <div class="form-group-category row">
                                    <div class="form-group col-xl-12 col-sm-12">
                                        <label class="d-block py-2" for="slug_name_product">Đường dẫn mẫu (vi): <span class="text-danger">https://admin.com/</span></label>
                                        <input class="form-control" type="text" name="slug_name_product" id="slug_name_product" placeholder="Đường dẫn" v-model="slugName" readonly />
                                    </div>
                                    
                                </div>
                                <div class="form-group py-3 ">
                                    <div class="check-title fw-bold my-3">Thông tin</div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"  value="" id="checknoibat" v-model="noi_bat">
                                        <label class="form-check-label" for="checknoibat">
                                            Nổi Bật
                                        </label>
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

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router'; // Dùng để lấy thông tin route và chuyển hướng
import { useToast } from 'vue-toastification';
import { useStore } from 'vuex';
const store = useStore();
const apiClient = store.getters.apiClient;
import _ from 'lodash';

import StringService from '@/services/StringService';

// Khởi tạo các biến reactive
const cateName = ref('');
const slugName = ref('');
const noi_bat = ref(false);
const addbrandForm = ref(null);
const errors = ref({});
const toast = useToast();
const route = useRoute(); // Lấy thông tin route hiện tại
const router = useRouter(); // Sử dụng router để điều hướng

// Hàm cập nhật slug
function updateSlug() {
    slugName.value = `${StringService.toSlug(cateName.value)}`;
}


// Hàm xử lý submit thêm hoặc chỉnh sửa
// console.log(route.params.id);
const addBrandSubmit = async () => {
    try {
        errors.value = {};
        const payload = {
            brand_name: cateName.value,
            brand_slug: slugName.value,
            noi_bat: noi_bat.value,
        };
        // Nếu có id trong route, thì là edit
        if (route.params.id) {
            const response = await apiClient.updateData(`/update-brand/${route.params.id}`, payload);
            // console.log(response.data);
            toast.success("Cập nhật thành công!");
        } else {
            // Nếu không có id, thì là thêm mới
            const response = await apiClient.postData('/add-brand', payload);
            toast.success("Thêm thành công!");
        }

        // Chuyển hướng về danh sách hoặc trang khác
        router.push('/admin/brand-product');
    } catch (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
        } else {
            console.log('An unexpected error occurred:', error);
        }
    }
};


// Hàm lấy dữ liệu khi edit
const fetchBrand = async () => {
    try {
        const response = await apiClient.fetchData('/get-detail-brand', {
            id: route.params.id 
        });;
        const brand = response;
        // console.log(response);
        // Điền dữ liệu vào form
        cateName.value = brand.brand_name;
        slugName.value = StringService.toSlug(brand.brand_name);
        noi_bat.value = brand.noi_bat;
    } catch (error) {
        if (error) {
            // Nếu id không tồn tại, điều hướng về trang 404
            router.push('/404');
        } 
    }
};

// Khi component được mount, kiểm tra xem có id hay không
onMounted(() => {
    if (route.params.id) {
        fetchBrand();
    }
});
</script>
