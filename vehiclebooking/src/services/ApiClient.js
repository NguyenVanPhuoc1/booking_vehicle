// class connect vuejs with api
import axios from 'axios';

class ApiClient {
    constructor(baseURL) {
        this.client = axios.create({
            baseURL: baseURL,
            timeout: 1000,
        });
    }

    async fetchData(endpoint, params = {}) {
        try {
            const response = await this.client.get(endpoint, { params });
            return response.data;
        } catch (error) {
            if (error.response) {
                // Nếu có phản hồi lỗi từ server
                console.log(`Error fetching data from ${endpoint}: ${error.response.status} - ${error.response.statusText}`);
            } else if (error.request) {
                // Nếu không có phản hồi từ server
                console.log(`Error fetching data from ${endpoint}: No response received`);
            } else {
                // Lỗi khác
                console.log(`Error fetching data from ${endpoint}: ${error.message}`);
            }
            // Ném lỗi lên hoặc xử lý lỗi ở đây tùy theo yêu cầu
            // throw new Error('Unable to fetch data');
        }
    }
}
const apiClient = new ApiClient('http://127.0.0.1:8000/api');
export default apiClient;
