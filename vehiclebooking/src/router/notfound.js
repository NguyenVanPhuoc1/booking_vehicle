const notfound = [
    {
        path: '/404',
        name: 'not-found',
        component: () => import("../views/NotFound.vue")
    },
    { 
        path: '/:catchAll(.*)', 
        redirect: '/404' // Redirect tất cả các route không tồn tại về 404
    },
];
export default notfound;