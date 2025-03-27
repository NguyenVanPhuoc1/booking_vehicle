<template>
    <div>
        <a-skeleton :loading="loading" avatar :paragraph="{ rows: 10 }" active>
            <template #default>
                <div class="dashboard-page ">
                    <h1 class="fw-bold">Dash Board</h1>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <!-- đổi password -->
                                <div class="small-box bg-primary mb-3 rounded overflow-hidden">
                                    <div class="inner p-2 text-white"><p>Change Password</p></div>
                                    <div class="icon "><font-awesome-icon :icon="['fas', 'key']" class="text-white-50" /></div>
                                    <router-link :to="'/dashboard'" class=" text-center nav-link bg-secondary text-white">More Info <font-awesome-icon :icon="['fas', 'sign-out-alt']"  /></router-link>
                                </div>
                                <!-- Customer question -->
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-success mb-3 rounded overflow-hidden">
                                    <div class="inner p-2 text-white"><p>Customer Questions</p></div>
                                    <div class="icon"><font-awesome-icon :icon="['fas', 'question']" class="text-white-50"/></div>
                                    <router-link :to="'/dashboard'" class=" text-center nav-link bg-secondary text-white">More Info <font-awesome-icon :icon="['fas', 'sign-out-alt']"  /></router-link>
                                </div>
                            </div>
                        </div>
                        <!-- Thống kê truy cập -->
                        <div class="card chart-statistical">
                            <div class="chart-statistical-title d-flex align-items-center p-3 border-bottom">
                                <component class="fs-3" :is="PieChartOutlined" />
                                <span class="fs-3 ms-3">Thống kê truy cập</span>
                                <div class="ps-5 d-flex align-items-center">
                                    <span class="w-100">Lọc Theo:</span> 
                                    <select class="form-select form-select-md w-auto" aria-label="Select Day" v-model="selectedOption">
                                        <option value="7day">Tuần Này</option>
                                        <option value="30day">Tháng này</option>
                                    </select>
                                </div>
                            </div>
                            <!-- chart -->
                            <div class="chart-draw my-5" >
                                <Line id="my-chart-id" :data="chartData" :options="chartOptions" />
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </a-skeleton>
    </div>
</template>

<script setup>
import { ref,reactive, watch, onMounted } from 'vue';
import { PieChartOutlined } from "@ant-design/icons-vue";
import { Line } from 'vue-chartjs';
import { Chart, registerables } from 'chart.js';
import axios from 'axios';

const customers = ref([]);
const loading = ref(false);
const error = ref(null);

import { useStore } from "vuex";
const store = useStore();
const apiClient = store.getters.apiClient;

const fetchData_userviewpage = async (duration) => {
    try {
        error.value = null;
        loading.value = true;
        const response = await axios.get(`${apiClient.baseUrl}/get-data-userviewpage`,{
            params: {
                gia_tri: duration
            }
        });
        loading.value = false;
        
        // Chuyển đổi giá trị thành số và trả về dữ liệu
        const data = response.data.map(item => ({
            ...item,
            screenPageViews: Number(item.screenPageViews)
        }));
        // console.log(data);
        customers.value = data;  // Cập nhật giá trị cho customers

        // Cập nhật chartData sau khi dữ liệu đã được tải
        chartData.value = {
            labels: data.map(item => item.date),
            datasets: [
                {
                    label: 'Screen Page Views',
                    backgroundColor: '#6ecfa2',
                    data: data.map(item => item.screenPageViews)
                }
            ]
        };

        return data;
    } catch (err) {
        console.log('Error fetching data:', err);
        loading.value = false;
        return [];
    }
};

Chart.register(...registerables);

const chartData = ref({
    labels: [],
    datasets: [
        {
            label: 'Screen Page Views',
            backgroundColor: '#6ecfa2',
            data: []
        }
    ]
});

onMounted(async () => {
    const data = await fetchData_userviewpage(selectedOption.value);
});
const selectedOption = ref('7day');

// Theo dõi sự thay đổi của selectedOption
watch(selectedOption, (newValue, oldValue) => {
    fetchData_userviewpage(newValue);
});
</script>

<style scoped>
    #my-chart-id {
        height: 300px!important; /* Set the height for the chart */
        width: 100%!important;
        position: relative;
    }
    @media (max-width: 762px) {
        #my-chart-id {
            height: auto; /* Set the height for the chart */
            position: relative;
        }
    }
  /* Optional: Add some custom styles */
    .small-box{
        position: relative;
    }
    .small-box .icon svg{
        position: absolute;
        font-size: 40px;
        right: 15px;
        top: 15px;
        transition: transform .3s linear;
    }
    .small-box .icon svg:hover{
        transform: scale(1.2);
    }
</style>
