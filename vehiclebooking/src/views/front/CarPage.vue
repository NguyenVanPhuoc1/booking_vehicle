<template>
    <a-spin :spinning="isLoading" tip="Loading..." size="large">
    <!-- car title page -->
    <div class="vel-booking" :style="{ marginTop: -headerHeight + 'px' }">
        <div class="container">
            <div class="row align-items-center d-flex">
                <h1 class="text-white fw-bold fs-1 text-center">Cars</h1>
            </div>
        </div>
    </div>
    <div class="car-store my-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="fill_val">
                        <form action="#" id="carsStore" class="fill_value">
                            <!-- vehicle type -->
                            <div class="card vehicle-type">
                                <div class="card-body m-3">
                                    <h5 class="fw-bold mb-2">Vehicle Brand</h5>
                                    <div class="form-check" v-for="(item,index) in arr_brand" :key="item._id">
                                        <input
                                            class="form-check-input border-success"
                                            type="checkbox"
                                            :value="item._id"
                                            :id="'brand' + index"
                                            v-model="selected.brand_id"
                                        />
                                        <label
                                            class="form-check-label"
                                            :for="'brand' + index"
                                            >{{ item.brand_name }}</label
                                        >
                                    </div>
                                </div>
                            </div>
                            <!-- Car Body Type -->
                            <div class="card car-body-type my-4">
                                <div class="card-body m-3">
                                    <h5 class="fw-bold mb-2">Car Body Type</h5>
                                    <div class="form-check" v-for="(item,index) in car_body" :key="item._id">
                                        <input
                                            class="form-check-input border-success"
                                            type="checkbox"
                                            :value="item.body_name"
                                            :id="'car_body' + index"
                                            v-model="selected.body_name"
                                        />
                                        <label
                                            class="form-check-label"
                                            :for="'car_body' + index"
                                            >{{ item.body_name }}</label
                                        >
                                    </div>
                                </div>
                            </div>
                            <!-- Car Seats -->
                            <div class="card car-seats my-4">
                                <div class="card-body m-3">
                                    <h5 class="fw-bold mb-2">Car Seats</h5>
                                    <div class="form-check" v-for="(item,index) in car_seats" :key="item._id">
                                        <input
                                            class="form-check-input border-success"
                                            type="checkbox"
                                            :value="item.car_seats"
                                            :id="'seatIndex' + index"
                                            v-model="selected.car_seats"
                                        />
                                        <label
                                            class="form-check-label"
                                            :for="'seatIndex' + index"
                                            >{{ item.car_seats + ' Seats' }}</label
                                        >
                                    </div>
                                </div>
                            </div>
                            <!-- Cars Price -->
                            <div class="card car-seats my-4">
                                <div class="card-body m-3">
                                    <h5 class="fw-bold mb-2">Price ($)</h5>
                                    <div class="#">
                                        <div
                                            class="d-flex justify-content-between"
                                        >
                                            <p>
                                                Min:
                                                <span class="fw-bold">{{
                                                    priceRange[0]
                                                }}</span>
                                            </p>
                                            <p>
                                                Max:
                                                <span class="fw-bold">{{
                                                    priceRange[1]
                                                }}</span>
                                            </p>
                                        </div>
                                        <a-slider
                                            range
                                            v-model:value="priceRange"
                                            :min="0"
                                            :max="2000"
                                            :step="10"
                                        ></a-slider>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- car list-->
                <div class="col-12 col-lg-9">
                    <div class="row">
                        <!-- car item -->
                        <div
                            class="col-12 col-md-6 col-lg-4"
                            v-for="car in cars"
                            :key="car._id"
                        >
                            <div class="car-item rounded p-2 border">
                                <div class="car-image">
                                    <img
                                        :src="'../../../src/assets/front/images/' + car.get_image_cars[0].url_img[0]"
                                        class="d-block w-100 rounded"
                                        :alt="`Ảnh sản phẩm ${car.name}`"
                                    />
                                </div>
                                <div class="car-detail">
                                    <!-- name -->
                                    <div
                                        class="p-3 car-name_fav d-flex align-items-center justify-content-between text-black border-bottom"
                                    >
                                        <div class="car-name fw-bold">
                                            {{ car.name }}
                                        </div>
                                        <div
                                            class="car-fav d-flex align-items-center"
                                        >
                                            <font-awesome-icon
                                                :icon="['far', 'heart']"
                                            />
                                            <span>{{ car.favorites }} 15</span>
                                        </div>
                                    </div>
                                    <!-- price -->
                                    <div class="daily-rate p-3">
                                        <p class="text-black m-0">
                                            Daily rate from
                                        </p>
                                        <div
                                            class="car-rental d-flex align-items-center justify-content-between"
                                        >
                                            <div
                                                class="rental-price text-black fz-5 fw-bold"
                                            >
                                                ${{ car.price_per_day }}
                                            </div>
                                            <button class="btn btn-success fw-bold" @click="viewDetails(car.slug)">Rent Now</button>
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
     
    </a-spin>
