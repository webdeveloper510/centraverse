
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Event Customer')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <?php echo e(__('Event Customer')); ?>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('userlist')); ?>"><?php echo e(__('Customers')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('event_customers')); ?>"><?php echo e(__('Event Customers')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Customer Details')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="row align-items-center">
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Event Status')); ?></small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class="">
                                            <?php echo e(__(\App\Models\Meeting::$status[$event->status])); ?>

                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Name')); ?> </small>
                                    </div>
                                    <div class="col-md-5">
                                        <span class=""><?php echo e($event->name); ?></span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Email')); ?></small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class=""><?php echo e($event->email); ?></span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Phone')); ?></small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class=""><?php echo e($event->phone); ?></span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Address')); ?></small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class=""><?php echo e($event->lead_address ?? '--'); ?></span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Lead Type')); ?></small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class=""><?php echo e($event->type); ?></span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Date')); ?></small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class=""> <?php if($event->start_date == $event->end_date): ?>
                                            <?php echo e(\Auth::user()->dateFormat($event->start_date)); ?>

                                            <?php else: ?>
                                            <?php echo e(\Auth::user()->dateFormat($event->start_date)); ?> -
                                            <?php echo e(\Auth::user()->dateFormat($event->end_date)); ?>

                                            <?php endif; ?>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="m-b-10">
                    <div class="page-header-title">
                        <?php echo e(__('Documents')); ?>

                    </div>
                </h4>

                <div class="container-fluid xyz mt-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card" id="useradd-1">
                                <div class="card-body table-border-style">
                                    <h3>Upload Documents</h3>
                                    <?php echo e(Form::open(array('route' => ['event.uploaddoc', $event->id],'method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))); ?>


                                    <label for="customerattachment">Attachment</label>
                                    <input type="file" name="customerattachment" id="customerattachment"
                                        class="form-control" required>
                                    <input type="submit" value="Submit" class="btn btn-primary mt-4"
                                        style="float: right;">
                                        <?php echo e(Form::close()); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body table-border-style">
                                    <h3>Add Notes/Comments</h3>
                                    <form method="POST" id="addeventnotes">
                                        <?php echo csrf_field(); ?>
                                        <label for="notes">Notes</label>
                                        <input type="text" class="form-control" name="notes" required>
                                        <input type="submit" value="Submit" class="btn btn-primary mt-4"
                                            style=" float: right;">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card" id="useradd-1">
                                <div class="card-body table-border-style">
                                    <h3>Attachments</h3>
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Attachment</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(Storage::disk('public')->exists($doc->filepath)): ?>
                                            <tr>
                                                <td><?php echo e($doc->filename); ?></td>
                                                <td><a href="<?php echo e(Storage::url('app/public/'.$doc->filepath)); ?>" download
                                                        style="color: teal;" title="Download">View Document <i
                                                            class="fa fa-download"></i></a>
                                            </tr>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card" id="useradd-1">
                                <div class="card-body table-border-style">
                                    <h3>Notes</h3>
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Notes</th>
                                            <th>Created By</th>
                                            <th>Date</th>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(ucfirst($note->notes)); ?></td>
                                                <td><?php echo e((App\Models\User::where('id',$note->created_by)->first()->name)); ?>

                                                </td>
                                                <td><?php echo e(\Auth::user()->dateFormat($note->created_at)); ?></td>
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
    </div>


    <!-- <style>
.modal-dialog.modal-md {
    max-width: 850px;
}
</style> -->
    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('script-page'); ?>
    <script>
    $(document).ready(function() {
        $('#addeventnotes').on('submit', function(e) {
            e.preventDefault();
            var id = <?php echo  $event->id; ?>;
            var notes = $('input[name="notes"]').val();
            var createrid = <?php echo Auth::user()->id ;?>;

            $.ajax({
                url: "<?php echo e(route('addeventnotes', ['id' => $event->id])); ?>", // URL based on the route with the actual user ID
                type: 'POST',
                data: {
                    "notes": notes,
                    "createrid": createrid,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    location.reload();
                }
            });

        });
    });
    </script>
    <?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/customer/eventuserview.blade.php ENDPATH**/ ?>