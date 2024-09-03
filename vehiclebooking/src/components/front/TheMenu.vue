<template>
        <nav  class="main-menu align-items-center">
            <ul class="d-block d-sm-flex">
                <li v-for="item in filteredMenuItems" :key="item.id" @mouseover="showSubMenu(item)" @mouseleave="hideSubMenu(item)" @click="toggleSubMenu(item)">
                    <router-link class="dropdown-item" :to="{ name: item.routeName }">
                        {{ item.name }}
                        <font-awesome-icon v-if="item.subMenu.length > 0" :icon="['fas', 'chevron-down']" />
                    </router-link>
                    <ul v-if="item.subMenuVisible">
                        <li class="border-bottom" v-for="subItem in item.subMenu" :key="subItem.id">
                            <router-link class="dropdown-item" :to="{ name: subItem.subMenuRoute }">{{ subItem.name }}</router-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { faChevronDown } from '@fortawesome/free-solid-svg-icons';
import { library } from '@fortawesome/fontawesome-svg-core';

library.add( faChevronDown);
const menuItems = ref([
    {
        id: 1,
        name: "Home",
        routeName: "frontend-index",
        subMenuVisible: false,
        subMenu: [],
    },
    {
        id: 2,
        name: "Cars",
        routeName: "frontend-products",
        subMenuVisible: false,
        subMenu: [],
    },
    {
        id: 3,
        name: "Booking",
        routeName: "frontend-booking",
        subMenuVisible: false,
        subMenu: [],
    },
    {
        id: 4,
        name: "My Account",
        routeName: "",
        subMenuVisible: false,
        subMenu: [
            { id: 21, name: "Dashboard", subMenuRoute: "frontend-dashboard" },
            { id: 22, name: "My Profile", subMenuRoute: "frontend-profile" },
            { id: 23, name: "My Order", subMenuRoute: "frontend-orders" },
            { id: 24, name: "My Favorite Cars", subMenuRoute: "frontend-favorite" },
        ],
    },
    {
        id: 5,
        name: "Pages",
        routeName: "",
        subMenuVisible: false,
        subMenu: [
            { id: 25, name: "About Us", subMenuRoute: "frontend-about" },
            { id: 26, name: "Contact", subMenuRoute: "frontend-contact" },
            { id: 26, name: "Login", subMenuRoute: "frontend-login" },
            { id: 26, name: "Register", subMenuRoute: "frontend-register" },
        ],
    },
    {
        id: 6,
        name: "News",
        routeName: "frontend-news",
        subMenuVisible: false,
        subMenu: [],
    },
]);
const isLoggedIn = computed(() => {
    return !!sessionStorage.getItem('user_info'); // Kiểm tra sự tồn tại của thông tin người dùng trong sessionStorage
});
const filteredMenuItems = computed(() => {
    if (isLoggedIn.value) {
        return menuItems.value;
    } else {
        return menuItems.value.filter(item => item.name !== "My Account");
    }
});
const showSubMenu = (item) => {
    item.subMenuVisible = true;
};

const hideSubMenu = (item) => {
    item.subMenuVisible = false;
};

const toggleSubMenu = (item) => {
    item.subMenuVisible = !item.subMenuVisible;
    // console.log(item.subMenuVisible)
};
</script>
  
<style scoped>

</style>
