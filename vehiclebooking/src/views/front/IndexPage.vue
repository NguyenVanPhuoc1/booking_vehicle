<template>
    <div>

        <!-- Carousel -->
        <div
            id="carouselExampleIndicators"
            class="carousel slide"
            :style="{ marginTop: -headerHeight + 'px' }"
        >
            <ol class="carousel-indicators">
                <li
                    data-bs-target="#carouselExampleIndicators"
                    data-bs-slide-to="0"
                    class="active"
                ></li>
                <li
                    data-bs-target="#carouselExampleIndicators"
                    data-bs-slide-to="1"
                ></li>
                <li
                    data-bs-target="#carouselExampleIndicators"
                    data-bs-slide-to="2"
                ></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img
                        src="../../assets/front/images/slide1.jpg"
                        class="d-block w-100"
                        alt="First slide"
                    />
                    <div class="row align-items-center carousel-content">
                        <div
                            class="col-12 jutify-content-center animate__animated animate__fadeInUp"
                        >
                            <h1 class="carousel-content-title">Image</h1>
                            <p class="carousel-content-text">
                                Discover the world in unparalleled comfort and
                                style.
                            </p>
                            <div class="btn border border-white text-white rounded">
                                Discover
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img
                        src="../../assets/front/images/slide2.jpg"
                        class="d-block w-100"
                        alt="Second slide"
                    />
                    <div class="row align-items-center carousel-content">
                        <div
                            class="col-12 jutify-content-center animate__animated animate__fadeInDown"
                        >
                            <h1 class="carousel-content-title">Image</h1>
                            <p
                                class="carousel-content-text d-flex justify-content-center"
                            >
                                Discover the world in unparalleled comfort and
                                style.
                            </p>
                            <div class="btn border border-white text-white rounded">
                                Discover
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img
                        src="../../assets/front/images/slide3.jpg"
                        class="d-block w-100"
                        alt="Third slide"
                    />
                    <div class="row align-items-center carousel-content">
                        <div
                            class="col-12 jutify-content-center animate__animated animate__fadeInUp"
                        >
                            <h1 class="carousel-content-title">Image</h1>
                            <p class="carousel-content-text">
                                Discover the world in unparalleled comfort and
                                style.
                            </p>
                            <div class="btn border border-white text-white rounded">
                                Discover
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a
                class="carousel-control-prev"
                href="#carouselExampleIndicators"
                role="button"
                data-bs-slide="prev"
            >
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a
                class="carousel-control-next"
                href="#carouselExampleIndicators"
                role="button"
                data-bs-slide="next"
            >
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
        <!-- Our Vehicle Fleet  -->
        <div class="our-vehicle-fleet py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div
                        class="col-md-6 col-lg-6 offset-lg-3 our-vehicle-header text-center my-4"
                    >
                        <h1 class="title text-white">Our Vehicle Fleet</h1>
                        <p class="our-vehicle-content text-white">
                            Driving your dreams to reality with an exquisite fleet
                            of versatile vehicles for unforgettable journeys.
                        </p>
                    </div>
                    <!-- car-list -->
                    <div class="car-list">
                        <div class="rows">
                            <!-- <VueSlickCarousel
                                :dots="true"
                                :arrows="true"
                                :autoplaySpeed="2000"
                                :infinite="true"
                                :responsive="[
                                    {
                                        breakpoint: 1024, // iPad và các thiết bị có độ rộng >= 1024px
                                        settings: {
                                            slidesToShow: 3,
                                            slidesToScroll: 1,
                                        },
                                    },
                                    {
                                        breakpoint: 600, // Thiết bị di động có độ rộng < 1024px
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 1,
                                        },
                                    },
                                ]"
                            > -->
                            <div class="row">
                                <!-- car item -->
                                <div v-for="(car,index) in car_outstanding" :key="index" class="col-12 col-lg-4 col-md-6 my-4">
                                    <div class="car-item rounded p-2 border">
                                        <div class="car-image">
                                            <img
                                                src="../../assets/front/images/bmw-m5.jpg"
                                                class="d-block w-100 rounded object-fit-cover "
                                                alt="Ảnh sản phẩm"
                                                style="max-height: 224px;"
                                            />
                                        </div>
                                        <div class="car-detail">
                                            <!-- name -->
                                            <div
                                                class="p-3 car-name_fav d-flex align-items-center justify-content-between text-white border-bottom"
                                            >
                                                <div class="car-name">{{ car.name }}</div>
                                                <div
                                                    class="car-fav d-flex align-items-center"
                                                >
                                                    <font-awesome-icon
                                                        :icon="['far', 'heart']"
                                                    />
                                                    <span>15</span>
                                                </div>
                                            </div>
                                            <!-- price -->
                                            <div class="daily-rate p-3">
                                                <p class="text-white m-0">
                                                    Daily rate from
                                                </p>
                                                <div
                                                    class="car-rental d-flex align-items-center justify-content-between"
                                                >
                                                    <div
                                                        class="rental-price text-white fz-5"
                                                    >
                                                        $ {{ car.price_per_day }}
                                                    </div>
                                                    <button class="btn btn-success" @click="viewDetails(car.slug)">Rent Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </VueSlickCarousel> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- range-number -->
        <div class="ranger-number">
            <!-- img -->
            <img
                class="ranger-number_img "
                src="../../assets/front/images/9.jpg"
                alt=""
            />
            <div class="container ranger-number-container rellax" data-rellax-speed="-1">
                <div class="range-number_text " >
                    <div class="row">
                        <div class="col-12 col-md-6 p-4 " data-aos="fade-left">
                            <div class="range-number-title">
                                <h2 class="text-white">
                                    We offer customers a wide range of commercial
                                    cars and luxury cars for any occasion.
                                </h2>
                            </div>  
                        </div>
                        <div class="col-12 col-md-6 p-4" data-aos="fade-right">
                            <div class="range-number-content">
                                <p class="text-white">
                                    At our car rental agency, we believe that
                                    everyone deserves to experience the pleasure of
                                    driving a reliable and comfortable vehicle,
                                    regardless of their budget. We have curated a
                                    diverse fleet of well-maintained cars, ranging
                                    from sleek sedans to spacious SUVs, all at
                                    competitive prices. With our streamlined rental
                                    process, you can quickly and conveniently
                                    reserve your desired vehicle. Whether you need
                                    transportation for a business trip, family
                                    vacation, or simply want to enjoy a weekend
                                    getaway, we have flexible rental options to
                                    accommodate your schedule.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="range-number_ins pt-4 m-2 ">
                    <div class="row">
                        <div
                            v-for="(item, index) in counters"
                            :key="index"
                            class="col-6 col-sm-3 p-2 d-flex"
                        >
                            <div class="de_count btn btn-secondary p-sm-4">
                                <h2 class="text-success">{{ item.current }}</h2>
                                <p>{{ item.title }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- our feature -->
        <div class="our-feature py-5">
            <div class="container">
                <!-- title -->
                <div class="row align-items-center">
                    <div class="col-lg-6 offset-lg-3 text-center">
                        <h1 class="title text-white">Our Feature</h1>
                        <p class="our-vehicle-content text-white">
                            Driving your dreams to reality with an exquisite fleet
                            of versatile vehicles for unforgettable journeys.
                        </p>
                    </div>
                    <div class="clearfix"></div>
                    <!-- noi dung -->
                    <div class="col-lg-3">
                        <!-- box-icon1 -->
                        <div class="box-icon text-white my-3" data-aos="fade-right" data-aos-duration="1000">
                            <div class="btn btn-success p-3 box-icon-item">
                                <font-awesome-icon :icon="['fas', 'trophy']" class="fs-3" />
                            </div>
                            <div class="our-feature-left text-white">
                                <h5 class="fw-bold">First class services</h5>
                                <p class="fs-7">Where luxury meets exceptional care, creating unforgettable moments and exceeding your every expectation.</p>
                            </div>
                        </div>
                        <!-- box-icon2 -->
                        <div class="box-icon text-white my-3" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="300">
                            <div class="btn btn-success p-3 box-icon-item">
                                <font-awesome-icon :icon="['fas', 'trophy']" class="fs-3" />
                            </div>
                            <div class="our-feature-left text-white">
                                <h5 class="fw-bold">First class services</h5>
                                <p class="fs-7">Where luxury meets exceptional care, creating unforgettable moments and exceeding your every expectation.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up">
                        <div class="d-flex align-items-center justify-content-center my-5">
                            <img class="w-100" src="../../assets/front/images/car-2.png" alt="Car" srcset="">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <!-- box-icon3 -->
                        <div class="box-icon text-white my-3 text-end" data-aos="fade-left" data-aos-duration="1000">
                            <div class="btn btn-success p-3 box-icon-item box-right">
                                <font-awesome-icon :icon="['fas', 'trophy']" class="fs-3" />
                            </div>
                            <div class="our-feature-right text-white" >
                                <h5 class="fw-bold">First class services</h5>
                                <p class="fs-7">Where luxury meets exceptional care, creating unforgettable moments and exceeding your every expectation.</p>
                            </div>
                        </div>
                        <!-- box-icon4 -->
                        <div class="box-icon text-white my-3 text-end" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                            <div class="btn btn-success p-3 box-icon-item  box-right">
                                <font-awesome-icon :icon="['fas', 'trophy']" class="fs-3" />
                            </div>
                            <div class="our-feature-right text-white">
                                <h5 class="fw-bold">First class services</h5>
                                <p class="fs-7">Where luxury meets exceptional care, creating unforgettable moments and exceeding your every expectation.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- Lasted New -->
        <div class="lasted-news py-5" v-if="news_outstanding.length > 0">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 offset-lg-3 text-center">
                        <h1 class="title text-white">Lastest News</h1>
                        <p class="our-vehicle-content text-white">
                            Breaking news, fresh perspectives, and in-depth coverage - stay 
                            ahead with our latest news, insights, and analysis.
                        </p>
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
                    <!-- <div class="col-12 col-sm-6 col-lg-4 bloglist d-flex flex-column">
                        <div class="post-content my-3">
                            <div class="post-image">
                                <div class="rounded-3 overflow-hidden">
                                    <img class="w-100" src="../../assets/front/images/pic-blog-2.jpg" alt="Blog1">
                                </div>
                                <div class="post-date btn btn-success">
                                    <div class="m">12</div>
                                    <div class="d">MAR</div>
                                </div>
                            </div>
                            <div class="post-text text-white rounded-top  p-3 py-4  border-bottom border-3 border-success">
                                <h4 class="text-center">The Future of Car Rent</h4>
                                <p class="text-secondary">As technology continues to advance at a rapid pace, the car rental industry is 
                                    poised for a transformative shift. The future of car rental promises.
                                </p>
                                <div class="btn border border-secondary rounded text-white fw-bold">Read More</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 bloglist d-flex flex-column">
                        <div class="post-content my-3">
                            <div class="post-image">
                                <div class="rounded-3 overflow-hidden">
                                    <img class="w-100" src="../../assets/front/images/pic-blog-3.jpg" alt="Blog1">
                                </div>
                                <div class="post-date btn btn-success">
                                    <div class="m">14</div>
                                    <div class="d">MAR</div>
                                </div>
                            </div>
                            <div class="post-text text-white rounded-top  p-3 py-4  border-bottom border-3 border-success">
                                <h4 class="text-center">Holiday Tips For Backpacker</h4>
                                <p class="text-secondary">For adventure seekers and budget-conscious travelers, backpacking offers a thrilling and
                                    immersive way to explore the world. Whether you're embarking..
                                </p>
                                <div class="btn border border-secondary rounded text-white fw-bold">Read More</div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- advice -->
        <div class="advices ">
            <div class="rellax" data-rellax-speed="1" >
                <img src="../../assets/front/images/3.jpg" alt="" class="w-100 h-100 advices-background">
            </div>
            <div class="container content">
                <div class="row">
                    <div class="col-12 col-lg-3 m-4 m-lg-0 ">
                        <h1 class="carousel-content-title">Let's Your Adventure Begin</h1>
                    </div>
                    <div class="col-12 col-sm-4 col-lg-3 ">
                        <div class="btn btn-success p-3 ">
                            <font-awesome-icon :icon="['fas', 'trophy']" class="fs-3" />
                        </div>
                        <h4 class="text-white my-3">First Class Services</h4>
                        <p class="text-secondary">Where luxury meets exceptional care, creating unforgettable 
                            moments and exceeding your every expectation.
                        </p>
                    </div>
                    <div class="col-12 col-sm-4 col-lg-3  ">
                        <div class="btn btn-success p-3 ">
                            <font-awesome-icon :icon="['fas', 'trophy']" class="fs-3" />
                        </div>
                        <h4 class="text-white my-3">24/7 road assistance</h4>
                        <p class="text-secondary">Reliable support when you need it most,
                            keeping you on the move with confidence and peace of mind.
                        </p>
                    </div>
                    <div class="col-12 col-sm-4 col-lg-3 ">
                        <div class="btn btn-success p-3 ">
                            <font-awesome-icon :icon="['fas', 'trophy']" class="fs-3" />
                        </div>
                        <h4 class="text-white my-3">Free Pick-Up & Drop-Off</h4>
                        <p class="text-secondary">Enjoy free pickup and drop-off services, 
                            adding an extra layer of ease to your car rental experience.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- questions -->
        <div class="questions py-5">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-6 offset-lg-3 text-center my-4">
                        <h1 class="title text-white fw-bold">Have Any Questions?</h1>
                    </div>
                    <div class="clear-fix"></div>
                    <div class="row" data-aos="fade-up">
                        <div v-for="(item, index) in items" :key="index" class="col-12 col-lg-6 question-inner mb-3">
                            <div class="card-body">
                                <div class="wh-question d-flex justify-content-between align-items-center border-bottom border-secondary">
                                    <p class="text-white my-3">{{ item.question }}</p>
                                    <font-awesome-icon
                                        class="btn btn-success"
                                        :icon="item.expanded ? ['fas', 'angle-up'] : ['fas', 'angle-down']"
                                        @click="toggleAnswer(index)"
                                    />
                                </div>
                                <div class="wh-answer text-secondary my-4" v-show="item.expanded">
                                    {{ item.answer }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup >
// vue slick slider
import "vue-slick-carousel/dist/vue-slick-carousel.css";
import "vue-slick-carousel/dist/vue-slick-carousel-theme.css";
import VueSlickCarousel from "vue-slick-carousel";
import "animate.css/animate.min.css";
import { ref, onMounted, computed } from "vue";
// thư viện vuex
import { useStore } from "vuex";
import { useRouter } from 'vue-router';
const store = useStore();
const apiClient = store.getters.apiClient;
// rellax
import Rellax from 'rellax';
import AOS from 'aos';
import 'aos/dist/aos.css';
onMounted(() => {
    document.title = "Trang Chủ";
});

// set chiều cao cho header với carrousel
const headerHeight = computed(() => store.getters.headerHeight);

// count number
const counters = ref([
    { target: 800, current: 0, title: "Completed Orders" },
    { target: 527, current: 0, title: "Happy Customer" },
    { target: 235, current: 0, title: "Vehicles Fleet" },
    { target: 15, current: 0, title: "Years Experience" },
]);

const duration = 2000; // Tổng thời gian tính bằng mili giây
const interval = 10; // Khoảng thời gian giữa mỗi lần cập nhật (10ms)

const updateCounter = (item) => {
    const steps = duration / interval; // Tổng số bước cập nhật
    const increment = (item.target - item.current) / steps; // Tính toán bước nhảy cho mỗi bước

    // Cập nhật giá trị hiện tại
    item.current += Math.max(2, Math.floor(increment));

    if (item.current < item.target) {
        setTimeout(() => updateCounter(item), interval);
    } else {
        item.current = item.target; // Đảm bảo chính xác đạt giá trị target
    }
};

// Khởi động quá trình khi thành phần được mount
onMounted(() => {
    counters.value.forEach((item) => {
        updateCounter(item);
    });
});


onMounted(async () => {
    const rellax = new Rellax('.rellax');
    AOS.init({
        duration: 1200, // Thời gian của hiệu ứng
    });

    try {
        await Promise.all([fetchCarsOutStanding(), fetchNewsOutStanding()]);
    } catch (err) {
        console.error('Error fetching data:', err);
    }
});
// questions
const items = ref([
    {
        question: 'How do I get started with Car Rental?',
        answer: 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.',
        expanded: false
    },
    {
        question: 'What is a rental car security deposit?',
        answer: 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.',
        expanded: false
    },
]);

const toggleAnswer = (index) => {
    items.value[index].expanded = !items.value[index].expanded;
};

// get data car outstanding
const error = ref([]);
let car_outstanding = ref([]);
let news_outstanding = ref([]);

// lấy sản phẩm nổi bật
const fetchCarsOutStanding = async () => {
        try {
            error.value = null;
            const data = await apiClient.fetchData('/cars-outstanding',{});
            car_outstanding.value = data;
            // console.log(car_outstanding.value);
            await new Promise(resolve => setTimeout(resolve, 2000));
            return;
        } catch (err) {
            console.log('Error fetching cars:', err);
        }   
    };
const fetchNewsOutStanding = async () => {
        try {
            error.value = null;
            const data = await apiClient.fetchData('/get-news-outstanding',{
                page : 'index_page',
            });
            news_outstanding.value = data.map(news => {
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
            await new Promise(resolve => setTimeout(resolve, 2000));
            return;
        } catch (err) {
            console.log('Error fetching cars:', err);
        }   
    };
// view detail thong qua slug product
// const router = useRouter();
// const viewDetails = async (slug: string) => {
//     await router.push({ name: 'frontend-productdetail', params: { slug } });
// };
import useViewDetails from '@/services/utils';
const { viewDetails } = useViewDetails(); // Sử dụng hàm chung

    const navigateToDetails = async (slug) => {
        await viewDetails(slug);
    };
</script>

<style scoped>

</style>