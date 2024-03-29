

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Contract')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Contract')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Contract')); ?></li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('action-btn'); ?>
    <?php if(\Auth::user()->type == 'owner' && \Auth::user()->type != 'Accountant' && \Auth::user()->type != 'Manager'): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Contract')): ?>
            <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                title="<?php echo e(__('Create')); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create New Contract')); ?>"
                data-url="<?php echo e(route('contract.create')); ?>"><i class="ti ti-plus text-white"></i></a>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-3 col-6">
            <div class="card comp-card" style="min-height:110px;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class=""><?php echo e(__('Total Contracts')); ?></h6>
                            <h3 class="text-primary"><?php echo e($cnt_contract['total']); ?></h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake bg-success text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-6">
            <div class="card comp-card" style="min-height:110px;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class=""><?php echo e(__('This Month Total Contracts')); ?></h6>
                            <h3 class="text-info"><?php echo e($cnt_contract['this_month']); ?></h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake bg-info text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-6">
            <div class="card comp-card" style="min-height:110px;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class=""><?php echo e(__('This Week Total Contracts')); ?></h6>
                            <h3 class="text-warning"><?php echo e($cnt_contract['this_week']); ?></h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake bg-warning text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-6">
            <div class="card comp-card" style="min-height:110px;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class=""><?php echo e(__('Last 30 Days Total Contracts')); ?></h6>
                            <h3 class="text-danger"><?php echo e($cnt_contract['last_30days']); ?></h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake bg-danger text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-12">
            <div class="card table-card">
                <div class="card-header card-body table-border-style">
                    <div class="table-responsive">
                        <table id="datatable" class="table datatable align-items-center">
                            <thead>
                                <tr>
                                    <th width="60px"><?php echo e(__('Contract')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Subject')); ?></th>
                                    <th><?php echo e(__('Value')); ?></th>
                                    <th><?php echo e(__('Type')); ?></th>
                                    <th><?php echo e(__('Start Date')); ?></th>
                                    <th><?php echo e(__('End Date')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $contracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="Id">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Contract')): ?>
                                                <a href="<?php echo e(route('contract.show', $contract->id)); ?>"
                                                    class="btn btn-outline-primary"><?php echo e(Auth::user()->contractNumberFormat($contract->id)); ?></a>
                                                
                                                
                                            <?php endif; ?>

                                        </td>
                                        <td><?php echo e($contract->name); ?></td>
                                        <td><?php echo e($contract->subject); ?></td>
                                        <td><?php echo e(Auth::user()->priceFormat($contract->value)); ?></td>
                                        <td><?php echo e($contract->contract_type->name); ?></td>
                                        <td><?php echo e(Auth::user()->dateFormat($contract->start_date)); ?></td>
                                        <td><?php echo e(Auth::user()->dateFormat($contract->end_date)); ?></td>
                                        <td>
                                            <?php if($contract->status == 'accept'): ?>
                                                <span
                                                    class="status_badge badge bg-primary  p-2 px-3 rounded"><?php echo e(__('Accept')); ?></span>
                                            <?php elseif($contract->status == 'decline'): ?>
                                                <span
                                                    class="status_badge badge bg-danger p-2 px-3 rounded"><?php echo e(__('Decline')); ?></span>
                                            <?php elseif($contract->status == 'pending'): ?>
                                                <span
                                                    class="status_badge badge bg-warning p-2 px-3 rounded"><?php echo e(__('Pending')); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="">


                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Contract')): ?>
                                                <div class="action-btn bg-warning ms-2">
                                                    <a href="<?php echo e(route('contract.show', $contract->id)); ?>" data-size="md" data-bs-toggle="tooltip"
                                                        data-title="<?php echo e(__('View')); ?>" title="<?php echo e(__('Quick View')); ?>"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                        <i class="ti ti-eye text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(\Auth::user()->type == 'owner' && \Auth::user()->type != 'Accountant' && \Auth::user()->type != 'Manager'): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Contract')): ?>

                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" data-size="md"
                                                        data-url="<?php echo e(URL::to('contract/' . $contract->id . '/edit')); ?>"
                                                            data-ajax-popup="true" data-bs-toggle="tooltip"
                                                            data-title="<?php echo e(__('Edit type')); ?>" title="<?php echo e(__('Details')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <?php if(\Auth::user()->type == 'owner' && \Auth::user()->type != 'Accountant' && \Auth::user()->type != 'Manager'): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Contract')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['contract.destroy', $contract->id]]); ?>

                                                        <a href="#!"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="<?php echo e(__('Delete')); ?>">
                                                            <span class="text-white"> <i class="ti ti-trash"></i></span>
                                                        </a>
                                                            <?php echo Form::close(); ?>

                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/contracts/index.blade.php ENDPATH**/ ?>