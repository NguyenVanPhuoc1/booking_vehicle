<template>
    <div>
        <div class="productcrud-page mb-3">
            <h3 class="fw-bold px-3">Quản Lí Sản Phẩm</h3>
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
                    <a-breadcrumb-item><a class="text-primary text-decoration-none" href="">Thêm mới</a></a-breadcrumb-item>
                </a-breadcrumb>
            </div>
        </div>
    
        <section class="brand-form">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card card-primary card-outline text-sm mb-0">
                        <div class="card-header">
                            <h4 class="card-title fw-bold">Nội dung Sản Phẩm</h4>
                        </div>
                        <div class="card-body">
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="tabs-lang" data-toggle="pill" href="#tabs-lang-vi" role="tab"
                                                aria-controls="tabs-lang-vi" aria-selected="true">Tiếng Việt</a>
                                        </li>                
                                    </ul>
                                </div>
                                <div class="card-body card-article">
                                    <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                        <div class="tab-pane fade show active" id="tabs-lang-vi" role="tabpanel" aria-labelledby="tabs-lang">
                                            <div class="form-group py-3">
                                                <label class="d-block mb-2" for="slug_name_cate">Đường dẫn mẫu (vi): <span class="text-danger">https://admin.com/san-pham</span></label>
                                                <input class="form-control" type="text" name="slug_name_cate" id="slug_name_cate" placeholder="Đường dẫn" readonly>
                                            </div>
                                            <div class="form-group py-3">
                                                <label for="cate_name mb-2">Tên Sản Phẩm (vi):</label>
                                                <input type="text" class="form-control for-seo text-sm " name="cate_name" id="cate_name" placeholder="Tên Danh Mục" value="" required>
                                            </div>
                                            <p class="pt-3 m-1">Nội Dung :</p>
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                                <label for="floatingTextarea">Nội Dung</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script setup>



</script>