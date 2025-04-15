import axios from 'axios';
class ApiClient {

    constructor(baseUrl) {
        this._baseUrl = baseUrl; // Đặt baseURL vào thuộc tính riêng
        this.client = axios.create({
            baseURL: this._baseUrl,
            timeout: 60000,
        });
         // Thêm Interceptor để tự động gắn access token vào mỗi request
        this.client.interceptors.request.use(config => {
            const token = sessionStorage.getItem('access_token');
            // console.log("Interceptor chạy, token hiện tại:", token);

            if (token) {
                config.headers['Authorization'] = `Bearer ${token}`; 
            }
            return config;
        }, error => {
            return Promise.reject(error);
        });

         // Thêm Interceptor để xử lý refresh token khi bị lỗi 401
        // this.client.interceptors.response.use(
        //     response => response,  // Nếu không có lỗi, trả về response bình thường
        //     async error => {
        //         const originalRequest = error.config;

        //         // Nếu token hết hạn (mã lỗi 401) và chưa làm mới token
        //         if (error.response && error.response.status === 401 && !originalRequest._retry) {
        //             originalRequest._retry = true;

        //             try {
        //                 // Lấy lại refresh token từ sessionStorage
        //                 const refreshToken = sessionStorage.getItem('refresh_token');
        //                 if (refreshToken) {
        //                     // Gửi yêu cầu lấy lại access token mới bằng refresh token
        //                     const response = await this.client.post('/auth/refresh-token', { refresh_token: refreshToken });
                            
        //                     // Lưu lại token mới vào sessionStorage
        //                     const newAccessToken = response.data.access_token;
        //                     sessionStorage.setItem('access_token', newAccessToken);

        //                     // Cập nhật lại token vào header của request ban đầu và thử lại yêu cầu
        //                     originalRequest.headers['Authorization'] = `Bearer ${newAccessToken}`;
        //                     return this.client(originalRequest);  // Thực hiện lại request ban đầu với token mới
        //                 } else {
        //                     // Nếu không có refresh token, redirect đến trang login
        //                     window.location.href = '/login';
        //                 }
        //             } catch (refreshError) {
        //                 console.error('Error refreshing token', refreshError);
        //                 // Nếu không thể refresh, logout người dùng
        //                 sessionStorage.removeItem('access_token');
        //                 sessionStorage.removeItem('refresh_token');
        //                 window.location.href = '/login';
        //             }
        //         }

        //         // Nếu lỗi không phải do hết hạn token, trả về lỗi gốc
        //         return Promise.reject(error);
        //     }
        // );
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
    async fetchData(endpoint, params = {}, headers = {}) {
        try {
            const response = await this.client.get(endpoint, { params, headers });
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
const apiClient = new ApiClient(import.meta.env.VITE_APP_URL_LOCAL);
// const apiClient = new ApiClient('https://nongsannvp.store/api');
export default apiClient;
