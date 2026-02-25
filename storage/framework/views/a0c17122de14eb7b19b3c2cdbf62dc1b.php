<!DOCTYPE html>
<html lang="en" class=" layout-wide  customizer-hide">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name="robots" content="noindex, nofollow" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title>Product</title>
        <link rel="preconnect" href="https://fonts.googleapis.com/" />
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/iconify-icons.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/toastr.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/core.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>" />
        <script>
        var base_url = "<?php echo e(url('')); ?>";
        </script>
        <style>
            .success-msg, .error-msg{
                padding: 12px 15px;
                margin-bottom: 15px;
                border-radius: 4px;
                font-size: 14px;
            }

            .success-msg {
                color: #155724;
                background-color: #d4edda;
                border: 1px solid #c3e6cb;
            }

            .error-msg {
                color: #721c24;
                background-color: #f8d7da;
                border: 1px solid #f5c6cb;
            }
            .float-right {
                float: right;
            }
        </style>
    </head>
    <body><?php /**PATH D:\xampp_8.1.6\htdocs\product_crud\resources\views/includes/header.blade.php ENDPATH**/ ?>