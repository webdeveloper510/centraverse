<?php echo $__env->make('partials.admin.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }
        </style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body>
    <div class = "container mt-5">
        <div class= "row">
            <div class = "alert alert-danger message flex-center">
                <p>Agreement is already signed .You can't access it anymore!</p>
            </div>
        </div>
        <div class= "row">
            <div class = "col-md-12 text-center">
                <a href ="<?php echo e(route('payviamode',urlencode(encrypt($id)))); ?>" >Redirect to payment</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\centraglobe\main-file\resources\views/meeting/agreement_error.blade.php ENDPATH**/ ?>