<template>
    <!-- dashboard title -->
    <div class="account-dasboard" :style="{ marginTop: -headerHeight + 'px' }">
        <div class="container">
            <div class="row align-items-center d-flex">
                <h1 class="text-white fw-bold fs-1 text-center">Profile</h1>
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
                <!-- main content -->
                <div class="col-12 col-lg-9">
                    <div class="my-profile rounded p-4 bg-white">
                        <a-tabs v-model:activeKey="activeKey">
                            <a-tab-pane key="1" tab="Profile">
                                <form action="#" id="update-profile">
                                    <div class="row">
                                        <div class="col-sm-6 col-12 my-4">
                                            <h6 class="fw-bold">Username</h6>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="Enter username">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12 my-4">
                                            <h6 class="fw-bold">Email Address</h6>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12 mb-4">
                                            <h6 class="fw-bold">Password</h6>
                                            <div class="mb-3">
                                                <input type="password" class="form-control" placeholder="*******" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12 mb-4">
                                            <h6 class="fw-bold">Re-Enter Password</h6>
                                            <div class="mb-3">
                                                <input type="password" class="form-control" placeholder="*******">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12 mb-4">
                                            <h6 class="fw-bold">Gender</h6>
                                            <div class="mb-3">
                                                <select class="form-select" aria-label="select gender">
                                                    <option selected>Giới Tính</option>
                                                    <option value="1">Nam</option>
                                                    <option value="2">Nữ</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="btn btn-success w-100" type="submit"> Update Profile</div>
                                    </div>
                                </form>
                            </a-tab-pane>
                            <a-tab-pane key="2" tab="Notifications" force-render>Đăng Cập Nhật ....</a-tab-pane>
                        </a-tabs>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import TheAccountNav from "../../../components/front/TheAccountNav.vue";
import { ref, onMounted, computed } from "vue";

const activeKey = ref('1');
// thư viện vuex
import { useStore } from "vuex";
onMounted(() => {
    document.title = "Account Profile";
});
const store = useStore();
// set chiều cao cho header với carrousel
const headerHeight = computed(() => store.getters.headerHeight);

</script>

<style>
.dashboard-main {
    background: #f5f8fa;
}

</style>