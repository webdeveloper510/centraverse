
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Campaign')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Campaign')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Campaign')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <a href="<?php echo e(route('campaign.grid')); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip"
        title="<?php echo e(__('Grid View')); ?>">
        <i class="ti ti-layout-grid text-white"></i>
    </a>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Campaign')): ?>
        <a href="#" data-size="lg" data-url="<?php echo e(route('campaign.create', ['campaign', 0])); ?>" data-bs-toggle="tooltip"
            data-ajax-popup="true" data-title="<?php echo e(__('Create New Campaign')); ?>" title="<?php echo e(__('Create')); ?>"
            class="btn btn-sm btn-primary btn-icon m-1">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table id="datatable" class="table datatable align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Type')); ?></th>
                                    <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Budget')); ?>

                                    </th>
                                    <th scope="col" class="sort" data-sort="status"><?php echo e(__('Assigned User')); ?>

                                    </th>
                                    <?php if(Gate::check('Show Campaign') || Gate::check('Edit Campaign') || Gate::check('Delete Campaign')): ?>
                                        <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(route('campaign.edit', $campaign->id)); ?>" data-size="md"
                                                data-title="<?php echo e(__('Campaign Details')); ?>" class="action-item text-primary">
                                                <?php echo e(ucfirst($campaign->name)); ?>

                                            </a>
                                        </td>
                                        <td>
                                            <?php echo e(ucfirst(!empty($campaign->types->name) ? $campaign->types->name : '-')); ?>

                                        </td>
                                        <td>
                                            <?php if($campaign->status == 0): ?>
                                                <span class="badge bg-warning p-2 px-3 rounded"
                                                    style="width: 73px;"><?php echo e(__(\App\Models\Campaign::$status[$campaign->status])); ?></span>
                                            <?php elseif($campaign->status == 1): ?>
                                                <span class="badge bg-success p-2 px-3 rounded"
                                                    style="width: 73px;"><?php echo e(__(\App\Models\Campaign::$status[$campaign->status])); ?></span>
                                            <?php elseif($campaign->status == 2): ?>
                                                <span class="badge bg-danger p-2 px-3 rounded"
                                                    style="width: 73px;"><?php echo e(__(\App\Models\Campaign::$status[$campaign->status])); ?></span>
                                            <?php elseif($campaign->status == 3): ?>
                                                <span class="badge bg-info p-2 px-3 rounded"
                                                    style="width: 73px;"><?php echo e(__(\App\Models\Campaign::$status[$campaign->status])); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="budget"><?php echo e($campaign->budget); ?></span>
                                        </td>
                                        <td>
                                            <span class="col-sm-12"><span
                                                    class="text-sm"><?php echo e(ucfirst(!empty($campaign->assign_user) ? $campaign->assign_user->name : '-')); ?></span></span>
                                        </td>

                                        <?php if(Gate::check('Show Campaign') || Gate::check('Edit Campaign') || Gate::check('Delete Campaign')): ?>
                                            <td class="text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Campaign')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="#" data-size="md"
                                                            data-url="<?php echo e(route('campaign.show', $campaign->id)); ?>"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>"
                                                            data-ajax-popup="true" data-title="<?php echo e(__('Campaign Details')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Campaign')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="<?php echo e(route('campaign.edit', $campaign->id)); ?>"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                            data-title="<?php echo e(__('Edit Campaign')); ?>"><i
                                                                class="ti ti-edit"></i></a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Campaign')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['campaign.destroy', $campaign->id]]); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/campaign/index.blade.php ENDPATH**/ ?>