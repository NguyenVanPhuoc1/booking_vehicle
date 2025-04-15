<template>
    <div>
        <a-skeleton :loading="loading" avatar :paragraph="{ rows: 10 }" active>
            <template #default>
                <div class="questionmane-page mb-3">
                    <h3 class="fw-bold px-3">Quản Lí</h3>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <ul class="d-flex list-unstyled m-0">
                                    <li class="nav-item py-0 justify-content-sm-start">
                                        <router-link class="btn btn-primary" ><font-awesome-icon :icon="['fas', 'plus']" /> Thêm Mới</router-link>
                                    </li>
                                    <li class="nav-item py-0 ps-4">
                                        <button @click="showModalDelete" class="btn btn-danger"><font-awesome-icon :icon="['fas', 'trash']" /> Xóa Tất Cả</button>
                                    </li>
                                </ul>    
                            </div>
                        </div>
                        <a-breadcrumb class="my-4">
                            <a-breadcrumb-item>Bảng Điều Khiển</a-breadcrumb-item>
                            <a-breadcrumb-item><a class="text-primary text-decoration-none" href="">Quản Lí Hỏi Đáp</a></a-breadcrumb-item>
                        </a-breadcrumb>
    
                        <!-- my table question -->
                        <div class="my-table-question rounded my-5 bg-white border">
                            <h4 class="fw-bold p-2">Customer Questions</h4>
                            <div class="m-4 card card-primary card-outline text-sm mb-0" v-if="cus_questions.length  > 1 ">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover table-bordered table-resizable rounded " >
                                        <thead>
                                            <tr>
                                                <th class="align-middle" style="width: 5%;">
                                                    <div class="custom-control custom-checkbox my-checkbox text-center">
                                                        <input type="checkbox" class="custom-control-input" id="selectall-checkboxquestion" v-model="selectAll" @change="toggleSelectAll">
                                                        <label for="selectall-checkboxquestion" class="custom-control-label"></label>
                                                    </div>
                                                </th>
                                                <th scope="col" class="align-middle text-center" style="width: 10%;">STT</th>
                                                <th scope="col" class="align-middle text-center" style="min-width: 150px;" >Tên Câu Hỏi</th>
                                                <th scope="col" class="align-middle text-center" style="min-width: 300px;" >Câu Trả Lời</th>
                                                <th scope="col" class="align-middle text-center">Nổi Bật</th>
                                                <th scope="col" class="align-middle text-center">Thao Tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center" v-for="(item,index) in cus_questions" :key="item._id">
                                                <th scope="row"> 
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" :value="item._id" v-model="selectedItems" :id="'check-index' + item._id ">
                                                        <label :for="'check-index-' + item._id" class="form-check-label"></label>
                                                    </div>
                                                </th>
                                                <td>{{ index + 1 }}</td>
                                                <td>{{ item.cus_ques }}</td>
                                                <td class="text-split">{{ item.ans_ques ?   item.ans_ques : "Chưa có câu trả lời. "}}</td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" :checked="item.noi_bat" v-model="item.noi_bat"
                                                        @change="handleCheckboxChange($event, item._id)" :id="'check-question-noibat-' + item._id">
                                                        <label :for="'check-question-noibat-' + item._id" class="form-check-label"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="operation d-flex justify-content-center" >
                                                        <div class="mx-2">
                                                            <button @click="openEditQuestion(item)" class="btn btn-primary">
                                                                <font-awesome-icon :icon="['far', 'pen-to-square']" /> 
                                                            </button>
                                                        </div>
                                                        <div class="mx-2">
                                                            <button @click="deleteItem(item._id)" class="btn btn-danger">
                                                                <font-awesome-icon :icon="['fas', 'trash']" />
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div v-else>
                                <div class="alert alert-danger">
                                    <!-- Nội dung khi điều kiện customers.length là false -->
                                    <p>Không có câu hỏi nào được tìm thấy.</p>
                                </div>
                            </div>
                            <!-- Bootstrap Pagination -->
                            <nav aria-label="Page navigation ">
                                <ul class="pagination justify-content-end p-3">
                                    <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                        <a class="page-link" @click="getAllquestionName(currentPage - 1)">Previous</a>
                                    </li>
                                    <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: page === currentPage }">
                                        <a class="page-link" @click="getAllquestionName(page)">{{ page }}</a>
                                    </li>
                                    <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                                        <a class="page-link" @click="getAllquestionName(currentPage + 1)">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>                      
                    </div>
                </div>
            </template>
        </a-skeleton>
        <!-- Modal hiển thị thông báo -->
        <a-modal v-model:open="open"  title="Xóa Tất Cả"
            :ok-text="'Yes'"
            :ok-type="'danger'"
            :cancel-text="'No'"
            @ok="handleOk"
            @cancel="handleCancel" >
            <p>{{ messageModal }}</p>
        </a-modal>
        <!-- Modal -->
        <a-modal v-model:open="showModal" title="Update câu trả lời" @ok="handlUpdateQuestion" @cancel="handleCancelModal">
            <!-- Nội dung form chỉnh sửa -->
            <form class="update-answer-ques" novalidate >
                <div class="card-body card-article">
                    <input v-model="editForm.id_ques" class="form-control" type="hidden" name="id_question" id="id_question" >
                    <div class="form-group py-3">
                        <label class="d-block mb-2" for="name_question">Tên Câu Hỏi</label>
                        <input v-model="editForm.name" class="form-control" type="text" name="name_question" id="name_question" readonly >
                    </div>
                    <div class="mb-3 col-12">
                        <label for="answer_question" class="visually-hidden">Answer question</label>
                        <textarea class="form-control" id="answer_question" v-model="editForm.ans_ques"  name="answer_question" rows="3" placeholder="Your Answer" required></textarea>
                    </div>
                </div>
            </form>
        </a-modal>
    </div>
