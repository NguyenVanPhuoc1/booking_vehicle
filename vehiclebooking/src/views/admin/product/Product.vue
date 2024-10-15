<template>
    <div>
        <a-skeleton :loading="loading" avatar :paragraph="{ rows: 10 }" active>
            <div class="brandmane-page mb-3">
                <h3 class="fw-bold px-3">Quản Lí</h3>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <ul class="d-flex list-unstyled m-0">
                                <li class="nav-item py-0 justify-content-sm-start">
                                    <router-link class="btn btn-primary" :to="{name: 'admin-product-crud'}"><font-awesome-icon :icon="['fas', 'plus']" /> Thêm Mới</router-link>
                                </li>
                                <li class="nav-item py-0 ps-4">
                                    <button @click="showModalDelete" class="btn btn-danger"><font-awesome-icon :icon="['fas', 'trash']" /> Xóa Tất Cả</button>
                                </li>
                            </ul>    
                        </div>
                    </div>
                    <a-breadcrumb class="my-4">
                        <a-breadcrumb-item>Bảng Điều Khiển</a-breadcrumb-item>
                        <a-breadcrumb-item><a class="text-primary text-decoration-none" href="">Quản Lí Sản Phẩm</a></a-breadcrumb-item>
                    </a-breadcrumb>
                </div>
            </div>
    
            <!-- my table brand -->
            <div class="my-table-brand rounded my-5 bg-white border">
                <h4 class="fw-bold p-2">Product</h4>
                <div class="m-4 card card-primary card-outline text-sm mb-0" v-if="cars_list.length  > 1 ">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-bordered table-resizable rounded " >
                            <thead>
                                <tr>
                                    <th class="align-middle" >
                                        <div class="custom-control custom-checkbox my-checkbox text-center">
                                            <input type="checkbox" class="custom-control-input" id="selectall-checkboxbrand" v-model="selectAll" @change="toggleSelectAll">
                                            <label for="selectall-checkboxbrand" class="custom-control-label"></label>
                                        </div>
                                    </th>
                                    <th scope="col" class="align-middle text-center" >STT</th>
                                    <th scope="col" class="align-middle text-center" style="min-width: 20%;">Ảnh Sản Phẩm</th>
                                    <th scope="col" class="align-middle text-center" style="min-width: 250px;" >Tên Hãng</th>
                                    <th scope="col" class="align-middle text-center" style="min-width: 100px;" >Giá</th>
                                    <th scope="col" class="align-middle text-center" style="min-width: 5%;">Nổi Bật</th>
                                    <th scope="col" class="align-middle text-center" style="min-width: 40px;">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" v-for="(item,index) in cars_list" :key="item._id">
                                    <th scope="row " class="align-middle"> 
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" :value="item._id" v-model="selectedItems" :id="'check-index' + item._id ">
                                            <label :for="'check-index-' + item._id" class="form-check-label"></label>
                                        </div>
                                    </th>
                                    <td class="align-middle">
                                        {{ index + 1 }}
                                    </td>
                                    <td class="align-middle"><img :src="item.get_image_cars[0].url_img[0]" alt="Logo" height="80" width="80" /></td>
                                    <td class="align-middle">{{ item.name }}</td>
                                    <td class="align-middle">
                                        <span class="fw-bold">$ {{ item.price_per_day }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" :checked="item.noi_bat" v-model="item.noi_bat"
                                            @change="handleCheckboxChange($event, item._id)" :id="'check-brand-noibat-' + item._id">
                                            <label :for="'check-brand-noibat-' + item._id" class="form-check-label"></label>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="operation d-flex justify-content-center" >
                                            <div class="mx-2">
                                                <router-link :to="{ name: 'admin-product-edit', params: { slug: item.slug } }" class="btn btn-primary"><font-awesome-icon :icon="['far', 'pen-to-square']" /> </router-link>
                                            </div>
                                            <div class="mx-2">
                                                <button @click="deleteItem(item._id)" class="btn btn-danger">
                                                    <font-awesome-icon :icon="['fas', 'trash']" />
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Bootstrap Pagination -->
                    <nav class="py-3" aria-label="Page navigation" v-if="totalPages > 1">
                        <ul class="pagination">
                            <li class="page-item" :class="{ disabled: currentPage === 1 }">
                            <a class="page-link" @click="fetchCustomers(currentPage - 1)">Previous</a>
                            </li>
                            <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: page === currentPage }">
                            <a class="page-link" @click="fetchCustomers(page)">{{ page }}</a>
                            </li>
                            <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                            <a class="page-link" @click="fetchCustomers(currentPage + 1)">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div v-else>
                    <div class="alert alert-danger">
                        <!-- Nội dung khi điều kiện customers.length là false -->
                        <p>Không có sản phẩm nào được tìm thấy.</p>
                    </div>
                </div>
            </div>
        </a-skeleton>
        <!-- Modal hiển thị thông báo -->
        <a-modal v-model:open="open"  title="Xóa Tất Cả"
            :ok-text="'Yes'"
            :ok-type="'danger'"
            :cancel-text="'No'"
            @ok="handleOk"
            @cancel="handleCancel" >
            <p>{{ messageModal }}</p>
        </a-modal>
    </div>
