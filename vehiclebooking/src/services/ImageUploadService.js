// ImageUploadService.js
class ImageUploadService {
    static validTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
    //đọc file
    static async getBase64(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => resolve(reader.result);
            reader.onerror = (error) => reject(error);
        });
    }
    //kiểm tra file có đúng định dạng không
    static isValidFile(file) {
        const fileTypeLower = file.type.toLowerCase();
        return this.validTypes.includes(fileTypeLower);
    }

    static async previewFile(file) {
        if (!file.url && !file.preview) {
            file.preview = await this.getBase64(file.originFileObj);
        }
        return {
            preview: file.preview,
            title: file.name || file.url.substring(file.url.lastIndexOf('/') + 1),
        };
    }
    //tạo mảng chứa các file ảnh
    static async getFilesArray(files) {
        const filesArray = []; // Khởi tạo một mảng trống
        console.log(files);
        files.forEach((file) => {
            if (file.originFileObj) {
                // Nếu là file mới được chọn
                filesArray.push(file.originFileObj); // Thêm file gốc vào mảng
            } 
        });
    return filesArray; // Trả về mảng chứa các file
};

}

export default ImageUploadService;
