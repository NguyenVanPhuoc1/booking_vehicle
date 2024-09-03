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
                            <div class="mb-3">
                                <!-- <label for="account_name" class="form-label">Your Name</label> -->
                                <input type="text" class="form-control " id="account_name" v-model="name"
                                :class="{ 'is-invalid': errors.name }" placeholder="Your Name" required autocomplete="username"/>
                                <div v-if="errors.name" class="invalid-feedback">
                                    {{ errors.name[0] }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <!-- <label for="account_name" class="form-label">Your Name</label> -->
                                <input type="email" class="form-control " id="account_email" v-model="email"
                                :class="{ 'is-invalid': errors.email }" placeholder="Your Email" required autocomplete="email"/>
                                <div v-if="errors.email" class="invalid-feedback">
                                    {{ errors.email[0] }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <!-- <label for="account_password" class="form-label">Password</label> -->
                                <input type="password" class="form-control " id="account_password" v-model="password"
                                :class="{ 'is-invalid': errors.password }" placeholder="Your Password" required autocomplete="new-password"/>
                                <div v-if="errors.password" class="invalid-feedback">
                                    {{ errors.password[0] }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <!-- <label for="account_password" class="form-label">Password</label> -->
                                <input type="password" class="form-control " id="account_repassword" v-model="re_password" 
                                :class="{ 'is-invalid': errors.re_password }" placeholder="Enter The Password" required autocomplete="new-password"/>
                                <div v-if="errors.re_password" class="invalid-feedback">
                                    {{ errors.re_password[0] }}
                                </div>
                            </div>
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
        const response = await axios.post('http://127.0.0.1:8000/api/register', {
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
