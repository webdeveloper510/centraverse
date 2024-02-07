 
 <?php $__env->startSection('page-title'); ?>
     <?php echo e(__('Invoice')); ?>

 <?php $__env->stopSection(); ?>
 <?php $__env->startSection('title'); ?>
     <?php echo e(__('Invoice')); ?>

 <?php $__env->stopSection(); ?>
 <?php $__env->startSection('breadcrumb'); ?>
     <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
     <li class="breadcrumb-item"><?php echo e(__('Invoice')); ?></li>
 <?php $__env->stopSection(); ?>
 <?php $__env->startSection('action-btn'); ?>
     <div class="action-btn ms-2">
         <a href="<?php echo e(route('invoice.export')); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip"
             data-title=" <?php echo e(__('Export')); ?>" title=" <?php echo e(__('Export')); ?>">
             <i class="ti ti-file-export"></i>
         </a>
     </div>

     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Invoice')): ?>
         <div class="action-btn ms-2">
             <a href="#" data-size="lg" data-url="<?php echo e(route('invoice.create', ['invoice', 0])); ?>" data-ajax-popup="true"
                 data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Invoice')); ?>" title=" <?php echo e(__('Create')); ?>"
                 class="btn btn-sm btn-primary btn-icon m-1">
                 <i class="ti ti-plus"></i>
             </a>
         </div>
     <?php endif; ?>
 <?php $__env->stopSection(); ?>
 <?php $__env->startSection('filter'); ?>
 <?php $__env->stopSection(); ?>

 <?php $__env->startSection('content'); ?>
     <div class="row">
         <div class="col-xl-12">
             <div class="card">
                 <div class="card-body table-border-style">
                     <div class="table-responsive">
                         <table class="table datatable" id="datatable">
                             <thead>
                                 <tr>
                                     <th scope="col" class="sort" data-sort="id"><?php echo e(__('ID')); ?></th>
                                     <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                     <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Account')); ?></th>
                                     <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?></th>
                                     <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Created At')); ?>

                                     </th>
                                     <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Amount')); ?></th>
                                     <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Assigned User')); ?>

                                     </th>
                                     <?php if(Gate::check('Show Invoice') || Gate::check('Edit Invoice') || Gate::check('Delete Invoice')): ?>
                                         <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                     <?php endif; ?>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <tr>
                                         <td>
                                             <a href="<?php echo e(route('invoice.edit', $invoice->id)); ?>"
                                                 class="btn btn-outline-primary" data-title="<?php echo e(__('Quote Details')); ?>">
                                                 <?php echo e(\Auth::user()->invoiceNumberFormat($invoice->invoice_id)); ?>

                                             </a>
                                         </td>
                                         <td>
                                             <span class="budget">
                                                 <?php echo e(ucfirst($invoice->name)); ?>


                                             </span>
                                         </td>
                                         <td>
                                             <span class="budget">
                                                 <?php echo e(ucfirst(!empty($invoice->accounts) ? $invoice->accounts->name : '--')); ?></span>
                                         </td>
                                         <td>
                                             <?php if($invoice->status == 0): ?>
                                                 <span class="badge bg-secondary p-2 px-3 rounded"
                                                     style="width: 91px;"><?php echo e(__(\App\Models\Invoice::$status[$invoice->status])); ?></span>
                                             <?php elseif($invoice->status == 1): ?>
                                                 <span class="badge bg-danger p-2 px-3 rounded"
                                                     style="width: 91px;"><?php echo e(__(\App\Models\Invoice::$status[$invoice->status])); ?></span>
                                             <?php elseif($invoice->status == 2): ?>
                                                 <span class="badge bg-warning p-2 px-3 rounded"
                                                     style="width: 91px;"><?php echo e(__(\App\Models\Invoice::$status[$invoice->status])); ?></span>
                                             <?php elseif($invoice->status == 3): ?>
                                                 <span class="badge bg-success p-2 px-3 rounded"
                                                     style="width: 91px;"><?php echo e(__(\App\Models\Invoice::$status[$invoice->status])); ?></span>
                                             <?php elseif($invoice->status == 4): ?>
                                                 <span class="badge bg-info p-2 px-3 rounded"
                                                     style="width: 91px;"><?php echo e(__(\App\Models\Invoice::$status[$invoice->status])); ?></span>
                                             <?php endif; ?>
                                         </td>
                                         <td>
                                             <span
                                                 class="budget"><?php echo e(\Auth::user()->dateFormat($invoice->created_at)); ?></span>
                                         </td>
                                         <td>
                                             <span
                                                 class="budget"><?php echo e(\Auth::user()->priceFormat($invoice->getTotal())); ?></span>
                                         </td>
                                         <td>
                                             <span
                                                 class="budget"><?php echo e(ucfirst(!empty($invoice->assign_user) ? $invoice->assign_user->name : '-')); ?></span>
                                         </td>
                                         <?php if(Gate::check('Show Invoice') || Gate::check('Edit Invoice') || Gate::check('Delete Invoice')): ?>
                                             <td class="text-end">
                                                 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Invoice')): ?>
                                                     <div class="action-btn bg-success ms-2">
                                                         <?php echo Form::open([
                                                             'method' => 'get',
                                                             'route' => ['invoice.duplicate', $invoice->id],
                                                             'id' => 'duplicate-form-' . $invoice->id,
                                                         ]); ?>


                                                         <a href="#"
                                                             class="mx-3 btn btn-sm align-items-center text-white  duplicate_confirm"
                                                             data-bs-toggle="tooltip" title="<?php echo e(__('Duplicate')); ?>"
                                                             data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>"
                                                             data-confirm="You want to confirm this action. Press Yes to continue or Cancel to go back"
                                                             data-confirm-yes="document.getElementById('duplicate-form-<?php echo e($invoice->id); ?>').submit();">
                                                             <i class="ti ti-copy"></i>
                                                             <?php echo Form::close(); ?>

                                                         </a>
                                                     </div>
                                                 <?php endif; ?>
                                                 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Invoice')): ?>
                                                     <div class="action-btn bg-warning ms-2">
                                                         <a href="<?php echo e(route('invoice.show', $invoice->id)); ?>"
                                                             data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>"
                                                             class="mx-3 btn btn-sm align-items-center text-white "
                                                             data-title="<?php echo e(__('Invoice Details')); ?>">
                                                             <i class="ti ti-eye"></i>
                                                         </a>
                                                     </div>
                                                 <?php endif; ?>
                                                 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Invoice')): ?>
                                                     <div class="action-btn bg-info ms-2">
                                                         <a href="<?php echo e(route('invoice.edit', $invoice->id)); ?>"
                                                             data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>"
                                                             class="mx-3 btn btn-sm align-items-center text-white "
                                                             data-title="<?php echo e(__('Edit Invoice')); ?>"><i
                                                                 class="ti ti-edit"></i></a>
                                                     </div>
                                                 <?php endif; ?>
                                                 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Invoice')): ?>
                                                     <div class="action-btn bg-danger ms-2">
                                                         <?php echo Form::open(['method' => 'DELETE', 'route' => ['invoice.destroy', $invoice->id]]); ?>

                                                         <a href="#!"
                                                             class="mx-3 btn btn-sm   align-items-center text-white show_confirm"
                                                             data-bs-toggle="tooltip" title='Delete'>
                                                             <i class="ti ti-trash"></i>
                                                         </a>
                                                         <?php echo Form::close(); ?>

                                                     </div>
                                                 <?php endif; ?>

                                             </td>
                                         <?php endif; ?>
                                     </tr>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 <?php $__env->stopSection(); ?>
 <?php $__env->startPush('script-page'); ?>
     <script>
         $(document).on('click', '#billing_data', function() {
             $("[name='shipping_address']").val($("[name='billing_address']").val());
             $("[name='shipping_city']").val($("[name='billing_city']").val());
             $("[name='shipping_state']").val($("[name='billing_state']").val());
             $("[name='shipping_country']").val($("[name='billing_country']").val());
             $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
         })

         $(document).on('change', 'select[name=opportunity]', function() {

             var opportunities = $(this).val();
             console.log(opportunities);
             getaccount(opportunities);
         });

         function getaccount(opportunities_id) {
             $.ajax({
                 url: '<?php echo e(route('invoice.getaccount')); ?>',
                 type: 'POST',
                 data: {
                     "opportunities_id": opportunities_id,
                     "_token": "<?php echo e(csrf_token()); ?>",
                 },
                 success: function(data) {
                     console.log(data);
                     $('#amount').val(data.opportunitie.amount);
                     $('#account_name').val(data.account.name);
                     $('#account_id').val(data.account.id);
                     $('#billing_address').val(data.account.billing_address);
                     $('#shipping_address').val(data.account.shipping_address);
                     $('#billing_city').val(data.account.billing_city);
                     $('#billing_state').val(data.account.billing_state);
                     $('#shipping_city').val(data.account.shipping_city);
                     $('#shipping_state').val(data.account.shipping_state);
                     $('#billing_country').val(data.account.billing_country);
                     $('#billing_postalcode').val(data.account.billing_postalcode);
                     $('#shipping_country').val(data.account.shipping_country);
                     $('#shipping_postalcode').val(data.account.shipping_postalcode);

                 }
             });
         }
     </script>
 <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/invoice/index.blade.php ENDPATH**/ ?>