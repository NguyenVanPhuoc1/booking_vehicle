<template>
    <div>
        <!-- dashboard title -->
        <div class="account-dasboard"  :style="{ marginTop: -headerHeight + 'px' }">
            <div class="container">
                <div class="row align-items-center d-flex">
                    <h1 class="text-white fw-bold fs-1 text-center">Favorites</h1>
                </div>
            </div>
        </div>
        <!-- noi dung-->
        <section class="dashboard-main py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <TheAccountNav />
                    </div>
                    <div class="col-12 col-lg-9">
                        <!-- my-favorite cars -->
                        <div class="my-favorite rounded mb-5 bg-white">
                            <h4 class="fw-bold p-4">My Favorites</h4>
                            <div class="item-list m-4">
                                <div class="row">
                                    <div class="item-img col-4">
                                        <img src="../../../assets/front/images/bmw-m5.jpg" alt="" class="w-100 rounded">
                                    </div>
                                    <div class="item-car col-5">
                                        <h5 class="fw-bold">Jeep Renegade</h5>
                                        <div class="d-flex ">
                                            <ul class="two-column-list  justify-content-between">
                                                <li><span>Seats:</span>4</li>
                                                <li><span>Seats:</span>4</li>
                                                <li><span>Seats:</span>4</li>
                                                <li><span>Seats:</span>4</li>
                                                <li><span>Seats:</span>4</li>
                                                <li><span>Seats:</span>4</li>
                                                <li><span>Seats:</span>4</li>
                                                <li><span>Seats:</span>4</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="item-rent col-3">
                                        <p>Daily rate from</p>
                                        <p class="fw-bold fs-2">$ 265</p>
                                        <div class="btn btn-success text-white fw-bold fs-6">Rent Now</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
</template>
<script setup> 
    import TheAccountNav from "../../../components/front/TheAccountNav.vue";
    import { ref, onMounted, computed } from "vue";
    // thư viện vuex
    import { useStore } from "vuex";
    
    onMounted(() => {
        document.title = "Account Favorite";
    });
    const store = useStore();
    // set chiều cao cho header với carrousel
    const headerHeight = computed(() => store.getters.headerHeight);

</script>

<style>
    .dashboard-main{
        background: #F5F8FA;
    }
</style>