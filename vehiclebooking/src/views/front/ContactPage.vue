<template>
    <div>
        <!-- Contact title -->
        <div class="vel-booking"  :style="{ marginTop: -headerHeight + 'px' }">
            <div class="container">
                <div class="row align-items-center d-flex">
                    <h1 class="text-white fw-bold fs-1 text-center">Contact Us</h1>
                </div>
            </div>
        </div>
        <!-- contact form -->
        <div class="contact-page my-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <h3 class="fw-bold title">Do you have any question?</h3>
                        <form @submit.prevent="getQuestion" id="contact_form" class="contact_form">
                            <div class="row my-3">
                                <div class="col-12 col-lg-4 ">
                                    <label for="name" class="visually-hidden">Your Name</label>
                                    <input type="text" :class="{ 'is-invalid': errors.name }" v-model="cus_name" class="form-control" id="name" placeholder="Your Name"  required>
                                    <div v-if="errors.name" class="invalid-feedback">
                                        {{ errors.name[0] }}
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 ">
                                    <label for="email" class="visually-hidden">Your Email</label>
                                    <input type="email" :class="{ 'is-invalid': errors.email }" v-model="cus_email" class="form-control" id="email" placeholder="Your Email"  required>
                                    <div v-if="errors.email" class="invalid-feedback">
                                        {{ errors.email[0] }}
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 ">
                                    <label for="phone" class="visually-hidden">Your Phone</label>
                                    <input type="text" :class="{ 'is-invalid': errors.email }" v-model="cus_phone" class="form-control" id="phone" placeholder="Your Phone" required>
                                    <div v-if="errors.phone" class="invalid-feedback">
                                        {{ errors.phone[0] }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="your_message" class="visually-hidden">Your question</label>
                                <textarea class="form-control" id="your_message"  v-model="cus_ques" name="your_message" rows="3" placeholder="Your Question" required></textarea>
                            </div>
                            <button class="btn btn-success" type="submit">Send Question</button>
                        </form>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="company_address">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="fw-bold">VN Office</h5>
                                    Address: 57 Phan Chau Trinh 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-form"></div>
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
        document.title = "Contact";
    });
    const store = useStore();
    // set chiều cao cho header với carrousel
    const headerHeight = computed(() => store.getters.headerHeight);

    import axios from "axios";
    import { useRouter } from "vue-router";
    import { useToast } from "vue-toastification";

    const cus_name = ref("");
    const cus_email = ref("");
    const cus_phone = ref("");
    const cus_ques = ref("");
    const errors = ref({});
    const router = useRouter();
    const toast = useToast();
    const getToken = async () => {
        await axios.get("/sanctum/csrf-cookie");
    };
// đăng nhập thường
const getQuestion = async () => {
    try {
        // Reset errors before sending request
        errors.value = {};

        // Lấy CSRF token
        await getToken();

        // Gửi yêu cầu POST đến server
        const response = await axios.post("http://127.0.0.1:8000/api/get-question", {
            name: cus_name.value,
            email: cus_email.value,
            phone: cus_phone.value, 
            cus_ques: cus_ques.value,
        });
        if (response.status === 200) {
            toast.success("Send Success!");
            // console.log(response.data);
        } else {
            errors.value = response.data.error;
        }
    } catch (error) {
        errors.value = error.response.data.errors;
    }
};
</script>

<style>
</style>