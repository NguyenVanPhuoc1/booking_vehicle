import { createWebHistory, createRouter } from 'vue-router';
import admin from './admin.js';
import frontend from './frontend.js';

const routes = [...admin, ...frontend];
const router = createRouter({
    history: createWebHistory(),
    routes
});
router.beforeEach((to, from, next) => {
    const storedUserInfo = sessionStorage.getItem('user_info');
    const userInfo = storedUserInfo ? JSON.parse(storedUserInfo) : null;
    
    const userLoggedIn = !!userInfo; // Kiểm tra nếu người dùng đã đăng nhập
    const userRole = userInfo ? userInfo.role : null; // Lấy vai trò của người dùng

    // Kiểm tra nếu trang yêu cầu xác thực
    // console.log(to.matched.some(record => record.meta.requiresAuth));
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // Nếu người dùng đã đăng nhập và cố gắng truy cập các route không cho phép
        if ( userLoggedIn) {
            if (userRole === 1 && to.meta.isAdmin === true ) {
                // alert("Không được phép truy cập");
                // Admin không được phép truy cập vào các route của user
                next('/admin/dashboard');
            } else if (userRole === 0 && to.meta.role === '1') {
                // User không được phép truy cập vào các route của admin
                // alert("Không được phép truy cập");
                next('/');
            } else if ((to.name === 'frontend-login' || to.name === 'frontend-register') && userRole === 0) {
                // Người dùng đã đăng nhập không được phép truy cập vào các route đăng nhập và đăng ký
                // alert("Không được phép truy cập");
                next('/');
            } else {
                next(); // Tiếp tục nếu không có điều kiện đặc biệt
            }
        } else {
            if(to.path.includes('admin') || to.meta.role === '0'){
                // alert("Bạn cần đăng nhập để thực hiện tính năng này");
                next('/login');
            }
            else{
                next();
            }
        }
    }else{
        next();
    }
});


export default router;
