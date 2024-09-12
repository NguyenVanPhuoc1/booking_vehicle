<template>
    <div>
        <!-- Header mobile + desktop -->
        <div class="header p-2 bg-success">
            <div class="container-fluid">
                <div class="row text-white" >
                    <div class="col-1 d-flex d-sm-none align-items-center justify-content-center ">
                        <span @click="showDrawer()"> X</span>
                    </div>
        
                    <div class="col-sm-3 d-none d-sm-flex align-items-center justify-content-center justify-content-sm-start">
                        <img :src="logoUrl" alt="Logo" height="32" width="32">
                        <span class="fw-bold">QUẢN TRỊ</span>
                    </div> 
    
                    <div class="col-10 col-sm-6 d-flex justify-content-sm-start align-items-center">
                        <ul class="d-flex list-unstyled m-0">
                            <li class="nav-item py-0">
                                <router-link class="nav-link text-white-50 px-3" :to="{ name: 'admin-dashboard' }">
                                    Home
                                </router-link>
                            </li>
                            <li class="nav-item py-0">
                                <router-link class="nav-link text-white-50 px-3" :to="''" @click.prevent="logout">
                                    Đăng Xuất
                                </router-link>
                            </li>
                            <li class="nav-item py-0">
                                <router-link class="nav-link text-white-50 px-3" :to="{ name: 'frontend-index' }" target="_blank">
                                    <font-awesome-icon :icon="['fas', 'reply']" />
                                    Trang Chủ
                                </router-link>
                            </li>
                        </ul>    
                    </div>
        
                    <div class="col-sm-3 d-none d-sm-flex align-items-center justify-content-sm-end">
                        <div class="dropdown mx-3">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <font-awesome-icon :icon="['fas', 'users-cog']" />
                            </button>
                            <ul class="dropdown-menu">
                                <li class="nav-item py-2">
                                    <router-link class="nav-link  px-3" :to="{ name: '' }" target="_blank">
                                    Cài Đặt Chung
                                    </router-link>
                                </li>
                                <li class="nav-item py-2">
                                    <router-link class="nav-link  px-3" :to="{ name: '' }" target="_blank">
                                    Đổi Mật Khẩu
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                        <span class="fw-bold">Admin</span>
                    </div>
        
                    <div class="col-1 d-flex d-sm-none align-items-center justify-content-center ">
                        <span @click="showDrawerUser()">X</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- open menu bên trái -->
        <a-drawer
            v-model:open="open"
            title="Bảng Điều Khiển"
            placement="left"
        >
            <TheMenu @click="handleMenuClick()" />
        </a-drawer>
        <!-- open menu bên user -->
        <a-drawer
            v-model:open="open_user"
            title="Admin"
            placement="right"
        >
            <TheMenu />
        </a-drawer>
    </div>

</template>

<script setup>
    import { ref } from 'vue';
    import TheMenu from "./TheMenu.vue";

    const open = ref(false);
    const open_user = ref(false);

    const showDrawer = () => {
        open.value = true;
    };
    const showDrawerUser = () => {
        open_user.value = true;
    };
    // Xử lý sự kiện khi nhấn vào một mục trong menu
    const handleMenuClick = () => {
        open.value = false; // Đóng drawer khi menu được nhấn
    };

    // logo
    import logo from '@/assets/logo.png';
    const logoUrl = logo;
const logout = async () => {
    console.log('đăng xuất');
    // Xóa thông tin người dùng từ Vuex store
    // store.dispatch('logout');

    // Xóa thông tin người dùng từ sessionStorage
    sessionStorage.removeItem('user_info');
    // Chuyển hướng về trang đăng nhập hoặc trang chủ
    window.location.href = '/login'; // Hoặc sử dụng this.$router.push('/login') nếu bạn đang dùng Vue Router
};
</script>