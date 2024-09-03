<template>
    <!-- dashboard title -->
    <div class="account-dasboard"  :style="{ marginTop: -headerHeight + 'px' }">
        <div class="container">
            <div class="row align-items-center d-flex">
                <h1 class="text-white fw-bold fs-1 text-center">My Orders</h1>
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
                <!-- main -->
                <div class="col-12 col-lg-9">
                    <!-- scheduled order -->
                    <div class="scheduled-order rounded p-4 bg-white">
                        <h5 class="fw-bold">My Recent Orders</h5>
                        <div class="my-scheduled-order">
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
                                        <td ><span class="bg-warning rounded-pill text-white px-3">Scheduled</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Mark</td>
                                        <td>Binh Dinh</td>
                                        <td>01-01-2024</td>
                                        <td>03-07-2024</td>
                                        <td ><span class="bg-warning rounded-pill text-white px-3">Scheduled</span></td>
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
                    <!-- completed order -->
                    <div class="completed-order rounded p-4 bg-white">
                        <h5 class="fw-bold">My Completed Orders</h5>
                        <div class="my-completed-order">
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
                                        <td ><span class="bg-success rounded-pill text-white px-3">completed</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Mark</td>
                                        <td>Binh Dinh</td>
                                        <td>01-01-2024</td>
                                        <td>03-07-2024</td>
                                        <td ><span class="bg-success rounded-pill text-white px-3">completed</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- cancelled order -->
                    <div class="cancelled-order rounded p-4 bg-white">
                        <h5 class="fw-bold">My Cancelled Orders</h5>
                        <div class="my-cancelled-order">
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
                                        <td ><span class="bg-danger rounded-pill text-white px-3 ">Cancelled</span></td>
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
                                        <td ><span class="bg-danger rounded-pill text-white px-3 ">Cancelled</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</template>
<script setup> 
    import TheAccountNav from "../../../components/front/TheAccountNav.vue";
    import { ref, onMounted, computed } from "vue";
    // thư viện vuex
    import { useStore } from "vuex";
    
    onMounted(() => {
        document.title = "My Oders";
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