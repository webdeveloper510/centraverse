
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Lead')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
        <div class="page-header-title">
            <?php echo e(__('Lead')); ?>

        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Lead')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Lead')): ?>
        <a href="#" data-url="<?php echo e(route('lead.create',['lead',0])); ?>" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Lead')); ?>"title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
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
                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Lead')); ?></th>
                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Email')); ?></th>
                                <!-- <th scope="col" class="sort" ><?php echo e(__('Phone')); ?></th> -->
                                <th scope="col" class="sort"><?php echo e(__('Assigned Staff')); ?></th>
                                <th scope="col" class="sort"><?php echo e(__('Proposal Status')); ?></th>
                                <th scope="col" class="sort"><?php echo e(__('Admin Approval')); ?></th>
                                <?php if(Gate::check('Show Lead') || Gate::check('Edit Lead') || Gate::check('Delete Lead')): ?>
                                    <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <span class="budget"><b><?php echo e(ucfirst($lead->leadname)); ?></b></span>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('lead.edit',$lead->id)); ?>" data-size="md" data-title="<?php echo e(__('Lead Details')); ?>" class="action-item text-primary">
                                            <?php echo e(ucfirst($lead->name)); ?>

                                        </a>
                                    </td>
                                    <td>
                                        <span class="budget"><?php echo e($lead->email); ?></span>
                                    </td>
                                    <!-- <td>
                                        <span class="budget">
                                            <?php echo e($lead->phone); ?>

                                        </span>
                                    </td> -->
                                    <td>
                                        <span class="col-sm-12"><span class="text-sm"><?php echo e(ucfirst(!empty($lead->assign_user)?$lead->assign_user->name:'')); ?> (<?php echo e($lead->assign_user->type); ?>)</span></span>
                                    </td>
                                    <td>
                                        <?php if($lead->proposal_status == 0): ?>
                                            <span class="badge bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\Lead::$status[$lead->proposal_status])); ?></span>
                                        <?php elseif($lead->proposal_status == 1): ?>
                                            <span class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Lead::$status[$lead->proposal_status])); ?></span>
                                        <?php elseif($lead->proposal_status == 2): ?>
                                            <span class="badge bg-success p-2 px-3 rounded" ><?php echo e(__(\App\Models\Lead::$status[$lead->proposal_status])); ?></span>
                                        <?php elseif($lead->proposal_status == 3): ?>
                                            <span class="badge bg-danger p-2 px-3 rounded" ><?php echo e(__(\App\Models\Lead::$status[$lead->proposal_status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($lead->status == 0): ?>
                                            <span class="badge bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\Lead::$lead_status[$lead->status])); ?></span>
                                        <?php elseif($lead->status == 1): ?>
                                            <span class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Lead::$lead_status[$lead->status])); ?></span>
                                        <?php elseif($lead->status == 2): ?>
                                            <span class="badge bg-success p-2 px-3 rounded"><?php echo e(__(\App\Models\Lead::$lead_status[$lead->status])); ?></span>
                                        <?php elseif($lead->status == 3): ?>
                                            <span class="badge bg-primary p-2 px-3 rounded"><?php echo e(__(\App\Models\Lead::$lead_status[$lead->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(Gate::check('Show Lead') || Gate::check('Edit Lead') || Gate::check('Delete Lead')): ?>
                                        <td class="text-end">
                                            <?php if($lead->proposal_status == 0 ): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-size="md"
                                                        data-url="<?php echo e(route('lead.shareproposal',urlencode(encrypt($lead->id)))); ?>"
                                                        data-ajax-popup="true" data-bs-toggle="tooltip"
                                                        data-title="<?php echo e(__('Proposal')); ?>"title="<?php echo e(__('Share Proposal')); ?>"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                        <i class="ti ti-share"></i>
                                                    </a>
                                                </div>
                                            <?php elseif($lead->proposal_status == 1): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-size="md"
                                                        data-title="<?php echo e(__('Proposal')); ?>"title="<?php echo e(__('Proposal Sent')); ?>"
                                                        data-bs-toggle="tooltip"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                        <i class="ti ti-clock"></i>
                                                    </a>
                                                </div>
                                            <?php elseif($lead->proposal_status == 2): ?>
                                                <!-- <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-size="md"
                                                        data-title="<?php echo e(__('Proposal')); ?>"title="<?php echo e(__('Review Proposal')); ?>"
                                                        data-bs-toggle="tooltip"  data-ajax-popup="true"
                                                        data-url="<?php echo e(route('lead.review',urlencode(encrypt($lead->id)))); ?>"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </div> -->
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="<?php echo e(route('lead.review',urlencode(encrypt($lead->id)))); ?>" 
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white "
                                                     data-bs-toggle="tooltip"title="<?php echo e(__('Review')); ?>" data-title="<?php echo e(__('Review Lead')); ?>">
                                                 <i class="fas fa-pen"></i></a>
                                            </div>
                                            <?php endif; ?>
                                            <div class="action-btn bg-success ms-2">
                                                <a href="<?php echo e(route('lead.proposal',urlencode(encrypt($lead->id)))); ?>" 
                                                data-bs-toggle="tooltip"
                                                    data-title="<?php echo e(__('Proposal')); ?>"title="<?php echo e(__('View Proposal')); ?>" 
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                    <i class="ti ti-receipt"></i>
                                                </a>
                                            </div>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Lead')): ?>
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="#" data-size="md" data-url="<?php echo e(route('lead.show',$lead->id)); ?>"
                                                data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>"
                                                data-ajax-popup="true" data-title="<?php echo e(__('Lead Details')); ?>" 
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Lead')): ?>
                                            <div class="action-btn bg-info ms-2">
                                                <a href="<?php echo e(route('lead.edit',$lead->id)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white " data-bs-toggle="tooltip"title="<?php echo e(__('Details')); ?>" data-title="<?php echo e(__('Edit Lead')); ?>"><i class="ti ti-edit"></i></a>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Lead')): ?>
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['lead.destroy', $lead->id]]); ?>

                                                <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/lead/index.blade.php ENDPATH**/ ?>