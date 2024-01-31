<?php
$settings             = Utility::settings();
$logo         = asset(\Storage::url('logo/'));
$dark_logo    = Utility::getValByName('dark_logo');
$img = asset($logo . '/' . (isset($dark_logo) && !empty($dark_logo) ? $dark_logo : 'logo-dark.png'));
?>




<?php $__env->startSection('content'); ?>
<div class="row" >

    <div class="col-lg-10">
        <div class="container">
            <div>
                
                    <div class="row" style="margin-left: 976px;">
                        <div class="col-auto pe-0" style="    margin-left: 43px; margin-bottom: -32px;">
                            
                        </div>
                        <div class="col-auto pe-0" style="margin-left: 200px;">
        
                        </div>
                        
                    </div>
            </div>
                <div class="card mt-4" id="printTable" style="margin-left: 180px;margin-right: -66px;">
                    <div class="card-body" id="boxes">
                        <div class="row invoice-title mt-2">
                            <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 ">
                                <img  src="<?php echo e($img); ?>" style="max-width: 150px;"/>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                                <h3 class="invoice-number"><?php echo e(\Auth::user()->contractNumberFormat($contract->id)); ?></h3>
                            </div>    
                        </div>
                        <div class="row align-items-center mb-4">
                            
                            <div class="col-sm-6 mb-3 mb-sm-0 mt-3">
                                <div class="mb-3">
                                    <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Contract Type  :')); ?></h6>
                                    <span class="col-md-8"><span class="text-md"><?php echo e($contract->contract_type->name); ?></span></span>
                                </div>
                                <div class="col-lg-6 col-md-8">
                                <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Contract Value   :')); ?></h6>
                                <span class="col-md-8"><span class="text-md"><?php echo e(Auth::user()->priceFormat($contract->value)); ?></span></span>
                            </div>
                            
                                
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <div>
                                    <div class="float-end">
                                        <div class="">
                                            <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Start Date   :')); ?></h6>
                                            <span class="col-md-8"><span class="text-md"><?php echo e(Auth::user()->dateFormat($contract->start_date)); ?></span></span>
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('End Date   :')); ?></h6>
                                            <span class="col-md-8"><span class="text-md"><?php echo e(Auth::user()->dateFormat($contract->end_date)); ?></span></span>
                                        </div>
                                    
                                        
                                    </div>

                                </div>
                            </div>
                        </div>
                        <p data-v-f2a183a6="">
                            
                            <div><?php echo $contract->notes; ?></div>
                            <br>
                            <div><?php echo $contract->description; ?></div>
                        </p>
                        <div class="row">
                            <div class="col-6">
                                <img src="<?php echo e($contract->client_signature); ?>" style="width:20%; margin-left: 50px;" alt="">
                                <h5 class="mt-auto" style="    margin-left: 20px;    margin-bottom: 46px;"><?php echo e(__('Customer Signature')); ?></h5>
                            </div>
                            <div class="col-6 text-end" style="    margin-top: 17px;">
                                <img src="<?php echo e($contract->owner_signature); ?>" style="width:20%;     margin-right: 38px; " alt="">
                                <h5 class="mt-auto" style="    margin-right: 24px;"><?php echo e(__('Company Signature')); ?></h5>
                            </div>
                            
                        </div>
                    </div>

                    


                </div>
            
            </div>
        </div>
    </div>


</div>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<script src="<?php echo e(asset('js/jquery.min.js')); ?> "></script>
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
        function closeScript() {
            setTimeout(function () {
                window.open(window.location, '_self').close();
            }, 1000);
        }

        $(window).on('load', function () {
            var element = document.getElementById('boxes');
            var opt = {
                filename: '<?php echo e($usr->contractNumberFormat($contract->contract_id)); ?>',
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A4'}
            };

            html2pdf().set(opt).from(element).save().then(closeScript);
        });
    </script>
<?php $__env->stopPush(); ?>









<?php echo $__env->make('layouts.contractpayheader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/contracts/template.blade.php ENDPATH**/ ?>