</template>
<script setup>
import { ref,reactive, watch, onMounted } from 'vue';
import axios from 'axios';
import { useStore } from 'vuex';
const store = useStore();
const apiClient = store.getters.apiClient;
import { useToast } from "vue-toastification";
import { message } from 'ant-design-vue';

const cus_questions = ref([]);
const loading = ref(false);
const selectAll = ref(false);
const selectedItems = ref([]);
const deleteditem = ref();
const toast = useToast();
const totalPages = ref(1);
const currentPage = ref(1); 
const perPage = ref(10);

const getAllquestionName = async (page = 1, perPage) => {
        try {
            loading.value = true;
            const response = await apiClient.fetchData('/get-all-questions', { page, per_page: perPage });
            cus_questions.value = response.data;
            // await new Promise(resolve => setTimeout(resolve, 2000));
            // return cus_questions.value;
        } catch (err) {
            console.log('Error fetching questions:', err);
        }   finally {
            loading.value = false;
        }
    };

const toggleSelectAll = async (event) => {
    const isChecked = event.target.checked;
    // await getAllquestionName(); // Đợi dữ liệu được lấy về
    if (isChecked) {
        selectedItems.value = cus_questions.value.map(item => item._id);
    } else {
        selectedItems.value = [];
    }
};
onMounted(async () => {
    document.title = "Quản Lí Hỏi Đáp";
    await getAllquestionName();
}); 
const handleCheckboxChange = async (event, id) => {
    const isChecked = event.target.checked;
    
    try {
        const response = await apiClient.updateData(`/update-cus-question/${id}`, {
            noi_bat: isChecked
        });
        toast.success("Cập nhật trạng thái nổi bật thành công!");
        // console.log('Update successful:', response.data);
    } catch (error) {
        console.error('Error updating item:', error);
    }
};


// const messageModal = ref('');
// const open = ref(false);

// const showModalDelete = () => {
//     messageModal.value = 'Bạn có muốn xóa tất cả các phần tử được chọn không?'
//     open.value = true;
// };

// const handleOk = () => {
//     if(selectedItems.value.length > 0){
//         // console.log('các phần tử được chọn: ' +  selectedItems.value.length);
//         deleteSelectedquestions(selectedItems);
//     }else{

//         alert('Vui Lòng chọn phần từ trước khi xóa!');
//         open.value = false;
//     }
// };

// const handleCancel = () => {
//     open.value = false;
// }

// const deleteSelectedquestions = async (selectedItems) => {
//     try {
//         await getToken();
//         // console.log('phan tu duoc chon: ' + selectedItems.value);
//         const response = await apiClient.postData('/delete-selected-questions', {
//             ids: selectedItems.value
//         });
//         if(response.status === 200){
//             toast.success("Xóa thành công!");
//         }else{
//             alert(response.data.error);
//         }
//         // console.log('Xóa thành công:', response.data);

//         // Cập nhật lại danh sách sau khi xóa
//         await getAllquestionName();
//     } catch (error) {
//         alert('Lỗi khi xóa các mục:'+ error.response.data.error);
//     } finally {
//         open.value = false; // Đóng modal sau khi xử lý
//     }
// };
// const deleteItem = async (id) => {
//     // Thêm mục vào danh sách các mục được chọn
//     deleteditem.value = [id];
    
//     // Gọi hàm deleteSelectedquestions để xóa mục
//     await deleteSelectedquestions(deleteditem);
// };

// update question
const showModal = ref(false);
const editForm = ref({
    id_ques: '',
    name: '',  // Tên câu hỏi
    ans_ques: '',  // Câu trả lời
});

function openEditQuestion(item) {
    // Mở modal và truyền dữ liệu câu hỏi vào
    showModal.value = true;
    editForm.value = {
        id_ques: item._id,
        name: item.cus_ques,  
        ans_ques: item.ans_ques,  
    };
}
const handlUpdateQuestion = async () => {
    try {
        const { id_ques } = editForm.value;
        const response = await apiClient.updateData(`/update-cus-question/${id_ques}`, {
            ans_ques: editForm.value.ans_ques
        });
        toast.success("Cập nhật câu hỏi thành công!");
        await getAllquestionName(); // load lại danh sách sau khi cập nhật
        showModal.value = false;
    } catch (error) {
        console.error('Error updating item:', error);
    }
}
</script>
