<template>
    <!-- form đăng kí  -->
    <div class="register-page" :style="{ marginTop: -headerHeight + 'px' }">
        <!-- jarallax animation -->
        <div class="jarallax_animation" >
            <img class="w-100 d-flex " src="../../assets/front/images/2.jpg" alt="img-login" />
        </div>
        <div class="register-form pb-5 ">
            <div class="container rellax" data-rellax-speed="-3">
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-8 col-lg-4 col-12 bg-light rounded">
                        <form class="login-account m-4" id="login-account " @submit.prevent="register">
                            <h4 class="form-tittle fw-bold my-3">Register Form</h4>
                            <!-- Tên người đăng kí -->
                            <InputField
                            v-model="name"
                            id="account_name"
                            type="text"
                            placeholder="Your Name"
                            required
                            autocomplete="username"
                            :error="errors.name"
                            />
                            <!-- Email người đăng kí -->
                            <InputField
                            v-model="email"
                            id="useremail"
                            type="text"
                            placeholder="Your Email"
                            required
                            autocomplete="email"
                            :error="errors.email"
                            />
                            <!-- password -->
                            <InputField
                            v-model="password"
                            id="user_password"
                            type="password"
                            placeholder="Your Password"
                            required
                            autocomplete="new_password"
                            :error="errors.password"
                            />
                            <!-- Re password -->
                            <InputField
                            v-model="re_password"
                            id="account_repassword"
                            type="password"
                            placeholder="Enter The Password"
                            required
                            autocomplete="new_password"
                            :error="errors.re_password"
                            />
                            <div class="mb-3 ">
                                <button type="submit" class="btn btn-success w-100"> Sign Up</button>
                            </div>
                            <div class="mb-3 text-center text-black fw-bold">
                                <router-link  :to=" '/login' ">Sign In</router-link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup> 
    import { ref, onMounted, computed } from "vue";
    import InputField from '@/components/InputField.vue';
    // thư viện vuex
    import { useStore } from "vuex";
    import Rellax from 'rellax';
    onMounted(() => {
    const rellax = new Rellax('.rellax');
});
    onMounted(() => {
        document.title = "Register";
    });
    const store = useStore();
    const apiClient = store.getters.apiClient;
    // set chiều cao cho header với carrousel
    const headerHeight = computed(() => store.getters.headerHeight);

    // login
    import axios from 'axios';
    import { useRouter } from 'vue-router';
    import { useToast } from 'vue-toastification';

const name = ref('');
const email = ref('');
const password = ref('');
const re_password = ref('');
const errors = ref({});
const router = useRouter();
const toast = useToast();

// get token
const getToken = async () => {
    await axios.get("/sanctum/csrf-cookie");
}

const register = async () => {
    try {
        // Reset errors before sending request
        errors.value = {};
        
        // Send POST request to server
        await getToken();
        const response = await apiClient.postData('/register', {
            name: name.value,
            email: email.value,
            password: password.value,
            re_password: re_password.value,
        });
        
        console.log('Registration successful:', response.data);
        toast.success("Đăng ký thành công!");
        router.push('/login'); // Chuyển hướng đến trang sau khi đăng ký
        //reset value input
        name.value = '';
        email.value = '';
        password.value = '';
        re_password.value = '';
        // router.push('/login');
    } catch (error) {     
        if (error.response && error.response.status === 422) {
            // Gán các thông báo lỗi vào errors
            errors.value = error.response.data.errors;
            console.log(errors.value);
        } else {
            console.log('An unexpected error occurred:', error);
        }
    }
};

</script>

<style>
    
</style>
