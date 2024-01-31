
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Contract Type')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Contract Type')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create ContractType')): ?>
            <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create')); ?>" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Create Contract Type')); ?>" data-url="<?php echo e(route('contract_type.create')); ?>"><i class="ti ti-plus text-white"></i></a>
        <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Contract Type')); ?></li>
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
                                <th><?php echo e(__('Contract Type')); ?></th>
                                <th width="250px" class="text-end"><?php echo e(__('Action')); ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $contractTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contractType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($contractType->name); ?></td>
                                    <td class="Action text-end">
                                        <span>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit ContractType')): ?>
                                        <div class="action-btn bg-info ms-2">
                                            <a href="#" data-size="md"
                                            data-url="<?php echo e(URL::to('contract_type/'.$contractType->id.'/edit')); ?>"
                                                data-ajax-popup="true" data-bs-toggle="tooltip"
                                                data-title="<?php echo e(__('Edit type')); ?>" title="<?php echo e(__('Edit')); ?>"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        </div>
                                                
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete ContractType')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['contract_type.destroy', $contractType->id]]); ?>

                                                        <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Delete')); ?>">
                                                        <span class="text-white"> <i class="ti ti-trash"></i></span></a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            <?php endif; ?>
                                        </span>
                                    </td>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/contract_type/index.blade.php ENDPATH**/ ?>