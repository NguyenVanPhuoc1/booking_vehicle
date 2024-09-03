<template>
    <div>
        <a-skeleton :loading="loading" avatar :paragraph="{ rows: 10 }" active>
            <template #default>
                <div v-if="customers.length">
                    <ul class="list-group">
                        <li v-for="(customer, index) in customers" :key="customer._id" class="list-group-item">
                            Name {{ (currentPage - 1) * perPage  + (index + 1) }} : {{ customer.name }}
                        </li>
                    </ul>
        
                    <!-- Bootstrap Pagination -->
                    <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item" :class="{ disabled: currentPage === 1 }">
                        <a class="page-link" @click="fetchCustomers(currentPage - 1)">Previous</a>
                        </li>
                        <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: page === currentPage }">
                        <a class="page-link" @click="fetchCustomers(page)">{{ page }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                        <a class="page-link" @click="fetchCustomers(currentPage + 1)">Next</a>
                        </li>
                    </ul>
                    </nav>
                </div>
                <div v-else>
                    <div class="alert alert-danger">
                        <!-- Nội dung khi điều kiện customers.length là false -->
                        <p>Không có khách hàng nào được tìm thấy.</p>
                    </div>
                </div>
            </template>
        </a-skeleton>
    </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import apiClient from '@/services/ApiClient';
    const customers = ref([]);
    const loading = ref(false);
    const error = ref(null);
    const totalPages = ref(1); // Tổng số trang
    const currentPage = ref(1); 
    const perPage = ref(10);

    const fetchCustomers = async (page = 1, perPage) => {
        try {
            loading.value = true;
            error.value = null;
            const data = await apiClient.fetchData('/customers', { page, per_page: perPage });
            customers.value = data.data;
            totalPages.value = data.last_page; // Tổng số trang
            currentPage.value = data.current_page; 
            // console.log(customers.value);
            await new Promise(resolve => setTimeout(resolve, 2000));
            return;
        } catch (err) {
            console.log('Error fetching customers:', err);
            error.value = 'Unable to fetch customers. Please try again later.';
        } finally {
            loading.value = false;
        }
    };

    onMounted(() => {
        fetchCustomers();
    });
</script>

<style scoped>
  /* Optional: Add some custom styles */
</style>
