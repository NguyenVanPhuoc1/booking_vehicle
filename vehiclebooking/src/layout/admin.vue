<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <TheHeader />
    <!-- main -->
    <div class="container-fluid ">
        <div class="row">
            <div class="col-sm-2 d-none d-lg-flex px-0 w-auto " :style="{ height: headerHeight  + 'px'}">
                <TheMenu />
            </div>

            <div class="col-12 col-lg-10 mt-3">
                <router-view></router-view>
            </div>
        </div>
    </div>
    <!-- footer -->
    <TheFooter />
</template>
<script setup>
import TheHeader from "../components/admin/TheHeader.vue";
import TheMenu from "../components/admin/TheMenu.vue";
import TheFooter from "../components/admin/TheFooter.vue";

import { ref, onMounted, computed } from "vue";
const headerRef = ref(null);
onMounted(() => {
        document.title = "Admin";
    });
    // set chiều cao cho menu
    const headerHeight = window.innerHeight - 64;

</script>