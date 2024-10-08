<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div>
        <TheHeader />
        <!-- main -->
        <div class="container-fluid ">
            <div class="row">
                <div class="col-lg-2 d-none d-lg-flex  menucol border border-1 bg-light"  :style="{ height: 'auto', width: 'auto'}">
                    <TheMenu />
                </div>
    
                <div class="col-12 col-lg-10 mt-3 viewcol">
                    <router-view></router-view>
                </div>
            </div>
        </div>
        <!-- footer -->
        <TheFooter />
    </div>
</template>
<script setup>
import TheHeader from "../components/admin/TheHeader.vue";
import TheMenu from "../components/admin/TheMenu.vue";
import TheFooter from "../components/admin/TheFooter.vue";

import { ref, onMounted, onUnmounted, watch  } from "vue";
const headerRef = ref(null);
onMounted(() => {
        document.title = "Admin";
    });


</script>