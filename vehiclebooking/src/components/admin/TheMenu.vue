<template>
    <a-list  style="width: 100%;" class="menu bg-light" bordered
    :style="{ width: state.collapsed ? '80px' : '245px' }">

        <div class="d-flex justify-content-around py-3 border-bottom">
            <div class="fw-bold menu-name" >Bảng Điều Khiển</div>
            <a-button type="primary"  @click="toggleCollapsed">
                <MenuUnfoldOutlined v-if="state.collapsed" />
                <MenuFoldOutlined v-else />
            </a-button>
        </div>
        <a-menu class="bg-light"
            :default-open-keys="state.openKeys"
            :default-selected-keys="state.selectedKeys"
            @update:open-keys="handleOpenKeysChange"
            @update:selected-keys="handleSelectedKeysChange"
            mode="inline"
        >
            <!-- Duyệt qua danh sách items để render các menu item -->
            <div v-for="item in menuItems" :key="item.key">
                <a-menu-item v-if="!item.children" :key="item.key">
                    <router-link :to="{ name: item.key }" class="text-decoration-none">
                        <component :is="item.icon" />
                        <span>{{ item.label }}</span>
                    </router-link>
                </a-menu-item>
                <a-sub-menu v-else >
                    <template #title >
                        <!-- Sử dụng item.icon() để render icon -->
                        <component :is="item.icon" />
                        <span>{{ item.label }}</span>
                    </template>
                    <template #default>
                        <div v-for="child  in item.children" :key="child.key">
                            <a-menu-item >
                                <router-link :to="{ name: child.key }" class="text-decoration-none">
                                    <span>{{ child.label }}</span>
                                </router-link>
                            </a-menu-item>
                        </div>
                    </template>
                </a-sub-menu>
            </div>
        </a-menu>
    </a-list>
</template>

<script setup>
import { ref, onMounted, reactive } from "vue";
import {
    MenuFoldOutlined,
    MenuUnfoldOutlined,
    PieChartOutlined,
    DesktopOutlined,
    InboxOutlined,
} from "@ant-design/icons-vue";
import { RouterLink } from "vue-router";

const state = reactive({
    collapsed: false,
    selectedKeys: ["admin-dashboard"],
    openKeys: ["admin-dashboard","admin-users", "admin-roles", "admin-setting","admin-brand-product"],
});

// Khai báo danh sách menu với icon tương ứng
const menuItems = reactive([
    {
        key: "admin-dashboard",
        icon: PieChartOutlined,
        label: "Trang Chủ",
    },
    {
        key: "admin-users",
        icon: PieChartOutlined,
        label: "Tài Khoản",
    },
    {
        key: "admin-roles",
        icon: DesktopOutlined,
        label: "Vai Trò",
    },
    {
        key: "",
        icon: InboxOutlined,
        label: "Quản Lí Sản Phẩm",
        children: [
            {
                key: "admin-brand-product",
                label: "Hãng Sản Phẩm",
            },
            {
                key: "admin-product",
                label: "Sản Phẩm",
            },
        ],
    },
]);

// Xử lý sự kiện thay đổi openKeys
const handleOpenKeysChange = (keys) => {
    state.openKeys = keys;
};

// Xử lý sự kiện thay đổi selectedKeys
const handleSelectedKeysChange = (keys) => {
    state.selectedKeys = keys;
};
const toggleCollapsed = () => {
    if(state.collapsed){
        document.querySelector('.menu-name').style = 'display:block';
    }else{
        document.querySelector('.menu-name').style = 'display:none';
    }
    state.collapsed = !state.collapsed;
};
</script>