function myToastr(msg, type) {
    toastr.remove();
    if (type == 'error') {
        toastr['error']('', msg);
    } else if (type == 'success') {
        toastr['success']('', msg);
    }
}

function deleteProduct(id) {
    if (!confirm('Are you sure you want to delete?')) return;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "DELETE",
        url: base_url + "/delete-product/" + id,
        dataType: "json",
        success: function (response) {
            if (response.status) {
                myToastr(response.message,'success');
                $('#product-row-' + id).remove(); 
            } else {
                myToastr(response.message,'error');
            }
        },
        error: function () {
            showMessage('#add-msg', 'error', 'Server error while deleting.');
        }
    });
}

function validateProduct(formid,event) {
    var $form = $("#" + formid);
    var data = new FormData($form[0]);
    if (data.get('product_name') == '') {
        myToastr('Please enter product name','error');
        return false;
    } else if (data.get('product_price') == '') {
        myToastr('Please enter product price','error');
        return false;
    } else if (data.get('product_description') == '') {
        myToastr('Please enter product description','error');
        return false;
    } else {
        $.ajax({
            url: $form.attr('action'),
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            success: function(res){
                if(res.status){
                    myToastr(res.message,'success');
                    if(data.get('id') == 0){
                        $form[0].reset();
                        $('#newImagePreview_add').html('');
                    }
                    reloadProductList();
                }else{
                    myToastr(res.message,'error');
                }
            },
            error:function(){
                myToastr('Something went wrong','error');
            }
        });
        return false;
    }
}

var selectedFiles = {};

$(document).on('change', '.images-input', function(e){
    var input = this;
    var productId = $(this).data('id'); // unique per edit form

    if(!selectedFiles[productId]){
        selectedFiles[productId] = [];
    }

    var files = e.target.files;

    for(var i = 0; i < files.length; i++){
        selectedFiles[productId].push(files[i]);
    }

    renderPreviews(productId, input);
});

function renderPreviews(productId, input){
    var previewDiv = $('#newImagePreview_' + productId);
    previewDiv.html('');

    selectedFiles[productId].forEach(function(file, index){
        var reader = new FileReader();
        reader.onload = function(e){
            previewDiv.append(
                '<div class="m-2 position-relative">' +
                    '<img src="' + e.target.result + '" width="80" height="80" class="rounded">' +
                    '<span onclick="removeImage(\''+productId+'\','+index+')" ' +
                    'style="cursor:pointer;position:absolute;top:0;right:5px;color:red;">×</span>' +
                '</div>'
            );
        };
        reader.readAsDataURL(file);
    });

    updateInputFiles(productId, input);
}

function removeImage(productId, index){
    selectedFiles[productId].splice(index, 1);

    var input = $('.images-input[data-id="'+productId+'"]')[0];
    renderPreviews(productId, input);
}

function updateInputFiles(productId, input){
    var dt = new DataTransfer();

    selectedFiles[productId].forEach(function(file){
        dt.items.add(file);
    });

    input.files = dt.files;
}

function deleteOldImage(id){
    if(!confirm('Delete this image?')) return;

    $.ajax({
        url: base_url+'/delete-product-image/'+id,
        type:'DELETE',
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
        success:function(res){
            if(res.status){
                $('#old-image-'+id).remove();
            }
        }
    });
}

function reloadProductList(){
    $.ajax({
        url: base_url + "/product-list-ajax",
        type: "GET",
        success: function(html){
            $('#productListDiv').html(`
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
                        ${html}
                    </table>
                </div>
            `);
        }
    });
}