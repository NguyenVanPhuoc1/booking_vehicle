// main.js
import { createApp } from 'vue';
import App from './App.vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueSocialauth from 'vue-social-auth';


// cấu hình vuex
import { store } from './store';
import router from './router/index.js';


// ant design vue
import {
    Drawer, List, Menu,DatePicker, Carousel,Spin,Breadcrumb,BreadcrumbItem,
    Button, message, Slider , Skeleton, Tabs, TabPane,Modal,Upload,UploadDragger,
} from 'ant-design-vue';
// import { ExclamationCircleOutlined } from '@ant-design/icons-vue';
// import { h } from 'vue';
import 'ant-design-vue/dist/reset.css';

// Toast Notification
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';
// css files
import '@/assets/front/css/header.css'
import '@/assets/front/css/menu.css'
import '@/assets/front/css/style.css'

// boostrap
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/css/bootstrap-grid.min.css'
import 'bootstrap/dist/css/bootstrap-utilities.min.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'

// import $ from 'jquery';

import 'vue3-carousel/dist/carousel.css';
//animate
import "animate.css/animate.min.css";
// import 'slick-carousel';

// ckediter vue

// fontawesome
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faFacebook, faTwitter, faYoutube, faInstagram, faLinkedin } from '@fortawesome/free-brands-svg-icons'
import { faHeart,faPenToSquare } from '@fortawesome/free-regular-svg-icons';

// import apiClient from '@/services/ApiClient.js';
// import { faPhone, faBar } from '@fortawesome/free-solid-svg-icons'
import VueSocialSharing from 'vue-social-sharing'

const app = createApp(App);
app.use(VueSocialSharing);
app.use(router);
app.use(Button);
app.use(Drawer);app.use(Breadcrumb);app.use(BreadcrumbItem);
app.use(List);app.use(Upload);
app.use(Menu);
app.use(Slider);
app.use(Skeleton);
app.use(Spin);
app.use(Tabs);
app.use(Modal);
app.use(TabPane);
app.use(Carousel);
app.use(DatePicker);
app.use(store);
app.use(Toast, {
    position: 'top-right',
    timeout: 3000,
    closeOnClick: true,
    pauseOnHover: false,
    draggable: false,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: true,
    closeButton: 'button',
    icon: true,
    rtl: false,
});


// font awesome
import { faPhone, faBars, faTrophy, faAngleUp, faAngleDown, faHome, faUser, faCalendarDay, faCar, 
    faKey,faQuestion,faReply,faUsersCog,faPlus,faTrash, faSave,
    faSignOutAlt, faCalendarCheck, faCalendarTimes, faCheck} from '@fortawesome/free-solid-svg-icons'
library.add(faFacebook, faTwitter, faYoutube, faInstagram, faLinkedin, faPhone, faBars, faHeart, 
    faCheck,faKey,faQuestion,faReply,faUsersCog,faPlus,faTrash,faPenToSquare,faSave,
    faTrophy, faAngleUp, faAngleDown, faHome, faUser, faCalendarDay, faCar, faSignOutAlt, faCalendarCheck,faCalendarTimes);
app.component('font-awesome-icon', FontAwesomeIcon);

app.config.globalProperties.$message = message;
app.mount('#app');

