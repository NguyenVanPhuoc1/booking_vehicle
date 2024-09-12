// cấu hình vuex cho file index.js dễ dàng truyền các phần tử giữa các component
import { createStore } from 'vuex';

export const store = createStore({
    state: {
        headerHeight: 0,
        user: JSON.parse(sessionStorage.getItem('user_info')) || {}
    },
    mutations: {
        setHeaderHeight(state, height) {
            state.headerHeight = height;
        },
        setUser(state, user) {
            state.user = user;
            sessionStorage.setItem('user_info', JSON.stringify(user));
        }
    },
    actions: {
        updateHeaderHeight({ commit }, height) {
            commit('setHeaderHeight', height);
        },
        updateUser({ commit }, user) {
            commit('setUser', user);
        }
    },
    getters: {
        headerHeight: (state) => state.headerHeight,
        user: state => state.user
    }
});