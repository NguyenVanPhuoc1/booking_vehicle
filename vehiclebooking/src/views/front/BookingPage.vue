<template>
    <div>
        <!-- booking title -->
        <div class="vel-booking"  :style="{ marginTop: -headerHeight + 'px' }">
            <div class="container">
                <div class="row align-items-center d-flex">
                    <h1 class="text-white fw-bold fs-1 text-center">Quick Booking</h1>
                </div>
            </div>
        </div>
        <!-- form booking -->
        <section class="form-booking">
            <div class="container">
                <div class="row align-items-center">
                    <!-- form đăng kí-->
                    <form class="col-12 form-booking-car bg-white rounded p-5 my-4" @submit.prevent="bookingSubmit">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="car-input">
                                    <h5 class="fw-bold">Booking a Car</h5>
                                    <select class="my-3 w-100 form-select fw-bold" v-model="formData.selectedOption" :class="{ 'is-invalid': errors.selected_car }">
                                        <option value="" disabled selected>Select a car</option>
                                        <option class="fw-bold" v-for="option in options" :key="option.value" :value="`${option.name} - ${option.price}`">
                                            {{ option.name }} - {{ option.price }}
                                        </option>
                                    </select>
                                    <div v-if="errors.selected_car" class="invalid-feedback"> 
                                        {{ errors.selected_car[0] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <h6 class="fw-bold">Pick Up Location</h6>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" :class="{ 'is-invalid': errors.pickup_location }" placeholder="Enter your Pick Up Location" v-model="formData.pickUpLocation">
                                            <div v-if="errors.pickup_location" class="invalid-feedback"> 
                                                {{ errors.pickup_location[0] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <h6 class="fw-bold">Destination</h6>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" :class="{ 'is-invalid': errors.destination }" placeholder="Enter your Destination" v-model="formData.destination">
                                            <div v-if="errors.destination" class="invalid-feedback"> 
                                                {{ errors.destination[0] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <h6 class="fw-bold">Started Date & Time</h6>
                                        <div class="mb-3">
                                            <a-date-picker class="w-100" :class="{ 'is-invalid': errors.start_date }" v-model:value="formData.startDate" @change="handleChange" />
                                            <div v-if="errors.start_date" class="invalid-feedback"> 
                                                {{ errors.start_date[0] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <h6 class="fw-bold">End Date & Time</h6>
                                        <div class="mb-3">
                                            <a-date-picker class="w-100" :class="{ 'is-invalid': errors.end_date }" v-model:value="formData.endDate" @change="handleChange" />
                                            <div v-if="errors.end_date" class="invalid-feedback"> 
                                                {{ errors.end_date[0] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <h5 class="fw-bold">Enter Your Detail</h5>
                                <div class="mb-3">
                                    <input type="text" class="form-control" :class="{ 'is-invalid': errors.cus_name }" placeholder="Your Name" v-model="formData.name">
                                    <div v-if="errors.cus_name" class="invalid-feedback"> 
                                        {{ errors.cus_name[0] }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" :class="{ 'is-invalid': errors.cus_email }" placeholder="Your Email" v-model="formData.email">
                                    <div v-if="errors.cus_email" class="invalid-feedback"> 
                                        {{ errors.cus_email[0] }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" :class="{ 'is-invalid': errors.cus_phone }" placeholder="Your Phone" v-model="formData.phone">
                                    <div v-if="errors.cus_phone" class="invalid-feedback"> 
                                        {{ errors.cus_phone[0] }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <textarea type="text" class="form-control text-secondary" v-model="formData.request">Do You Have Any Request?</textarea>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <button class="btn btn-success w-100" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                    <!-- quy trình hướng dẫn cách đăng kí -->
                    <div class="procedure my-5">
                        <div class="row text-light">
                            <div class="col-lg-12">
                                <div class="container-timeline">
                                    <ul class="d-block d-lg-flex">
                                        <li class="border-top border-success py-3">
                                            <h4 class="text-white fw-bold mt-3">Choose a vehicle</h4>
                                            <p class="text-secondary">
                                                Unlock unparalleled adventures and
                                                memorable journeys with our vast fleet of vehicles
                                                tailored to suit every need, taste, and destination.
                                            </p>
                                        </li>
                                        <li class="border-top border-success py-3">
                                            <h4 class="text-white fw-bold mt-3">Pick location & date</h4>
                                            <p class="text-secondary">
                                                Pick your ideal location and date, and let us 
                                                take you on a journey filled with convenience, 
                                                flexibility, and unforgettable experiences.
                                            </p>
                                        </li>
                                        <li class="border-top border-success py-3">
                                            <h4 class="text-white fw-bold mt-3">Make a booking</h4>
                                            <p class="text-secondary">
                                                Secure your reservation with ease, unlocking 
                                                a world of possibilities and embarking on 
                                                your next adventure with confidence.
                                            </p>
                                        </li>
                                        <li class=" py-3">
                                            <h4 class="text-white fw-bold mt-3">Sit back & relax</h4>
                                            <p class="text-secondary">
                                                Hassle-free convenience as we take care
                                                of every detail, allowing you to unwind 
                                                and embrace a journey filled comfort.
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Modal hiển thị thông báo -->
        <a-modal v-model:open="open" title="Thông báo" @ok="handleOk">
            <p>{{ modalMessage }}</p>
        </a-modal>
    </div>
</template>
<script setup> 
    import { ref, onMounted, computed } from "vue";
    // thư viện vuex
    import { useStore } from "vuex";
    import axios from "axios";
    onMounted(() => {
        document.title = "Booking";
    });
    const store = useStore();
    // set chiều cao cho header với carrousel
    const headerHeight = computed(() => store.getters.headerHeight);
    // chen ảnh trong select option
    const options = ref([
        { value: "1", name: "BMW", image: "../../assets/front/images/car-2.png", price: "$544" },
        { value: "2", name: "Two", image: "../../assets/front/images/car-2.png" , price: "$544"},
        { value: "3", name: "Three", image: "../../assets/front/images/car-2.png", price: "$544" }
    ]);
// date picker ant
// send data form booking
const formData = ref({
    selectedOption: '',
    pickUpLocation: '',
    destination: '',
    startDate: null,
    endDate: null,
    name: '',
    email: '',
    phone: '',
    request: ''
});
const errors = ref({});
const getToken = async () => {
    await axios.get("/sanctum/csrf-cookie");
};
const open = ref(false);
const modalMessage = ref('');

// Function xử lý khi nhấn nút OK trong modal
const handleOk = () => {
    open.value = false;
};
const bookingSubmit =async () => {
    try {     
        errors.value = {};
    
        // Lấy CSRF token
        await getToken();
        // Gửi dữ liệu booking đến server
        const response = await axios.post('http://127.0.0.1:8000/api/booking', {
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
        if (response.status === 200) {
            modalMessage.value = 'Đăng ký thành công!';
            open.value = true;
        }
    } catch (error) {
        errors.value = error.response.data.errors;
        console.error('Booking error:', error);
        modalMessage.value = 'Đăng ký thất bại!';
        open.value = true;
    }
};

</script>

<style>

</style>