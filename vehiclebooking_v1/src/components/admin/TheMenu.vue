<template>
    <a-list class="menu bg-light" :style="{ width: state.collapsed ? '80px' : 'auto' }">
        <div class="border-bottom py-3">
            <div class="d-none d-sm-flex justify-content-around">
                <div class="fw-bold menu-name" >Bảng Điều Khiển</div>
                <a-button type="primary" @click="toggleCollapsed">
                    <MenuUnfoldOutlined v-if="state.collapsed" />
                    <MenuFoldOutlined v-else />
                </a-button>
            </div>
        </div>
        <a-menu class="bg-light border-0"
            :open-keys="state.openKeys"
            mode="inline"
            v-model:selectedKeys="state.selectedKeys"
            @openChange="onOpenChange"
        >
            <!-- Duyệt qua danh sách items để render các menu item -->
            <div v-for="item in menuItems" :key="item.key">
                <!-- Nếu không có children, render a-menu-item -->
                <a-menu-item v-if="!item.children" :key="item.key">
                    <router-link :to="{ name: item.key }" class="text-decoration-none">
                        <component :is="item.icon" />
                        <span>{{ item.label }}</span>
                    </router-link>
                </a-menu-item>

                <!-- Nếu có children, render a-sub-menu -->
                <a-sub-menu v-else :key="item.keys">
                    <template #title>
                        <component :is="item.icon" />
                        <span>{{ item.label }}</span>
                    </template>
                    
                    <a-menu-item
                        v-for="child in item.children"
                        :key="child.key"
                        >
                            <router-link :to="{ name: child.key }" class="text-decoration-none">
                                {{ child.label }}
                            </router-link>
                    </a-menu-item>
                </a-sub-menu>
            </div>
        </a-menu>
    </a-list>
</template>

<script setup>
import { ref, reactive } from "vue";
import {
    MenuFoldOutlined,
    MenuUnfoldOutlined,
    PieChartOutlined,
    DesktopOutlined,
    InboxOutlined,
} from "@ant-design/icons-vue";


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
        key: "admin-production",
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
    {
        key: "admin-customer",
        icon: InboxOutlined,
        label: "Quản Lí Khách Hàng",
        children: [
            {
                key: "admin-customer-question",
                label: "Hỏi Đáp",
            },
            {
                key: "admin-customer-booking",
                label: "Booking Car",
            },
        ],
    },
]);


const state = reactive({
    collapsed: false,
    rootSubmenuKeys: ["admin-production", "admin-customer"],
    openKeys: [],
    selectedKeys: [],
});
const onOpenChange = (openKeys) => {
    const latestOpenKey = openKeys.find(key => state.openKeys.indexOf(key) === -1);
    if (state.rootSubmenuKeys.indexOf(latestOpenKey) === -1) {
        state.openKeys = openKeys;
    } else {
        state.openKeys = latestOpenKey ? [latestOpenKey] : [];
    }
};

const toggleCollapsed = () => {
    if (state.collapsed) {
        document.querySelector('.menu-name').style = 'display:block';
    } else {
        document.querySelector('.menu-name').style = 'display:none';
    }
    state.collapsed = !state.collapsed;
};
</script>
