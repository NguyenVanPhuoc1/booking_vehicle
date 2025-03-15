<template>
    <div>
        <!-- dashboard title -->
        <div class="account-dasboard" :style="{ marginTop: -headerHeight + 'px' }">
            <div class="container">
                <div class="row align-items-center d-flex">
                    <h1 class="text-white fw-bold fs-1 text-center">Profile</h1>
                </div>
            </div>
        </div>
        <!-- noi dung-->
        <section class="dashboard-main py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <TheAccountNav />
                    </div>
                    <!-- main content -->
                    <div class="col-12 col-lg-9">
                        <div class="my-profile rounded p-4 bg-white">
                            <a-tabs v-model:activeKey="activeKey">
                                <a-tab-pane key="1" tab="Profile">
                                    <form action="#" id="update-profile" @submit.prevent="updateProfile">
                                        <div class="row">
                                            <div class="col-sm-6 col-12 my-4">
                                                <h6 class="fw-bold">Họ và Tên</h6>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder="Enter username" v-model="user_name" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12 my-4">
                                                <h6 class="fw-bold">Email </h6>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" :placeholder="user_email ? 'Email' : 'Chưa cập nhật'"  v-model="user_email" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12 mb-4">
                                                <h6 class="fw-bold">Ngày Sinh : <span class="text-danger">(ex: 01/12/2000)</span> </h6>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" :placeholder="user_birthday != '' ? 'Ngày Sinh ' : 'Chưa cập nhật'" 
                                                    @input="validateUBirth"  v-model="user_birthday">
                                                    <span v-if="user_birthdayError" :class="{ 'text-success' : isValue} " class="error-message py-2">{{ user_birthdayError }}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12 mb-4">
                                                <h6 class="fw-bold">Giới Tính</h6>
                                                <div class="mb-3">
                                                    <select class="form-select" aria-label="select gender" @change="validateGender" v-model="user_gender">
                                                        <option value="0" disabled >Chọn Giới Tính</option>
                                                        <option value="nam">Nam</option>
                                                        <option value="nữ">Nữ</option>
                                                    </select>
                                                    <span v-if="user_genderError" :class="{ 'text-success' : isGender} " class="error-message py-2">{{ user_genderError }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <button class="btn btn-success w-100" type="submit"> Update Profile</button>
                                        </div>
                                    </form>
                                </a-tab-pane>
                                <a-tab-pane key="2" tab="Password" force-render>
                                    <form action="#" method="post" id="update-password">
                                        <div class="row">
                                            <div class="col-sm-6 col-12 mb-4">
                                                <h6 class="fw-bold">Nhập Mật Khẩu hiện tại:</h6>
                                                <div class="mb-3">
                                                    <input type="password" class="form-control" placeholder="*******" autocomplete="current-password">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12 mb-4">
                                                <h6 class="fw-bold">Nhập Mật Khẩu mới:</h6>
                                                <div class="mb-3">
                                                    <input type="password" class="form-control" placeholder="*******" autocomplete="new-password">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12 mb-4">
                                                <h6 class="fw-bold">Nhập lại mật khẩu mới:</h6>
                                                <div class="mb-3">
                                                    <input type="password" class="form-control" placeholder="*******" autocomplete="new-password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="btn btn-success w-100" type="submit"> Update Password</div>
                                        </div>
                                        <div class="col-12 my-3 text-center">             
                                            <router-link>Bạn quên mật khẩu?</router-link>
                                        </div>
                                    </form>
                                </a-tab-pane>
                                <a-tab-pane key="3" tab="Notifications" force-render>Đang Cập Nhật ....</a-tab-pane>
                            </a-tabs>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script setup>
import TheAccountNav from "../../../components/front/TheAccountNav.vue";
import { ref, onMounted, computed } from "vue";
import { useToast } from "vue-toastification";
import axios from "axios";

const activeKey = ref('1');
// thư viện vuex
import { useStore } from "vuex";
onMounted(() => {
    document.title = "Account Profile";
});
const store = useStore();
const apiClient = store.getters.apiClient;
// set chiều cao cho header với carrousel
const headerHeight = computed(() => store.getters.headerHeight);
const user =  store.getters.user;

const user_name = ref(user.name || '');
const user_email = ref(user.email || '');
const user_birthday = ref(user.birthday || '');
const user_gender = ref(user.gender ? user.gender : '0');

const errors = ref({});
const toast = useToast();
const getToken = async () => {
    await axios.get("/sanctum/csrf-cookie");
};

// validate input
const user_birthdayError = ref('');
const isValue = ref(false);
const user_genderError = ref('');
const isGender = ref(false);

// Hàm kiểm tra hợp lệ ngày sinh
const validateUBirth = () => {
    const re = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/;
    if (!re.test(user_birthday.value)) {
        isValue.value = false;
        user_birthdayError.value = 'Ngày Sinh không hợp lệ!';
    } else {
        isValue.value = true;
        user_birthdayError.value = 'Hợp lệ';
    }
};

// Hàm kiểm tra hợp lệ giới tính
const validateGender = () => {
    if (user_gender.value !== 'nam' && user_gender.value !== 'nữ') {
        isGender.value = false;
        user_genderError.value = 'Giới Tính không hợp lệ!';
    } else {
        isGender.value = true;
        user_genderError.value = 'Hợp lệ';
    }
};

// Hàm cập nhật thông tin người dùng
const updateProfile = async () => {
    // Gọi các hàm validate để kiểm tra trước khi submit
    validateUBirth();
    validateGender();

    // Kiểm tra điều kiện hợp lệ
    if (!isGender.value || !isValue.value) {
        alert('Thông Tin Không hợp lệ!');
        return; // Dừng lại, không thực hiện submit
    }

    try {
        // Reset errors before sending request
        errors.value = {};

        // Lấy CSRF token
        await getToken();

        // Gửi yêu cầu POST đến server
        const response = await apiClient.postData("/update-user-profile", {
            name: user_name.value,
            email: user_email.value,
            birthday: user_birthday.value,
            gender: user_gender.value,
        });

        // Kiểm tra phản hồi từ server
        if (response.status === 200) {
            toast.success("Cập Nhật Thành Công!");
            localStorage.setItem('user_info', JSON.stringify(response.data.user));
        } else {
            errors.value = response.data.error;
        }
    } catch (error) {
        console.log("Cập Nhật Không Thành Công!");
        errors.value = error.response?.data?.errors || {};
    }
};

</script>

<style>
.dashboard-main {
    background: #f5f8fa;
}
.error-message {
    color: red;
    font-size: 0.875em;
}
</style>
