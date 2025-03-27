// file js chứa hàm chung
import { useRouter } from 'vue-router';

const useViewDetails =  () => {
    const router = useRouter();

    const viewDetails = async (slug) => {
        await router.push({ name: 'frontend-productdetail', params: { slug } });
    };

    return { viewDetails };
};

// xuất dưới dạng đối tượng
export default useViewDetails; 