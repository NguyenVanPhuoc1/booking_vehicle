<template>
    <a-skeleton :loading="loading" avatar :paragraph="{ rows: 10 }" active>
        <template #default>
            <div class="brandmane-page mb-3">
                <h3 class="fw-bold px-3">Quản Lí</h3>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <ul class="d-flex list-unstyled m-0">
                                <li class="nav-item py-0 justify-content-sm-start">
                                    <router-link class="btn btn-primary" :to="{name: 'admin-brand-product-crud'}"><font-awesome-icon :icon="['fas', 'plus']" /> Thêm Mới</router-link>
                                </li>
                                <li class="nav-item py-0 ps-4">
                                    <div class="btn btn-danger"><font-awesome-icon :icon="['fas', 'trash']" /> Xóa Tất Cả</div>
                                </li>
                            </ul>    
                        </div>
                    </div>
                    <a-breadcrumb class="my-4">
                        <a-breadcrumb-item>Bảng Điều Khiển</a-breadcrumb-item>
                        <a-breadcrumb-item><a class="text-primary text-decoration-none" href="">Quản Lí Hãng</a></a-breadcrumb-item>
                    </a-breadcrumb>

                    <!-- my table brand -->
                    <div class="my-table-brand rounded my-5 bg-white border">
                        <h4 class="fw-bold p-2">Brand Product</h4>
                        <div class="m-4">
                            <table class="table table-hover table-bordered table-resizable rounded" >
                                <thead>
                                    <tr>
                                        <th class="align-middle" style="width: 5%;">
                                            <div class="custom-control custom-checkbox my-checkbox text-center">
                                                <input type="checkbox" class="custom-control-input" id="selectall-checkboxbrand" v-model="selectAll" @change="toggleSelectAll">
                                                <label for="selectall-checkboxbrand" class="custom-control-label"></label>
                                            </div>
                                        </th>
                                        <th scope="col" class="align-middle text-center" style="width: 10%;">STT</th>
                                        <th scope="col" class="align-middle text-center" style="width: 40%;" >Tên Hãng</th>
                                        <th scope="col" class="align-middle text-center">Nổi Bật</th>
                                        <th scope="col" class="align-middle text-center">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center" v-for="(item,index) in brand_cars" :key="item._id">
                                        <th scope="row"> 
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input" type="checkbox" :value="item._id" v-model="selectedItems" :id="'check-index' + item._id ">
                                                <label :for="'check-index-' + item._id" class="form-check-label"></label>
                                            </div>
                                        </th>
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ item.brand_name }}</td>
                                        <td>
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input" type="checkbox" :checked="item.noi_bat" v-model="item.noi_bat" :id="'check-brand-noibat-' + item._id">
                                                <label :for="'check-brand-noibat-' + item._id" class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="operation d-flex justify-content-center" >
                                                <div class="mx-2">
                                                    <router-link :to="''" class="btn btn-primary"><font-awesome-icon :icon="['far', 'pen-to-square']" /> </router-link>
                                                </div>
                                                <div class="mx-2">
                                                    <router-link :to="''" class="btn btn-danger"><font-awesome-icon :icon="['fas', 'trash']" /> </router-link>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </a-skeleton>
</template>
<script setup>
import { ref,reactive, watch, onMounted } from 'vue';
import axios from 'axios';
import apiClient from '@/services/ApiClient';

const brand_cars = ref([]);
const loading = ref(false);
const selectAll = ref(false);
const selectedItems = ref([]);

const getAllBrandName = async () => {
        try {
            loading.value = true;
            const response = await apiClient.fetchData('/admin/get-all-brand',{});
            brand_cars.value = response;
            // await new Promise(resolve => setTimeout(resolve, 2000));
            return brand_cars.value;
        } catch (err) {
            console.log('Error fetching cars:', err);
        }   finally {
            loading.value = false;
        }
    };

const toggleSelectAll = async (event) => {
    const isChecked = event.target.checked;
    await getAllBrandName(); // Đợi dữ liệu được lấy về
    if (isChecked) {
        selectedItems.value = brand_cars.value.map(item => item._id);
    } else {
        selectedItems.value = [];
    }
};
onMounted(async () => {
    document.title = "Quản Lí Hãng";
    await getAllBrandName();
}); 
// watch(selectedItems, (newValue) => {
//     selectAll.value = brand_cars.value.length > 0 && newValue.length === brand_cars.value.length;
// });
</script>