
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Event')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Event')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Event')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Meeting')): ?>
        <div class="col-12 text-end mt-3">
            <a href="<?php echo e(route('meeting.create',['meeting',0])); ?>"> 
                <button  data-bs-toggle="tooltip"title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
                <i class="ti ti-plus"></i></button>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-2">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#useradd-1" class="list-group-item list-group-item-action"><?php echo e(__('Event')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-10">
                    <div class="card" id ="useradd-1">
                        <div class="card-body table-border-style">
                            <div class="table-responsive overflow_hidden">
                                <table id="datatable" class="table datatable align-items-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name"><?php echo e(__('Lead')); ?></th>
                                            <!-- <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Parent')); ?></th> -->
                                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?></th>
                                            <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Date Start')); ?></th>
                                            <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Event')); ?></th>
                                            <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Assigned Staff')); ?></th>
                                            <?php if(Gate::check('Show Meeting') || Gate::check('Edit Meeting') || Gate::check('Delete Meeting')): ?>
                                                <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('meeting.edit', $meeting->id)); ?>" data-size="md"
                                                        data-title="<?php echo e(__('Event Details')); ?>" class="action-item text-primary">
                                                    <?php echo e(ucfirst(\App\Models\Lead::where('id',$meeting->attendees_lead)->pluck('leadname')->first())); ?> 
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php if($meeting->status == 0): ?>
                                                        <span class="badge bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\Meeting::$status[$meeting->status])); ?></span>
                                                    <?php elseif($meeting->status == 1): ?>
                                                        <span class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Meeting::$status[$meeting->status])); ?></span>
                                                    <?php elseif($meeting->status == 2): ?>
                                                        <span class="badge bg-success p-2 px-3 rounded"><?php echo e(__(\App\Models\Meeting::$status[$meeting->status])); ?></span>
                                                    <?php elseif($meeting->status == 3): ?>
                                                        <span class="badge bg-success p-2 px-3 rounded"><?php echo e(__(\App\Models\Meeting::$status[$meeting->status])); ?></span>
                                                    <?php elseif($meeting->status == 4): ?>
                                                        <span class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Meeting::$status[$meeting->status])); ?></span>
                                                    <?php elseif($meeting->status == 5): ?>
                                                        <span class="badge bg-danger p-2 px-3 rounded"><?php echo e(__(\App\Models\Meeting::$status[$meeting->status])); ?></span>
                                                    
                                                        <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="budget"><?php echo e(\Auth::user()->dateFormat($meeting->start_date)); ?></span>
                                                </td>
                                                <td>
                                                    <span class="budget"><?php echo e($meeting->type); ?></span>
                                                </td>
                                            
                                                <td>
                                                    <span class="budget"><?php echo e(App\Models\User::where('id',$meeting->user_id)->pluck('name')->first()); ?></span>
                                                </td>
                                                <?php if(Gate::check('Show Meeting') || Gate::check('Edit Meeting') || Gate::check('Delete Meeting')): ?>
                                                    <td class="text-end">
                                                    <?php if($meeting->status == 0 ): ?>
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="#" data-size="md"
                                                            data-url="<?php echo e(route('meeting.share', $meeting->id)); ?>"
                                                            data-ajax-popup="true" data-bs-toggle="tooltip"
                                                            data-title="<?php echo e(__('Event Details')); ?>"title="<?php echo e(__('Share')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-share"></i>
                                                        </a>
                                                    </div>
                                                    <?php elseif($meeting->status == 1 ||$meeting->status == 4): ?>
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="#" data-size="md"
                                                            data-title="<?php echo e(__('Agreement')); ?>"title="<?php echo e(__('Agreement Sent')); ?>"
                                                            data-bs-toggle="tooltip"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-clock"></i>
                                                        </a>
                                                    </div>
                                                    <?php elseif($meeting->status == 2 ||$meeting->status == 3): ?>
                                                    <div class="action-btn bg-primary ms-2">
                                                            <a href="<?php echo e(route('meeting.review',urlencode(encrypt($meeting->id)))); ?>" data-size="md"
                                                                data-title="<?php echo e(__('Agreement')); ?>"title="<?php echo e(__('Review Agreement')); ?>"
                                                                data-bs-toggle="tooltip"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                                <i class="fa fa-pen"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="<?php echo e(route('meeting.agreement',urlencode(encrypt($meeting->id)))); ?>" 
                                                        data-bs-toggle="tooltip"
                                                            data-title="<?php echo e(__('Agreement')); ?>"title="<?php echo e(__('View Agreement')); ?>" 
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                            <i class="ti ti-receipt"></i>
                                                        </a>
                                                    </div>
                                                    
                                                        
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Meeting')): ?>
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="#" data-size="md"
                                                                    data-url="<?php echo e(route('meeting.show', $meeting->id)); ?>"
                                                                    data-ajax-popup="true" data-bs-toggle="tooltip"
                                                                    data-title="<?php echo e(__('Event Details')); ?>"title="<?php echo e(__('Quick View')); ?>"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Meeting')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="<?php echo e(route('meeting.edit', $meeting->id)); ?>"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                    data-bs-toggle="tooltip" data-title="<?php echo e(__('Details')); ?>"
                                                                    title="<?php echo e(__('Edit')); ?>"><i class="ti ti-edit"></i></a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Meeting')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['meeting.destroy', $meeting->id]]); ?>

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
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('change', 'select[name=parent]', function() {

            var parent = $(this).val();

            getparent(parent);
        });

        function getparent(bid) {

            $.ajax({
                url: '<?php echo e(route('meeting.getparent')); ?>',
                type: 'POST',
                data: {
                    "parent": bid,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    console.log(data);
                    $('#parent_id').empty();
                    

                    $.each(data, function(key, value) {
                        $('#parent_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/meeting/index.blade.php ENDPATH**/ ?>