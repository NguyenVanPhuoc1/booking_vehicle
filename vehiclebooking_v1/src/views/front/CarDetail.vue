<template>
    <div>
        <!-- Car Dtail title -->
        <div class="vel-booking" :style="{ marginTop: -headerHeight + 'px' }">
            <div class="container">
                <div class="row align-items-center d-flex">
                    <h1 class="text-white fw-bold fs-1 text-center">
                        Vehicle Fleet 
                    </h1>
                </div>
            </div>
        </div>
        <!-- Car Detail -->
        <div class="product-detail py-5">
            <div class="container">
                <div class="row">
                    <!-- product image -->
                    <div class="col-12 col-lg-6">
                        <a-carousel
                            arrows
                            :dots="false"
                            dots-class="slick-dots slick-thumb"
                            ref="carouselRef"
                        >
                            <div v-for="item in images.length" :key="item">
                                <img
                                    :src="getImgUrl(item - 1)"
                                    class="carousel-img w-100 object-fit-cover"
                                />
                            </div>
                        </a-carousel>
                        <div class="row my-3 thumbimg-list justify-content-center">
                            <div class="col-3" v-for="item in images.length" :key="item">
                                <img
                                    :src="getImgUrl(item - 1)"
                                    :class="{ active: currentSlide === item - 1 }"
                                    class="thumbimg-item w-100 rounded object-fit-cover"
                                    @click="goToSlide(item - 1)"
                                    style="max-height: 79px;"
                                />
                            </div>
                        </div>
                        <div class="car-introduction py-3">
                            <h6 class="fw-bold p-2 rounded-3 bg-primary d-inline"><font-awesome-icon :icon="['fas', 'car']" /> GIỚI THIỆU XE</h6>
                            <div class="car-introcontent my-3 ">
                                <div class="role p-4 border border-primary">
                                    <h5 class="fw-bold">THUÊ XE CỦA CHÚNG TÔI</h5>
                                    <p>
                                        <span style="color: #003478;"><strong>♦ Sự đảm bảo về chất lượng xe thuê </strong></span>
                                    </p>
                                    <p>
                                        <span style="color: #003478;"><strong>♦ Dịch Vụ Chuyên Nghiệp </strong></span>
                                    </p>
                                    <p>
                                        <span style="color: #003478;"><strong>♦ Tài Xế </strong></span>
                                    </p>
                                    <p>– Hỗ trợ lệ phí lưu hành xe, phí bảo hiểm xe và phí bảo hiểm hành khách trên xe.<br>– Hỗ trợ khách hàng thăm quan, kiểm tra xe trước khi ký hợp đồng.<br>– Tài xế biết tiếng Anh nên có thể giao tiếp khi gặp khách là người nước ngoài.
                                        <br>– Tài xế được tập huấn kỹ lưỡng, đảm bảo chuyên môn, nhiều năm kinh nghiệm.<br>– Chịu trách nhiệm khi có chuyện bất trắc xảy ra (tai nạn, phạt giao thông,…).
                                    </p>
                                    <p><span style="color: #ff0000;">Lưu ý:</span> Nếu tài xế của chúng tôi sử dụng bia, rượu, chất kích thích trong giờ làm việc. Khi nhận được phản ánh của khách hàng, tài xế sẽ LẬP TỨC bị sa thải.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product detail + form booking -->
                    <div class="col-12 col-lg-3 px-4">
                        <div class="product-name">
                            <!-- name -->
                            <h4 class="fw-bold">{{ carDetail.name }}</h4>
                            <p class="product-description text-secondary">
                                {{ carDetail.description }}
                            </p>
                        </div>
                        <div class="product-specification my-4">
                            <h5 class="fw-bold">Specifications</h5>
                            <div class="de-spec" v-if="arr_spec">
                                <!-- list speci -->
                                <ul v-for="(value, key) in arr_spec" :key="key" class="list-group list-group-flush">
                                    <li v-if="value !== null" class="list-group-item d-flex justify-content-between">
                                        <!-- hàm viết hoa kí tự đầu -->
                                        <span class="d-title">{{ key.charAt(0).toUpperCase() + key.slice(1) }}</span>
                                        <span class="d-value fw-bold">{{ typeof value === 'string' ? value.slice(0, 10) : value }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="de-spec text-secondary" v-else> Đang cập nhật ...</div>
                        </div>
                        <!-- product feature -->
                        <div class="product-feature">
                            <h5 class="fw-bold">Features</h5>
                            <div class="list-feature">
                                <div class="pro-feat-item d-flex">
                                    <font-awesome-icon
                                        class="text-success"
                                        :icon="['fas', 'check']"
                                    />
                                    <div class="profeat-val mx-3">Bluetooth</div>
                                </div>
                                <div class="pro-feat-item d-flex">
                                    <font-awesome-icon
                                        class="text-success"
                                        :icon="['fas', 'check']"
                                    />
                                    <div class="profeat-val mx-3">
                                        Multimedia Player
                                    </div>
                                </div>
                                <div class="pro-feat-item d-flex">
                                    <font-awesome-icon
                                        class="text-success"
                                        :icon="['fas', 'check']"
                                    />
                                    <div class="profeat-val mx-3">Central Lock</div>
                                </div>
                                <div class="pro-feat-item d-flex">
                                    <font-awesome-icon
                                        class="text-success"
                                        :icon="['fas', 'check']"
                                    />
                                    <div class="profeat-val mx-3">Sunroof</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div
                            class="product-rate rounded bg-secondary text-center py-4"
                        >
                            <p class="fs-4 rate-title">Daily rate</p>
                            <h1 class="fw-bold">${{ carDetail.price_per_day }}</h1>
                        </div>
                        <!-- form booking product -->
                        <div
                            class="product-booking rounded border border-secondary my-4"
                        >
                            <form class="product-form-booking p-4" action="#" @submit.prevent="bookingSubmit">
                                <h5 class="booking-title fw-bold">
                                    Booking this car
                                </h5>
                                <div class="col-12 mt-3">
                                    <h6 class="fw-bold">Your Name</h6>
                                    <!-- Your Name -->
                                    <InputField v-model="user_name"
                                    :class="['fw-bold', 'text-secondary']"
                                    placeholder="Your Name"
                                    :readonly="readonly"
                                    />
                                </div>
                                <div class="col-12 mt-3">
                                    <h6 class="fs-6 fw-bold">Pick Up Location</h6>
                                    <!-- Pick up location -->
                                    <InputField v-model="formData.pickUpLocation"
                                        placeholder="Enter your Pick Up Location"
                                        :error="errors.pickup_location" />
                                </div>
                                <div class="col-12 mt-3">
                                        <h6 class="fw-bold">Destination</h6>
                                        <!-- Destination -->
                                        <InputField v-model="formData.destination"
                                        placeholder="Enter your Destination"
                                        :error="errors.destination" />
                                    </div>
                                <div class="col-12 mt-3">
                                    <h6 class="fw-bold">Started Date & Time</h6>
                                    <!-- Ngày bắt đầu -->
                                    <DateTimePicker v-model="formData.startDate" :error="errors.start_date" />
                                </div>
                                <div class="col-12 mt-3">
                                    <h6 class="fw-bold">End Date & Time</h6>
                                    <!-- Ngày kết thúc -->
                                    <DateTimePicker v-model="formData.endDate" :error="errors.end_date" />
                                </div>
                                <div class="col-12 mt-3">
                                    <button
                                        type="submit"
                                        class="w-100 btn btn-success"
                                    >
                                        Book Now
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- share network -->
                        <div
                            class="product-share rounded border border-secondary p-4"
                        >
                            <h5 class="share-title fw-bold">Share</h5>
                            <button class="share_facebook btn btn-primary ">
                                <!-- share social -->
                                <ShareNetwork class="text-decoration-none"
                                    network="facebook"
                                    :url="shareUrl "
                                    :title="carDetail.name"
                                    description="Khám phá Xe Thể Thao XYZ, một chiếc xe mang lại hiệu suất cao và thiết kế sang trọng. Chạy thử ngay hôm nay!"
                                    quote="Chiếc xe này là sự kết hợp hoàn hảo giữa công nghệ và phong cách."
                                    media="https://nongsannvp.store/vehiclebooking_be/storage/app/public/images/toyota-supra.jpg"
                                    hashtags="booking-vehicle app"
                                >
                                    Share on Facebook
                                </ShareNetwork>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup >
import { ref, onMounted, computed, watch} from "vue";
import { Modal } from 'ant-design-vue';
import InputField from '@/components/InputField.vue';
import DateTimePicker from "@/components/DateTimePicker.vue";
// thư viện vuex
import { useStore } from "vuex";
import { useRoute,useRouter } from 'vue-router';
import axios from 'axios';
//import apiClient from '@/services/ApiClient';
onMounted(() => {
    document.title = "Car Detail";
});
const store = useStore();
const apiClient = store.getters.apiClient;
const router = useRouter();
// set chiều cao cho header với carrousel
const headerHeight = computed(() => store.getters.headerHeight);

// image product
const carouselRef = ref(null);
const currentSlide = ref(0);

const images = ref([]);

const getImgUrl = (index) => {
    return images.value[index];
};
const goToSlide = (index) => {
    if (carouselRef.value) {
        carouselRef.value.goTo(index);
        currentSlide.value = index;
    }
};

// get data detail
const route = useRoute();//dùng useRoute để get slug hiện tại còn useRouter là dùng route điều hướng
const slug = route.params.slug;
const carDetail = ref({ });
const arr_spec = ref(null);
const arr_image = ref(null);
const fetchCarDetail = async () => {
    try {
        const response = await apiClient.fetchData(`/car-detail/${slug}`);
        if(response.status === 404){
            router.push('/404');
        }else{
            carDetail.value = response[0]; 
            const imageCars = carDetail.value.get_image_cars;
            arr_image.value = (imageCars.length > 0) ? imageCars[0].url_img : [];
            images.value = [...arr_image.value];
            //dùng cú pháp destructuring để loại bỏ các trường k cần thiết
            if (carDetail.value.specification) {
                const { _id, car_id, car_slug, ...rest } = carDetail.value.specification;
                arr_spec.value = rest;
            } else {
                arr_spec.value = null; 
            }
            // console.log(arr_image.value);
        }
        // return carDetail.value;
    } catch (error) {
        // console.error('Error fetching car detail:', error);
        router.push('/404');
    }
};

onMounted(async () => {
    await fetchCarDetail();
});

//booking car
const errors = ref({});
const getToken = async () => {
    await axios.get("/sanctum/csrf-cookie");
};
const userInfo = store.getters.user;
const readonly = ref(true);
// console.log(userInfo);
const user_name = userInfo ? ref(userInfo.name) : "Nguyễn Văn A";
const formData = ref({
    selectedOption: "",
    pickUpLocation: '',
    destination: '',
    startDate: null,
    endDate: null,
    name: user_name ? user_name.value : "",
    email: userInfo ? userInfo.email : "",
    phone: userInfo ? userInfo.phone : "0123456789",
    request: ''
});
watch(carDetail, (newDetail) => {
    if (newDetail && newDetail.name && newDetail.price_per_day) {
        formData.value.selectedOption = newDetail.name.concat(' - $' + newDetail.price_per_day);
    }
});
const bookingSubmit = async() => {
    if(!userInfo){
        alert('Bạn cần đăng nhập để thực hiện tính năng này!');
        return;
    }else{
        try {     
            errors.value = {};
            
            // Lấy CSRF token
            await getToken();
            // Gửi dữ liệu booking đến server
            const response = await apiClient.postData('/booking', {
                selected_car: formData.value.selectedOption,
                pickup_location: formData.value.pickUpLocation,
                destination: formData.value.destination,
                start_date: formData.value.startDate,
                end_date: formData.value.endDate,
                cus_name: formData.value.name,
                cus_email: formData.value.email,
                cus_phone: formData.value.phone,
                cus_request: formData.value.request,
            })
            if (response.status === 201) {
                Modal.success({
                    title: 'Đăng Kí',
                    content: 'Đăng Kí thành công!',
                });
            }
        } catch (error) {
            errors.value = error.response.data.errors;
            console.log(errors.value);
            Modal.error({
                title: 'Đăng Kí',
                content: 'Đăng Kí thất bại!',
            });
        }
    }
}
const shareUrl = 'https://booking-vehicle-hibw.vercel.app/car-detail/toyota-supra';

</script>

<style scoped>
.carousel-img {
    width: 100%;
    height: 300px;
    object-fit: cover;
}
.thumbimg-item {
    opacity: 0.5;
    box-shadow: 5px 5px 20px 0px rgba(0, 0, 0, 0.5);
    cursor: pointer;
    transition: opacity 0.3s ease-in-out;
}
.thumbimg-list .active {
    opacity: 1;
}
</style>
