<template>
    <!-- nav account -->
    <div class="card padding rounded border-0">
        <div class="card-profile text-center">
            <div class="avatar-user my-3 ">
                <img class="user-img" src="../../assets/front/images/avatar-user.jpg" alt="">
            </div>
            <div class="name-user">
                <h5 class="fw-bold">
                    {{ userName.name }}
                </h5>
                <p class="email-user text-secondary .fs-5">{{ userName.email }}</p>
            </div>
        </div>
        <div class="m-3"></div>
        <div class="card-menu mx-4">
            <ul class="menu-col">
                <li><router-link :class="{ active: isActive('dashboard') }" :to="'/account-dashboard'" class="menu-item "><font-awesome-icon :icon="['fas', 'home']" class="me-3" />Trang Chủ</router-link></li>
                <li><router-link :class="{ active: isActive('profile') }" :to="'/account-profile'" class="menu-item "><font-awesome-icon :icon="['fas', 'user']" class="me-3" />Thông Tin Cá Nhân</router-link></li>
                <li><router-link :class="{ active: isActive('orders') }" :to="'/account-orders'" class="menu-item" ><font-awesome-icon :icon="['fas', 'calendar-day']" class="me-3" />Đơn Hàng</router-link></li>
                <li><router-link :class="{ active: isActive('favorite') }" :to="'/account-favorite'" class="menu-item" ><font-awesome-icon :icon="['fas', 'car']" class="me-3" />Xe Yêu Thích</router-link></li>
                <li><button @click.prevent="logout"  class="menu-item btn btn-success"><font-awesome-icon :icon="['fas', 'sign-out-alt']" class="me-3" />Sign Out</button></li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useStore } from 'vuex';

const userName = ref(null);
const store = useStore();
userName.value =  store.getters.user ? store.getters.user : "Nguyễn Văn A";
// const pathSegment = ref('dasboard');
const isActive = (name) => {
    const currentPath = window.location.pathname;
    return currentPath.includes(name);
};

// Hàm đăng xuất
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
<style>
    .avatar-user .user-img{
        width: 150px;
        height: auto;
        border-radius: 50%;
        overflow: hidden;
    }
    .menu-col {
            list-style-type: none;
            padding-left: 0;
        }

        .menu-col li a {
            display: block;
            padding: 10px 15px;
            color: #000;
            text-decoration: none;
        }

        .menu-col li a.active {
            background-color: #1ECB15;
            color: #fff;
            border-radius: 10px;
        }
</style>