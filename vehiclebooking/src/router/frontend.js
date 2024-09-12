const frontend = [
    {
        path: "/",
        component: () => import("../layout/frontend.vue"),
        meta: { requiresAuth: true, isAdmin: true},
        children: [
            {
                path: "",
                name: "frontend-index",
                component: () => import("../views/front/IndexPage.vue"),
            },
            {
                path: "quick-booking",
                name: "frontend-booking",
                component: () => import("../views/front/BookingPage.vue"),
                // meta: { role: '0' }
            },
            {
                path: "about",
                name: "frontend-about",
                component: () => import("../views/front/AboutUs.vue"),
            },
            {
                path: "news",
                name: "frontend-news",
                component: () => import("../views/front/NewsPage.vue"),
            },
            {
                path: "contact",
                name: "frontend-contact",
                component: () => import("../views/front/ContactPage.vue"),
            },
            {
                path: "cars",
                name: "frontend-products",
                component: () => import("../views/front/CarPage.vue"),
            },
            {
                path: "car-detail/:slug",
                name: "frontend-productdetail",
                component: () => import("../views/front/CarDetail.vue"),
                props: true,
            },
            {
                path: "account-dashboard",
                name: "frontend-dashboard",
                component: () => import("../views/front/account/AccountDashboard.vue"),
                meta: { role: '0' }
            },
            {
                path: "account-profile",
                name: "frontend-profile",
                component: () => import("../views/front/account/AccountProfile.vue"),
                meta: { role: '0' }
            },
            {
                path: "account-orders",
                name: "frontend-orders",
                component: () => import("../views/front/account/AccountMyOrders.vue"),
                meta: { role: '0' }
            },
            {
                path: "account-favorite",
                name: "frontend-favorite",
                component: () => import("../views/front/account/AcountFavorite.vue"),
                meta: { role: '0' }
            },
            {
                path: "login",
                name: "frontend-login",
                component: () => import("../views/front/LoginPage.vue"),
                // meta: { requiresAuth: true }
            },
            {
                path: "register",
                name: "frontend-register",
                component: () => import("../views/front/RegisterPage.vue"),
                // meta: { requiresAuth: true }
            },
        ]
    }
];
export default frontend;