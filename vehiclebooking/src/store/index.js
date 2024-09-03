// cấu hình vuex cho file index.js dễ dàng truyền các phần tử giữa các component
import { createStore } from 'vuex';

export const store = createStore({
    state: {
        headerHeight: 0,
    },
    mutations: {
        setHeaderHeight(state, height) {
            state.headerHeight = height;
        },
    },
    actions: {
        updateHeaderHeight({ commit }, height) {
            commit('setHeaderHeight', height);
        },
    },
    getters: {
        headerHeight: (state) => state.headerHeight,
    }
});