// main.js
import { createApp } from 'vue';
import router from './router/index.js';
import App from './App.vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueSocialauth from 'vue-social-auth';


// cấu hình vuex
import { store } from './store';


// ant design vue
import {
    Drawer, List, Menu,DatePicker, Carousel,Spin,Breadcrumb,BreadcrumbItem,
    Button, message, Slider , Skeleton, Tabs, TabPane,Modal,
} from 'ant-design-vue';
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
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';
// import 'slick-carousel';

// ckediter vue

// fontawesome
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faFacebook, faTwitter, faYoutube, faInstagram, faLinkedin } from '@fortawesome/free-brands-svg-icons'
import { faHeart,faPenToSquare } from '@fortawesome/free-regular-svg-icons';
// import { faPhone, faBar } from '@fortawesome/free-solid-svg-icons'

const app = createApp(App);
app.use(router);
app.use(Button);
app.use(Drawer);app.use(Breadcrumb);app.use(BreadcrumbItem);
app.use(List);
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
app.mount('#app');

app.config.globalProperties.$message = message;

