<template>
    <!-- form login  -->
    <div class="login_page" :style="{ marginTop: -headerHeight + 'px' }">
        <!-- jarallax animation -->
        <div class="jarallax_animation">
            <img
                class="w-100 d-flex"
                src="../../assets/front/images/2.jpg"
                alt="img-login"
            />
        </div>
        <div class="login-form my-5">
            <div class="container rellax" data-rellax-speed="-3">
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-8 col-lg-4 col-12 bg-light rounded">
                        <form
                            class="login-account m-4"
                            id="login-account "
                            @submit.prevent="login"
                        >
                            <h4 class="form-tittle fw-bold my-3">Login</h4>
                            <div class="mb-3">
                                <!-- <label for="account_name" class="form-label">Your Name</label> -->
                                <input
                                    type="email"
                                    class="form-control"
                                    id="account_email"
                                    v-model="email"
                                    placeholder="Your Email"
                                    autofocus="autofocus"
                                    autocomplete="email"
                                    required
                                />
                            </div>
                            <div class="mb-3">
                                <!-- <label for="account_password" class="form-label">Password</label> -->
                                <input
                                    type="password"
                                    class="form-control"
                                    id="account_password"
                                    v-model="password"
                                    placeholder="Your Password"
                                    required autocomplete="current-password"
                                />
                            </div>
                            <div v-if="hasLoginError" class="m-3 text-danger">
                                Email hoặc mật khẩu đăng nhập không đúng!
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mb-3 form-check">
                                    <input
                                        type="checkbox"
                                        class="form-check-input"
                                        id="saveAccount"
                                        v-model="remember_me"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="saveAccount"
                                        >Save Log In</label
                                    >
                                </div>
                                <div class="mb-3 me-3">
                                    <router-link :to="'/register'"
                                        >Sign Up</router-link
                                    >
                                </div>
                            </div>
                            <div class="mb-3">
                                <button
                                    type="submit"
                                    class="btn btn-success w-100"
                                >
                                    Sign In
                                </button>
                            </div>
                            <div
                                class="d-flex justify-content-center align-items-center title-line my-3"
                            >
                                Or sign in with
                            </div>
                        </form>
                            <div class="m-4 d-flex justify-content-between">
                                <button
                                    class="btn btn-secondary fw-bold w-50 me-2"
                                    @click="loginWithGoogle"
                                >
                                    Google
                                </button>
                                <button class="btn btn-secondary w-50" @click="loginWithFacebook">
                                    Facebook
                                </button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed,  watchEffect  } from "vue";
// thư viện vuex
import { useStore } from "vuex";
import Rellax from "rellax";
onMounted(() => {
    const rellax = new Rellax(".rellax");
});
onMounted(() => {
    document.title = "Login";
});
const store = useStore();
// set chiều cao cho header với carrousel
const headerHeight = computed(() => store.getters.headerHeight);

// login
import axios from "axios";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";
// import { Alert } from "bootstrap/dist/js/bootstrap.bundle.min";