</template>
<script setup>
import { ref,reactive, watch, onMounted } from 'vue';
import axios from 'axios';
import { useStore } from 'vuex';
const store = useStore();
const apiClient = store.getters.apiClient;
import { useToast } from "vue-toastification";
import { message } from 'ant-design-vue';

import logo from '@/assets/front/images/car-2.png';
const logoUrl = logo;
const cars_list = ref([]);
const loading = ref(false);
const selectAll = ref(false);
const selectedItems = ref([]);
const deleteditem = ref();
const toast = useToast();
const totalPages = ref(1); // Tổng số trang
const currentPage = ref(1); 
const perPage = ref(10);

const getAllProducts = async (page = 1, perPage) => {
        try {
            loading.value = true;
            const response = await apiClient.fetchData('admin/get-all-products',{page, per_page: perPage});
            cars_list.value = response.data;
            totalPages.value = response.last_page; // Tổng số trang
            currentPage.value = response.current_page;
            // console.log(cars_list.value);
            // await new Promise(resolve => setTimeout(resolve, 2000));
            return cars_list.value;
        } catch (err) {
            console.log('Error fetching cars:', err);
        }   finally {
            loading.value = false;
        }
    };

const toggleSelectAll = async (event) => {
    const isChecked = event.target.checked;
    // await getAllBrandName(); // Đợi dữ liệu được lấy về
    if (isChecked) {
        selectedItems.value = cars_list.value.map(item => item._id);
    } else {
        selectedItems.value = [];
    }
};
onMounted(async () => {
    document.title = "Quản Lí Sản Phẩm";
    await getAllProducts();
}); 
const handleCheckboxChange = async (event, id) => {
    const isChecked = event.target.checked;
    try {
        const response = await apiClient.updateData(`/update-product_noibat/${id}`, {
            noi_bat: isChecked
        });
        console.log('Update successful:', response.data);
    } catch (error) {
        console.error('Error updating item:', error);
    }
};


const messageModal = ref('');
const open = ref(false);

const showModalDelete = () => {
    messageModal.value = 'Bạn có muốn xóa tất cả các phần tử được chọn không?'
    open.value = true;
};

const handleOk = () => {
    if(selectedItems.value.length > 0){
        // console.log('các phần tử được chọn: ' +  selectedItems.value.length);
        deleteSelectedBrands(selectedItems);
    }else{

        alert('Vui Lòng chọn phần từ trước khi xóa!');
        open.value = false;
    }
};

const handleCancel = () => {
    open.value = false;
}
const getToken = async () => {
    await axios.get("/sanctum/csrf-cookie");
};
const deleteSelectedBrands = async (selectedItems) => {
    try {
        await getToken();
        // console.log('phan tu duoc chon: ' + selectedItems.value);
        const response = await apiClient.postData('/delete-selected-products', {
            ids: selectedItems.value
        });
        if(response.status === 200){
            toast.success("Xóa thành công!");
        }else{
            alert(response.data.error);
        }
        // console.log('Xóa thành công:', response.data);

        // Cập nhật lại danh sách sau khi xóa
        await getAllProducts();
    } catch (error) {
        alert('Lỗi khi xóa các mục:'+ error.response.data.error);
    } finally {
        open.value = false; // Đóng modal sau khi xử lý
    }
};
const deleteItem = async (id) => {
    // Thêm mục vào danh sách các mục được chọn
    deleteditem.value = [id];
    
    // Gọi hàm deleteSelectedBrands để xóa mục
    await deleteSelectedBrands(deleteditem);
};
</script>
