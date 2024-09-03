<template>
    <div class="brandmane-page mb-3">
        <h3 class="fw-bold px-3">Quản Lí</h3>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 col-lg-3">
                    <ul class="d-flex list-unstyled m-0">
                        <li class="nav-item py-0 justify-content-sm-start">
                            <div class="btn btn-primary">
                                <font-awesome-icon :icon="['fas', 'save']" />
                                Lưu
                            </div>
                        </li>
                        <li class="nav-item py-0 ps-4">
                            <div class="btn btn-danger">
                                <font-awesome-icon :icon="['fas', 'sign-out-alt']" />
                                Thoát
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <a-breadcrumb class="my-4">
                <a-breadcrumb-item>Bảng Điều Khiển</a-breadcrumb-item>
                <a-breadcrumb-item><a class="text-primary text-decoration-none" href="">Quản Lí Hãng</a></a-breadcrumb-item>
            </a-breadcrumb>
        </div>
    </div>
</template>