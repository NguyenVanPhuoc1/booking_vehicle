<template>
    <!-- booking title -->
    <div class="vel-booking"  :style="{ marginTop: -headerHeight + 'px' }">
        <div class="container">
            <div class="row align-items-center d-flex">
                <h1 class="text-white fw-bold fs-1 text-center">News</h1>
            </div>
        </div>
    </div>
    <!-- News Main -->
    <div class="new-main">
        <div class="container">
            <!-- list news -->
            
        </div>
    </div>
    
</template>
<script setup> 
    import { ref, onMounted, computed } from "vue";
    // thư viện vuex
    import { useStore } from "vuex";
    import Rellax from 'rellax';
    onMounted(() => {
        const rellax = new Rellax('.rellax');
    });
    onMounted(() => {
        document.title = "News";
    });
    const store = useStore();
    // set chiều cao cho header với carrousel
    const headerHeight = computed(() => store.getters.headerHeight);

</script>

<style>
   
</style>