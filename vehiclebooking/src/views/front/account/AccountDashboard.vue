<template>
    <div>
        <!-- dashboard title -->
        <div class="account-dasboard"  :style="{ marginTop: -headerHeight + 'px' }">
            <div class="container">
                <div class="row align-items-center d-flex">
                    <h1 class="text-white fw-bold fs-1 text-center">Dashboard</h1>
                </div>
            </div>
        </div>
        <!-- noi dung-->
        <section class="dashboard-main py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3 mb-4">
                        <TheAccountNav />
                    </div>
                    <!-- main -->
                    <div class="col-12 col-lg-9 ">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <div class="card rounded border-0">
                                    <font-awesome-icon class="fs-1 text-success m-3" :icon="['fas', 'calendar-check']" />
                                    <div class="m-3 text-center">
                                        <p class="fs-1 fw-bold m-0">03</p>
                                        <p class="text-secondary">Upcoming Orders</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="card rounded border-0">
                                    <font-awesome-icon class="fs-1 text-success m-3" :icon="['fas', 'calendar-day']" />
                                    <div class="m-3 text-center">
                                        <p class="fs-1 fw-bold m-0">03</p>
                                        <p class="text-secondary">Total Orders</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="card rounded border-0">
                                    <font-awesome-icon class="fs-1 text-success m-3" :icon="['fas', 'calendar-times']" />
                                    <div class="m-3 text-center">
                                        <p class="fs-1 fw-bold m-0">03</p>
                                        <p class="text-secondary">Total Orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- my-recent orders -->
                        <div class="my-recents-orders rounded my-5 bg-white">
                            <h4 class="fw-bold p-4">My Recent Orders</h4>
                            <div class="m-4">
                                <table class="table table-hover  table-resizable" >
                                    <thead>
                                        <tr >
                                            <th scope="col" style="width: 10%">Order ID</th>
                                            <th scope="col">Car Name</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Binh Dinh</td>
                                            <td>01-01-2024</td>
                                            <td>03-07-2024</td>
                                            <td ><span class="bg-success rounded-pill text-white px-3">completed</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Mark</td>
                                            <td>Binh Dinh</td>
                                            <td>01-01-2024</td>
                                            <td>03-07-2024</td>
                                            <td ><span class="bg-danger rounded-pill text-white px-3 ">Cancelled</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Mark</td>
                                            <td>Binh Dinh</td>
                                            <td>01-01-2024</td>
                                            <td>03-07-2024</td>
                                            <td ><span class="bg-warning rounded-pill text-white px-3">Scheduled</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- my-favorite cars -->
                        <div class="my-favorite rounded my-5 bg-white">
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
                                                <li><span>Seats: </span>4</li>
                                                <li><span>Luggage: </span>4</li>
                                                <li><span>Doors: </span>4</li>
                                                <li><span>Fuel: </span>4</li>
                                                <li><span>Horsepower: </span>4</li>
                                                <li><span>Engine: </span>4</li>
                                                <li><span>Drive: </span>4</li>
                                                <li><span>Type: </span>4</li>
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
        document.title = "Account Dashboard";
    });
    const store = useStore();
    // set chiều cao cho header với carrousel
    const headerHeight = computed(() => store.getters.headerHeight);
    const user =  store.getters.user;
</script>

<style>
   
</style>