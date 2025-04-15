<template>
    <router-view>
        
    </router-view>
</template>
<script setup>
import { onMounted } from 'vue';
import { useStore } from "vuex";
const store = useStore();
const apiClient = store.getters.apiClient;
// console.log(apiClient);
// Thiết lập Axios Interceptor để bắt lỗi 401 (token hết hạn)
apiClient.client.interceptors.response.use(
    response => response,  // Nếu không có lỗi, trả về response bình thường
    async (error) => {
        const originalRequest = error.config;

        try {
            const refreshToken = sessionStorage.getItem('refresh_token');
            if (refreshToken) {
                // Kiểm tra nếu lỗi là do token hết hạn (mã lỗi 401)
                if (error.response && error.response.status === 401 && !originalRequest._retry) {
                    originalRequest._retry = true;
            
                    // Gửi yêu cầu làm mới token
                    const response = await apiClient.postData('/auth/refresh-token', { refresh_token: refreshToken });
            
                    // Lưu lại access token mới vào sessionStorage
                    const newAccessToken = response.data.access_token;
                    sessionStorage.setItem('access_token', newAccessToken);
            
                    // Cập nhật header của yêu cầu gốc với token mới
                    apiClient.defaults.headers['Authorization'] = `Bearer ${newAccessToken}`;
                    originalRequest.headers['Authorization'] = `Bearer ${newAccessToken}`;
            
                    // Thực hiện lại yêu cầu ban đầu
                    return apiClient(originalRequest);
                } 
            // Lấy refresh token từ sessionStorage
            } 
        }catch (e) {
                sessionStorage.removeItem('access_token');
                sessionStorage.removeItem('refresh_token');
                window.location.href = '/login';
            }

        // Nếu không phải lỗi do token hết hạn, trả về lỗi gốc
        return Promise.reject(error);
    }
);


</script>