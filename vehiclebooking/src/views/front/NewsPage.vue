<template>
    <div>
        <!-- booking title -->
        <div class="vel-booking"  :style="{ marginTop: -headerHeight + 'px' }">
            <div class="container">
                <div class="row align-items-center d-flex">
                    <h1 class="text-white fw-bold fs-1 text-center">News</h1>
                </div>
            </div>
        </div>
        <!-- News Main -->
        <div class="new-main" >
            <div class="container">
                <!-- list news -->
                <div class="row align-items-center">
                    <div class="col-lg-6 offset-lg-3 text-center">
                        <h1 class="title text-black fw-bold my-4">News List</h1>
                    </div>
                    <div class="clearfix"></div>
                    <div v-for="(news,index) in news_outstanding" :key="index" class="col-12 col-sm-6 col-lg-4 bloglist d-flex flex-column">
                        <div class="post-content my-3">
                            <div class="post-image">
                                <div class="rounded-3 overflow-hidden">
                                    <img class="w-100" :src="'../../../src/assets/front/images/' +  news.news_image " :alt="'Blog' + index ">
                                </div>
                                <div class="post-date btn btn-success">
                                    <div class="m">{{  news.created_at.split(" ")[1] }}</div>
                                    <div class="d">{{ news.created_at.split(" ")[0].substr(0,3).toUpperCase() }}</div>
                                </div>
                            </div>
                            <div class="post-text text-white rounded-top  p-3 py-4  border-bottom border-3 border-success">
                                <h4 class="text-center">{{ news.news_name }}</h4>
                                <p class="text-secondary">{{ news.news_des.substr(0, 100) }} ...
                                </p>
                                <div class="btn border border-secondary rounded text-white fw-bold">Read More</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- spin loading page -->
            <div  v-if="loading" class="my-3 text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup> 
    import { ref, onMounted, computed } from "vue";
    // thư viện vuex
    import { useStore } from "vuex";
    import Rellax from 'rellax';
    const store = useStore();
    const apiClient = store.getters.apiClient;
    onMounted(() => {
        const rellax = new Rellax('.rellax');
    });
    onMounted(() => {
        document.title = "News";
        fetchNewsOutStanding();

         // Thêm sự kiện cuộn
        window.addEventListener('scroll', handleScroll);
    });
    // set chiều cao cho header với carrousel
    const headerHeight = computed(() => store.getters.headerHeight);

    //const displayedNews = computed(() => news_outstanding.value.slice(0, page * 3));
    let news_outstanding = ref([]);
    let error = ref({});
    const loading = ref(false);
    let page = 1; 
    const fetchNewsOutStanding = async () => {
        try {
            error.value = null;
            loading.value = true;

            await new Promise(resolve => setTimeout(resolve, 1000));

            const data = await apiClient.fetchData(`/get-news-outstanding?page=${page}`,{});
            news_outstanding.value = data.slice(0, page * 3).map(news => {
                const date = new Date(news.created_at);
                const formattedDate = date.toLocaleDateString('en-US', {
                    month: 'long',
                    day: 'numeric'
                });

                return {
                    ...news,  // Giữ lại các trường khác của news
                    created_at: formattedDate // Cập nhật lại created_at với ngày đã định dạng
                };
            });
            // console.log(news_outstanding.value);
            loading.value = false;
            page++;
        } catch (err) {
            console.log('Error fetching cars:', err);
        }   
    };

const handleScroll = () => {
    const bottomOfWindow =
        window.innerHeight + window.scrollY >= document.documentElement.offsetHeight;

    if (bottomOfWindow && !loading.value) {
        fetchNewsOutStanding();
    }
};

</script>

<style>
   
</style>