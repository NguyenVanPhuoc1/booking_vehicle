<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <!-- Global Spinner -->
    <!-- <a-spin :spinning="isLoading" tip="Loading..."> -->
    <!-- </a-spin> -->
        <!-- header -->
            <TheHeader />

            <!-- body -->
            <router-view></router-view>

            <!-- footer -->
            <TheFooter />
</template>
<script setup>
import { ref, onMounted } from 'vue';
import TheHeader from "../components/front/TheHeader.vue";
import TheFooter from "@/components/front/TheFooter.vue";

const isLoading = ref(true);

const fetchData = async () => {
    try {
        // Simulate a delay for fetching data
        await new Promise(resolve => setTimeout(resolve, 2000)); 
        // return
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    fetchData();
});
</script>