</template>
<script setup>
import { ref, reactive, watch, onMounted , computed } from "vue";
// thư viện vuex
import { useStore } from "vuex";
import { useRoute } from 'vue-router';
import axios from 'axios';
import apiClient from '@/services/ApiClient';
import _ from 'lodash';
onMounted(() => {
    document.title = "Store";
});
const store = useStore();
// set chiều cao cho header với carrousel
const headerHeight = computed(() => store.getters.headerHeight);

// Sử dụng hook ref để tạo biến priceRange
const priceRange = ref([50, 800]);
const car_seats = ref([
    { _id: 1, car_seats: 2},
    { _id: 2, car_seats: 4},
    { _id: 3, car_seats: 6},
]);
const car_body = ref([
    { _id: 1, body_name: 'Couple'},
    { _id: 1, body_name: 'Sedan'},
    { _id: 1, body_name: 'Minivan'},
])

const cars = ref([]);
const isLoading = ref(true);

// fetch data
const error = ref({});
const arr_brand = ref([]);
// const selectedBrands = ref([]);
// lấy tên các brand
    const getAllBrandName = async () => {
        try {
            error.value = null;
            const response = await apiClient.fetchData('/get-name-brand',{});
            arr_brand.value = response;
            // console.log('data' + arr_brand.value);
            // await new Promise(resolve => setTimeout(resolve, 2000));
            return;
        } catch (err) {
            console.log('Error fetching cars:', err);
        }   
    };
// gửi các checkbox selected của Brand tới laravel xủ lí và return response

onMounted(async () => {
    await getAllBrandName();
    await loadProducts();
});
// name param send url
const selected = reactive({
    brand_id: [],
    body_name: [],
    car_seats: [],
});
// const products = ref([]);
const loadProducts = async () => {
    try {
        const response = await apiClient.fetchData('/get-filter-products', {
            params: { ...selected, priceRange: priceRange.value }
        });
        cars.value = response;
        isLoading.value = false;
        // console.log(cars.value);
        return await new Promise(resolve => setTimeout(resolve, 2000));;
    } catch (error) {
        console.log(error);
    }
};
// Hàm xử lý khi giá trị của slider thay đổi
// const loadPrice = (value) => {
//     priceRange.value = value;
//     console.log("Selected Price Range:", priceRange.value);
// };
watch(
    [() => selected, () => priceRange.value],
    (newVal) => {
        loadProducts();
    },
    { deep: true } // Theo dõi sâu các thay đổi trong selected.brand
);
// view detail car
import useViewDetails from '@/services/utils';
const { viewDetails } = useViewDetails(); // Sử dụng hàm chung

    const navigateToDetails = async (slug) => {
        await viewDetails(slug);
    };
</script>

<style>
</style>