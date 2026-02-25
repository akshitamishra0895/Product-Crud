<tbody>  
    <?php $i=0; ?> 
    <?php if(count($result) > 0): ?> 
        <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <?php $i++; ?> 
            <tr id="product-row-<?= $row['id']; ?>">
                <td><?php echo $i;?></td>
                <td>
                    <div class="d-flex flex-wrap">
                        <?php $__currentLoopData = $row->product_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e(asset('uploads/products/'.$img->product_image)); ?>"
                                width="50"
                                height="50"
                                class="me-1 mb-1 rounded"
                                style="object-fit:cover;">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </td>
                <td><?php echo $row['product_name'];?></td>
                <td>₹<?php echo rtrim(rtrim($row['product_price'],'0'),'.');?></td>
                <td><?php echo $row['product_description'];?></td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="icon-base ti tabler-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" type="button" data-bs-toggle="offcanvas" data-bs-target="#edit-new-record_<?php echo $row['id'];?>" aria-controls="edit-new-record_<?php echo $row['id'];?>" title="Edit">
                            <i class="icon-base ti tabler-edit me-1 margin-top-negative-4"></i> Edit </a>
                            <a class="dropdown-item" type="button" onclick="deleteProduct(<?= $row['id']; ?>)" title="Delete">
                            <i class="icon-base ti tabler-trash me-1 margin-top-negative-4"></i>Delete</a>
                        </div>
                        
                    </div>
                    <div class="offcanvas offcanvas-end" id="edit-new-record_<?php echo $row['id'];?>">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title" id="exampleModalLabel">Edit Product</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body flex-grow-1">
                            <div id="update-msg_<?php echo $row['id'];?>"></div>
                            <form class="add-new-record pt-0 row g-2" id="edit-record_<?php echo e($row->id); ?>" action="<?php echo e(url('update-product')); ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateProduct('edit-record_<?php echo e($row->id); ?>');">  
                                <?php echo csrf_field(); ?> 
                                <div class="col-sm-12">
                                    <input type="hidden" name="id" value="<?php echo $row['id'];?>">                                                          
                                    <div class="mb-1">
                                        <label class="form-label" for="product_name">Name <span class="required">*</span></label>
                                        <input type="text" class="form-control dt-full-name" id="product_name_<?php echo $row['id'];?>" placeholder="Enter Name" name="product_name" value="<?php echo $row['product_name'];?>">
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="product_price">Price <span class="required">*</span></label>
                                        <input type="text" class="form-control dt-full-name" id="product_price_<?php echo $row['id'];?>" placeholder="Enter Price" name="product_price" value="<?php echo rtrim(rtrim($row['product_price'],'0'),'.');?>" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1')">
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="product_description_<?php echo $row['id'];?>">Description <span class="required">*</span></label>
                                        <textarea class="form-control dt-full-name" id="product_description_<?php echo $row['id'];?>" placeholder="Enter Product Description" name="product_description" value="<?php echo $row['product_description'];?>"><?php echo $row['product_description'];?></textarea>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label">Product Images</label>
                                        <input type="file" name="images[]" class="form-control images-input" multiple data-id="<?php echo $row['id'];?>">
                                        <div id="newImagePreview_<?php echo $row['id'];?>" class="d-flex flex-wrap mt-2"></div>
                                        <div class="d-flex flex-wrap mt-2" id="oldImages">
                                            <?php $__currentLoopData = $row->product_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div id="old-image-<?php echo e($img->id); ?>" class="m-2 position-relative">
                                                    <img src="<?php echo e(asset('uploads/products/'.$img->product_image)); ?>" width="80" height="80">
                                                    <span onclick="deleteOldImage(<?php echo e($img->id); ?>)" 
                                                        style="cursor:pointer;position:absolute;top:0;right:5px;color:red;">×</span>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Save</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
        <?php else: ?> 
            <tr>
                <td colspan="7" class="record-not-found">
                    <span>Record not found</span>
                </td>
            </tr> 
        <?php endif; ?> 
</tbody><?php /**PATH D:\xampp_8.1.6\htdocs\product_crud\resources\views/includes/product_list.blade.php ENDPATH**/ ?>