const email = ref("");
const password = ref("");
const remember_me = ref(false);
const errors = ref({});
const router = useRouter();
const toast = useToast();
// secret key jwt
// const jwtSecretkey = "R0F+DcIsDdQZ8GWIJZmkD4Ykt20Ix4UiMqvXVRvS3g0k7i/lb0ck96JDlAYV2+0HdpgQMUwVyuiGxKrR8tz+6k065eDjUtrlkPAIQvrp5KCZqbPdpLTsqMjeRIdbdnU9fkqKpsQ469bq6rIl0g3BrzvzpVsbfKE7rcA9fi7XMUKiWx9XuVHUzIMfnZBdK0VRX/HH54CeCwA+M+ov/qxQRE0DP1RuqtUvCa5FnJhScxS0kzHY8Svg2s5hRcrgjKUZtNMEJy5ruWYVXwxW2LHEqr4aEVWtBBnlgYS/MQ+plyZsTN6XphQTb6S6FxAdctFBgyg/wjRes7khvSKQXy4pwQ==";
// get token with sanctum laravel
const getToken = async () => {
    await axios.get("/sanctum/csrf-cookie");
};
// đăng nhập thường
const login = async () => {
    try {
        // Reset errors before sending request
        errors.value = {};

        // Lấy CSRF token
        await getToken();

        // Gửi yêu cầu POST đến server
        const response = await axios.post("http://127.0.0.1:8000/api/login", {
            email: email.value,
            password: password.value,
            remember_me: remember_me.value, // Gửi tham số remember
        });
        // vidu voi jwt
        // header + payload + SIGNATURE
        // const header = {
        //     "alg": "HS256",
        //     "typ": "JWT"
        // };
        // const payload = {
        //     sub : email.value,
        //     exp : Date.now + 3600000,
        // }
        // // ma hoa base64
        // const encodeHeader = btoa(JSON.stringify(header));
        // const encodePayload = btoa(JSON.stringify(payload));
        // const tokenData = `${encodeHeader}.${encodePayload}`

        // Lưu token vào localStorage hoặc sessionStorage
        if (response.status === 200) {
            
            const userInfo = response.data.user;
            await handleLoginSuccess(userInfo);
        } else {
            errors.value = response.data.error;
        }
    } catch (error) {
        errors.value =
            error.response.data.errors.password[0] ||
            error.response.data.errors.email[0];
        // console.log(errors.value);
    }
};
const hasLoginError = computed(() => {
    return typeof errors.value === "string";
});

// login with Google
const loginWithGoogle = async () => {
    window._doLoginFromCallback = function(username){
        // const name = JSON.parse(username).name;
        // console.log("OK" + name);
        handleLoginSuccess(JSON.parse(username));
    }
    // ham lang nghe su kien message duoc gui tu popup
    window.addEventListener('message', function(event) {
        if (event.data && event.data.action === 'callLoginCallback') {
            _doLoginFromCallback(event.data.username);
        }
    });
        // Bt, app js nguoi ta ko chuyen huong truc tiep. Ma thay vao do mo 1 popup. Chuyen huong o trong do.
        // gio cu chay thu xem no lam sao da
    // Open popup login
    const url = 'http://127.0.0.1:8000/login/google';
    const popupWidth = 600;
    const popupHeight = 600;
    const left = (window.innerWidth / 2) - (popupWidth / 2);
    const top = (window.innerHeight / 2) - (popupHeight / 2);

    window.open(
        url,
        'popupWindow',
        `width=${popupWidth},height=${popupHeight},top=${top},left=${left},scrollbars=yes`
    );
};

// login with Facebook
const loginWithFacebook = async () => {
    window._doLoginFromCallback = function(username){
        // const name = JSON.parse(username).name;
        // console.log("OK" + name);
        handleLoginSuccess(JSON.parse(username));
    }
    // ham lang nghe su kien message duoc gui tu popup
    window.addEventListener('message', function(event) {
        if (event.data && event.data.action === 'callLoginCallback') {
            _doLoginFromCallback(event.data.username);
        }
    });
        // Bt, app js nguoi ta ko chuyen huong truc tiep. Ma thay vao do mo 1 popup. Chuyen huong o trong do.
        // gio cu chay thu xem no lam sao da
    // Open popup login
    const url = 'http://127.0.0.1:8000/login/facebook';
    const popupWidth = 600;
    const popupHeight = 600;
    const left = (window.innerWidth / 2) - (popupWidth / 2);
    const top = (window.innerHeight / 2) - (popupHeight / 2);

    window.open(
        url,
        'popupWindow',
        `width=${popupWidth},height=${popupHeight},top=${top},left=${left},scrollbars=yes`
    );
};

// Hàm xử lý khi đăng nhập thành công
const handleLoginSuccess = async (userInfo) => {

    // Lưu thông tin người dùng vào sessionStorage
    sessionStorage.setItem('user_info', JSON.stringify(userInfo));
    toast.success("Đăng nhập thành công!");
    // Chuyển hướng dựa trên vai trò người dùng
    setTimeout(() => {
        if (userInfo.role === 0) {
            router.replace('/').then(() => {
                window.location.reload();
            }); // Sử dụng replace để không cho phép quay lại trang đăng nhập
        } else  {
            router.replace('/admin/dashboard').then(() => {
                window.location.reload();
            }); 
        }
    }, 2000);
};
</script>

<style>
</style>
