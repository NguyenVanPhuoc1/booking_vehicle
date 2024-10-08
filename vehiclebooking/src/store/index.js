// src/store/index.js
import { createStore } from 'vuex';
import apiClient from '@/services/ApiClient'; // Đảm bảo rằng bạn đã import apiClient từ đúng file

export const store = createStore({
    state: {
        headerHeight: 0,
        user: JSON.parse(localStorage.getItem('user_info')) || null, // Khôi phục dữ liệu từ localStorage
        apiClient: apiClient,  // Lưu apiClient vào state
    },
    mutations: {
        setHeaderHeight(state, height) {
            state.headerHeight = height;
        },
        setUser(state, user) {
            state.user = user;
            localStorage.setItem('user_info', JSON.stringify(user)); // Lưu user vào localStorage
        },
        clearUser(state) {
            state.user = null; // Mutation để xóa thông tin người dùng
            localStorage.removeItem('user_info'); // Xóa user khỏi localStorage
        },
    },
    actions: {
        updateHeaderHeight({ commit }, height) {
            commit('setHeaderHeight', height);
        },
        updateUser({ commit }, user) {
            commit('setUser', user);
        },
        clearUser({ commit }) {
            commit('clearUser'); // Action để gọi mutation
        },
    },
    getters: {
        headerHeight: (state) => state.headerHeight,
        user: (state) => state.user,
        apiClient: (state) => state.apiClient, // Truy cập apiClient từ getter
    },
});
