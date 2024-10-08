const admin = [
    {
        path: "/admin",
        component: () => import("../layout/admin.vue"),
        meta: { requiresAuth: true, role: '1' },
        children: [
            {
                path: "dashboard",
                name: "admin-dashboard",
                component: () => import("../views/admin/Dasboard.vue"),
            },
            {
                path: "product",
                name: "admin-product",
                component: () => import("../views/admin/product/Product.vue"),
            },
            {
                path: "product-crud",
                name: "admin-product-crud",
                component: () => import("../views/admin/product/ProductCrud.vue"),
            },
            {
                path: "product/:slug",
                name: "admin-product-edit",
                component: () => import("../views/admin/product/ProductCrud.vue"),
                props: true,
            },
            {
                path: "brand-product",
                name: "admin-brand-product",
                component: () => import("../views/admin/product/BrandProduct.vue"),
            },
            {
                path: "brand-product-crud",
                name: "admin-brand-product-crud",
                component: () => import("../views/admin/product/BrandProductAdd.vue"),
            },
            {
                path: "brand-product/:id",
                name: "admin-brand-product-edit",
                component: () => import("../views/admin/product/BrandProductAdd.vue"),
                props: true,
            },
            {
                path: "users",
                name: "admin-users",
                component: () => import("../views/admin/users/AdminUser.vue"),
            },
            {
                path: "roles",
                name: "admin-roles",
                component: () => import("../views/admin/roles/AdminRoles.vue"),
            },
            {
                path: "setting",
                name: "admin-setting",
                component: () => import("../views/admin/setting/AdminSetting.vue"),
            }
        ],
    }
];
export default admin;