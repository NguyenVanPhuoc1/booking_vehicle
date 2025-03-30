import axios from 'axios';
class ApiClient {

    constructor(baseUrl) {
        this._baseUrl = baseUrl; // Đặt baseURL vào thuộc tính riêng
        this.client = axios.create({
            baseURL: this._baseUrl,
            timeout: 60000,
        });
        // 🛠️ Thêm Interceptor để tự động gắn token vào mỗi request
        // this.client.interceptors.request.use(config => {
        //     const token = localStorage.getItem('access_token'); // Lấy token từ localStorage
        //     if (token) {
        //         config.headers['Authorization'] = `Bearer ${token}`; // Gắn token vào header
        //     }
        //     return config;
        // }, error => {
        //     return Promise.reject(error);
        // });
    }

    // Getter cho baseURL
    get baseUrl() {
        return this._baseUrl;
    }

    // Setter cho baseURL
    set baseUrl(newBaseUrl) {
        this._baseUrl = newBaseUrl;
        this.client.defaults.baseURL = newBaseUrl; // Cập nhật baseURL trong axios client
    }

    // Hàm GET
    async fetchData(endpoint, params = {}) {
        try {
            const response = await this.client.get(endpoint, { params });
            return response.data;
        } catch (error) {
            this.handleError(error, endpoint);
        }
    }

    // Hàm POST
    async postData(endpoint, data, headers = {}) {
        const response = await this.client.post(endpoint, data, { headers });
        return response;
    }

    // Hàm PUT
    async updateData(endpoint, data, headers = {}) {
        const response = await this.client.put(endpoint, data, { headers });
        return response;
    }

    // Hàm xử lý lỗi chung
    handleError(error, endpoint) {
        if (error.response) {
            console.log(`Error fetching data from ${endpoint}: ${error.response.status} - ${error.response.statusText}`);
            // window.location.href = '/404';
        } else if (error.request) {
            console.log(`Error fetching data from ${endpoint}: No response received`);
        } else {
            console.log(`Error fetching data from ${endpoint}: ${error.message}`);
        }
    }
}

// Khởi tạo ApiClient
// const apiClient = new ApiClient(import.meta.env.VITE_APP_API_URL);
const apiClient = new ApiClient('https://nongsannvp.store/api');
export default apiClient;
