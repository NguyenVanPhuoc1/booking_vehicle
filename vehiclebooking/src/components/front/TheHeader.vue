<template >
    <div>
        <!-- Header mobile + desktop -->
        <div class="header">
            <div class="container-fluid">
                <div
                    class="row text-white header-start"
                    style="background-color: black"
                >
                    <div class="col-sm-8 d-none d-sm-flex">
                        <div
                            class="contact-list d-none d-sm-flex justify-content-between align-items-center"
                        >
                            <div class="contact-item d-flex align-items-center">
                                <font-awesome-icon
                                    :icon="['fas', 'phone']"
                                    :style="iconStyle"
                                />
                                <span class="contact_text">+84 123 456 789</span>
                            </div>
                            <!-- mail -->
                            <div
                                class="contact-item d-flex align-items-center mx-3"
                            >
                                <font-awesome-icon
                                    :icon="['fas', 'phone']"
                                    :style="iconStyle"
                                />
                                <span class="contact_text">contact@gmail.com</span>
                            </div>
                            <!-- time -->
                            <div class="contact-item d-flex align-items-center">
                                <font-awesome-icon
                                    :icon="['fas', 'phone']"
                                    :style="iconStyle"
                                />
                                <span class="contact_text"
                                    >Mon - Fri 08.00 - 18.00</span
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 topbar-right align-items-center">
                        <div class="social-icons">
                            <a href="#" class="social-icon">
                                <font-awesome-icon :icon="['fab', 'facebook']" />
                            </a>
                            <a href="#" class="social-icon">
                                <font-awesome-icon :icon="['fab', 'twitter']" />
                            </a>
                            <a href="#" class="social-icon">
                                <font-awesome-icon :icon="['fab', 'instagram']" />
                            </a>
                            <a href="#" class="social-icon">
                                <font-awesome-icon :icon="['fab', 'linkedin']" />
                            </a>
                            <a href="#" class="social-icon">
                                <font-awesome-icon :icon="['fab', 'youtube']" />
                            </a>
                        </div>
                    </div>
                </div>
                <!-- header chính -->
                <div ref="headerElement"
                    :class="[
                        'row text-white header-body justify-content-between',
                        { transparent: isTransparent },
                    ]"
                    style="background-color: transparent"
                >
                    <!-- mobile -->
                    <div
                        class="col-6 d-flex d-sm-none align-items-center justify-content-sm-start"
                    >
                        <router-link :to="{ name: 'frontend-index' }" title="Home">
                            <img :src="logoUrl" alt="Logo" />
                        </router-link>
                    </div>
                    <!-- desktop -->
                    <div
                        class="col-sm-2 d-none d-sm-flex align-items-center justify-content-sm-start"
                    >
                        <router-link :to="{ name: 'frontend-index' }" title="Home">
                            <img :src="logoUrl" alt="Logo" />
                        </router-link>
                    </div>
                    <!-- menu -->
                    <div
                        class="col-sm-8 d-none d-md-flex align-items-center justify-content-center"
                    >
                        <MenuComponent :key="$route.fullPath" />
                    </div>
                    <!-- desktop sign-in -->
                    <div class="col-sm-2 d-none d-md-flex align-items-center justify-content-sm-end" v-if="userName">
                        <span class="fw-bold text-white">Hi, {{ userName }} </span>
                        <!-- <button class="btn btn-danger" @click="logout">Logout</button> -->
                    </div>
                    <!-- Hiển thị nút "Sign In" nếu chưa đăng nhập -->
                    <div class="col-sm-2 d-none d-md-flex align-items-center justify-content-sm-end" v-else>
                        <router-link class="btn btn-success" to="/login">Sign In</router-link>
                    </div>
                    <!-- mobile menu -->
                    <div
                        class="col-6 d-flex d-md-none align-items-center justify-content-end"
                    >
                        <span class="btn btn-success" @click="showDrawerMenu()">
                            <font-awesome-icon :icon="['fas', 'bars']" />
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- menu -->
        <a-drawer v-model:open="open_menu" title="Danh Mục" placement="right">
            <MenuComponent />
        </a-drawer>
    </div>
</template>
<!-- js -->
<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import { useStore } from 'vuex';

// Imports
import logo from '@/assets/logo-light.png';
import MenuComponent from '@/components/front/TheMenu.vue';

// Reactive variables
const open_menu = ref(false);
const isTransparent = ref(false);
const headerElement = ref(null);
const userName = ref(null);

// Functions
const showDrawerMenu = () => {
    open_menu.value = true;
};

const iconStyle = computed(() => ({
    marginRight: '5px',
    color: 'green',
}));

const logoUrl = logo;

const handleScroll = () => {
    isTransparent.value = window.scrollY > 0;
};

// Vuex store
const store = useStore();
// console.log(store.getters.user.name);
userName.value =  store.getters.user.name;
// Lifecycle hooks
onMounted(() => {
    // Handle scroll event
    window.addEventListener('scroll', handleScroll);

    // Retrieve user info from sessionStorage
    // const storedUserInfo = sessionStorage.getItem('user_info');
    // if (storedUserInfo) {
    //     userName.value = JSON.parse(storedUserInfo);
    // }

    // Update header height in Vuex store
    if (headerElement.value) {
        store.dispatch('updateHeaderHeight', headerElement.value.offsetHeight);
    }
});
// console.log(userName);
onUnmounted(() => {
    // Clean up scroll event listener
    window.removeEventListener('scroll', handleScroll);
});
</script>

<!-- css -->
<style scoped>

</style>