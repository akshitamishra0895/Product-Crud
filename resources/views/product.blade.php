@include('includes/header') 
<div class="layout-wrapper layout-content-navbar  ">
    <div class="layout-container">
        <div class="menu-mobile-toggler d-xl-none rounded-1"></div>
        <div class="layout-page">
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4 display-inline-block">
                        <span class="text-muted fw-light">
                        </span>Product List
                    </h4>
                    <button class="btn btn-primary float-right mt-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#add-new-record" aria-controls="add-new-record" title="Add Product">
                        <span>
                            <i class="icon-base ti tabler-plus me-md-1"></i>
                            <span class="d-md-inline-block d-none">Add Product</span>
                        </span>
                    </button>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title display-inline-block">Product List</h5>
                            <!-- <h6 class="float-right">  Showing 1-3 of 3  </h6> -->
                        </div>
                        <div id="list-msg"></div>
                        <div id="productListDiv">
                            <div class="table-responsive"> 
                                <table class="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Images</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @include('includes/product_list',['result'=>$result])
                                </table> 
                            </div>
                        </div>
                        <div class="card-footer"><div class="pagination" style="float: right;"></div></div>
                    </div>
                    <div class="offcanvas offcanvas-end" id="add-new-record">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title" id="exampleModalLabel">Add Product</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body flex-grow-1">
                            <div id="add-msg"></div>
                            <form class="add-new-record pt-0 row g-2" id="add-record" onsubmit="return validateProduct('add-record');" action="{{url('add-product')}}" method="POST" enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="id" value="0">   
                                <div class="col-sm-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="product_name">Name <span class="required">*</span></label>
                                        <input type="text" class="form-control dt-full-name" id="product_name" placeholder="Enter Name" name="product_name">
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="product_price">Price <span class="required">*</span></label>
                                        <input type="text" class="form-control dt-full-name" id="product_price" placeholder="Enter Price" name="product_price" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1')">
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="product_description">Description <span class="required">*</span></label>
                                        <textarea class="form-control dt-full-name" id="product_description" placeholder="Enter Product Description" name="product_description"></textarea>
                                    </div>
                                    <div class="mb-1">
                                        <label>Product Images</label>
                                        <input type="file" name="images[]" class="form-control images-input" multiple data-id="add">
                                        <div id="newImagePreview_add" class="d-flex flex-wrap mt-2"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Save</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>  
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl">
                        <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                            <div class="text-body">
                                &#169;
                                2025
                            </div>
                        </div>
                    </div>
                </footer> 
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
</div>
@include('includes/footer') 