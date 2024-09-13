<template>
    <div class="not-found-container">
        <!-- Chữ 404 lớn ở giữa trang -->
        <h1 class="error-code">404</h1>
        <!-- Dòng chữ "Quay trở lại trang trước đó" -->
        <p class="error-message">
            Trang bạn tìm kiếm không tồn tại. <br />
            <a @click="goBack" class="back-link">Quay lại</a>
        </p>
    </div>
</template>
  
  <script setup>
// Import router để điều hướng
import { useRouter } from "vue-router";
import { useStore } from "vuex";
const router = useRouter();
const store = useStore();
const user =  store.getters.user;

// Hàm quay lại trang trước đó
const goBack = () => {
    if(user.role === 1){
        router.push('admin/dashboard');
    }
    router.push('/');
};
</script>
  
  <style scoped>
/* CSS căn giữa trang và tạo kiểu chữ */
.not-found-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    text-align: center;
}

.error-code {
    font-size: 48px;
    font-weight: bold;
    margin-bottom: 16px;
}

.error-message {
    font-size: 18px;
}

.back-link {
    color: #007bff;
    cursor: pointer;
    text-decoration: underline;
}

.back-link:hover {
    color: #0056b3;
}
</style>
  