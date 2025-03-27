<template>
    <div>
        <!-- booking title -->
        <div class="vel-booking"  :style="{ marginTop: -headerHeight + 'px' }">
            <div class="container">
                <div class="row align-items-center d-flex">
                    <h1 class="text-white fw-bold fs-1 text-center">About Us</h1>
                </div>
            </div>
        </div>
        <!-- Board of Directors -->
        <div class="board_derectors ">
            <div class="derectorsBox ">
                <div class="container">
                    <h2 class=" text-center text-white fw-bold py-4">Board of Directors</h2>
                    <div class="row justify-content-center align-items-center">
                        <!-- col -->
                        <div class="col-12 col-sm-6 col-lg-3 author-list">
                            <div class="author-item">
                                <div class="au-image p-3">
                                    <div class="social-wrap text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'facebook']" />
                                            </a>
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'twitter']" />
                                            </a>
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'instagram']" />
                                            </a>
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'linkedin']" />
                                            </a>
                                        </div>
                                    </div>
                                    <img class="w-100 " src="../../assets/front/images/author.jpg" alt="au_img">
                                </div>
                                <!-- name + position -->
                                <div class="au-profile text-white text-center py-3">
                                    <h6 class="fw-bold au-name">
                                        Fynley Wilkinson
                                    </h6>
                                    <p class="au-pos">
                                        Chief Creative Officer
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3 author-list">
                            <div class="author-item">
                                <div class="au-image p-3">
                                    <div class="social-wrap text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'facebook']" />
                                            </a>
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'twitter']" />
                                            </a>
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'instagram']" />
                                            </a>
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'linkedin']" />
                                            </a>
                                        </div>
                                    </div>
                                    <img class="w-100 " src="../../assets/front/images/author.jpg" alt="au_img">
                                </div>
                                <!-- name + position -->
                                <div class="au-profile text-white text-center py-3">
                                    <h6 class="fw-bold au-name">
                                        Fynley Wilkinson
                                    </h6>
                                    <p class="au-pos">
                                        Chief Creative Officer
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3 author-list">
                            <div class="author-item">
                                <div class="au-image p-3">
                                    <div class="social-wrap text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'facebook']" />
                                            </a>
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'twitter']" />
                                            </a>
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'instagram']" />
                                            </a>
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'linkedin']" />
                                            </a>
                                        </div>
                                    </div>
                                    <img class="w-100 " src="../../assets/front/images/author.jpg" alt="au_img">
                                </div>
                                <!-- name + position -->
                                <div class="au-profile text-white text-center py-3">
                                    <h6 class="fw-bold au-name">
                                        Fynley Wilkinson
                                    </h6>
                                    <p class="au-pos">
                                        Chief Creative Officer
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3 author-list">
                            <div class="author-item">
                                <div class="au-image p-3">
                                    <div class="social-wrap text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'facebook']" />
                                            </a>
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'twitter']" />
                                            </a>
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'instagram']" />
                                            </a>
                                            <a href="#" class="social-icon bg-success p-1 rounded">
                                                <font-awesome-icon :icon="['fab', 'linkedin']" />
                                            </a>
                                        </div>
                                    </div>
                                    <img class="w-100 " src="../../assets/front/images/author.jpg" alt="au_img">
                                </div>
                                <!-- name + position -->
                                <div class="au-profile text-white text-center py-3">
                                    <h6 class="fw-bold au-name">
                                        Fynley Wilkinson
                                    </h6>
                                    <p class="au-pos">
                                        Chief Creative Officer
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- jarallax animation -->
            <div class="jarallax_animation rellax" data-rellax-speed="3" >
                <img class="w-100 d-flex " src="../../assets/front/images/8.jpg" alt="img-login" />
            </div>
        </div>
        <!-- contact -->
        <div class="contact bg-success py-5">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-8 fs-2 text-white fw-bold">
                        Call us for further information. Rentaly customer care is here to help you anytime.
                    </div>
                    <div class="col-sm-6 col-lg-4 fs-2 text-white fw-bold text-lg-center my-3">
                        <p class="fs-2 text-white fw-bold">1 200 333 800</p>
                        <div class="btn fs-6 text-white  fw-bold" style="background: #1ecb15">Contact Us</div>
                    </div>
                </div>
            </div>
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
        document.title = "About Us";
    });
    const store = useStore();
    // set chiều cao cho header với carrousel
    const headerHeight = computed(() => store.getters.headerHeight);

</script>

<style>
    .board_derectors{
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    .derectorsBox {
        padding: 70px 0;
    }
    .board_derectors .jarallax_animation img{
        max-width: none;
        height: 200%;
    }
    .board_derectors .jarallax_animation{
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        z-index: -100;
        background-size: 100%;
        background-repeat: no-repeat;
    }
    .au-image{
        position: relative;
        width: 100%;
    }
    .au-image img{
        height: auto;
    }
    .social-wrap{
        position: absolute;
        left: 23%;
        bottom: 30px;
    }
</style>